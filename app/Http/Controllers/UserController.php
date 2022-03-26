<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Biller;
use App\Warehouse;
use App\CustomerGroup;
use App\Customer;
use App\OutletUser;
use Auth;
use Hash;
use Keygen;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->get();
            return view('user.index', compact('lims_user_list', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_role_list = Roles::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $lims_customer_group_list = CustomerGroup::where('is_active', true)->get();
            return view('user.create', compact('lims_role_list', 'lims_biller_list', 'lims_warehouse_list', 'lims_customer_group_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function store(Request $request)
    {
        // print_r($request->all());die();
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                    Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);
        
        if($request->role_id == 5) {
            $this->validate($request, [
                'phone_number' => [
                    'max:255',
                        Rule::unique('customers')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
            ]);
        }

        $data = $request->all();
        $file = $request->id_proof;
        if ($file) {
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move('public/user/id_proof', $fileName);
            $data['id_proof'] = $fileName;
        }
        $adrressfile = $request->address_proof;
        if ($adrressfile) {
            $ext = pathinfo($adrressfile->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $adrressfile->move('public/user/address_proof', $fileName);
            $data['address_proof'] = $fileName;
        }
        
        $message = 'User created successfully';
        try {
            Mail::send( 'mail.user_details', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->subject( 'User Account Details' );
            });
        }
        catch(\Exception $e){
            $message = 'User created successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }
        if(!isset($data['is_active']))
            $data['is_active'] = false;
        $data['is_deleted'] = false;
        $data['password'] = bcrypt($data['password']);
        $data['phone'] = $data['phone_number'];
        $formatData = collect($data)->except('warehouse_id')->toArray();
    
        $user_id =  User::create($formatData)->id;

      
        foreach($data['warehouse_id'] as $key=>$val )
        {
           
                $ff = new OutletUser();
                $ff->user_id = $user_id;
                $ff->outlet_id = $val;
                if($key == $data['selected_outlet'])
                {
                    $ff->is_default = 1;
             
                }
                else{
                    $ff->is_default = 0;
                   
                }
                
                $ff->is_active = 1;
                $ff->save();
               
        }
       
        foreach($data['warehouse_id'] as $key=>$val )
        {
          
                if($key == $data['selected_outlet'])
                {
                   
                  $defaultID = $val;
                }
            
        }

        $updateOutlet = User::where('id',$user_id)->first();
        $updateOutlet->warehouse_id = $defaultID;
        $updateOutlet->update();

        if($data['role_id'] == 5) {
            $data['name'] = $data['customer_name'];
            $data['phone_number'] = $data['phone'];
            $data['is_active'] = true;
            Customer::create($data);
        }
        return redirect('user')->with('message1', $message); 
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-edit')){
            $lims_user_data = User::find($id);
            $outlet_data = OutletUser::where('is_active',true)->where('user_id',$id)->get();
            $outlet_count = OutletUser::where('is_active',true)->where('user_id',$id)->count();
            $lims_role_list = Roles::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            // print_r($outlet_data);die();
            return view('user.edit', compact('lims_user_data', 'lims_role_list', 'lims_biller_list', 'lims_warehouse_list','outlet_data','outlet_count'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        // print_r($request->all());die();
        $outletData = OutletUser::where('user_id',$id)->get();

        foreach($outletData as $val)
        {
            $val->is_active = 2;
            $val->save();
        }
    
        // print_r($outletData);die();
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                    Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $input = $request->except('password');


        $file = $request->id_proof;
        if ($file) {
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move('public/user/id_proof', $fileName);
            $input['id_proof'] = $fileName;
        }
        $adrressfile = $request->address_proof;
        if ($adrressfile) {
            $ext = pathinfo($adrressfile->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $adrressfile->move('public/user/address_proof', $fileName);
            $input['address_proof'] = $fileName;
        }

        // print_r($input);die();
     

        if(!isset($input['is_active']))
            $input['is_active'] = false;
        if(!empty($request['password']))
            $input['password'] = bcrypt($request['password']);
        $lims_user_data = User::find($id);
        $formatData = collect($input)->except('warehouse_id')->toArray();

        $lims_user_data->update($formatData);
       

      
        foreach($input['warehouse_id'] as $key=>$val )
        {
           
                $ff = new OutletUser();
                $ff->user_id = $id;
                $ff->outlet_id = $val;
                if($key == $input['selected_outlet'])
                {
                    $ff->is_default = 1;
                }
                else{
                    $ff->is_default = 0;
                }
               
                $ff->is_active = 1;
                $ff->save();
               
        }
        foreach($input['warehouse_id'] as $key=>$val )
        {
           
              
                if($key == $input['selected_outlet'])
                {
               
                  $defaultID = $val;
                }
            
        }

        $updateOutlet = User::where('id',$id)->first();
        $updateOutlet->warehouse_id = $defaultID;
        $updateOutlet->update();
        return redirect('user')->with('message2', 'Data updated successfullly');
    }

    public function profile($id)
    {
        $lims_user_data = User::find($id);
        return view('user.profile', compact('lims_user_data'));
    }

    public function profileUpdate(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
        return redirect()->back()->with('message3', 'Data updated successfullly');
    }

    public function changePassword(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        if($input['new_pass'] != $input['confirm_pass'])
            return redirect("user/" .  "profile/" . $id )->with('message2', "Please Confirm your new password");

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        }
        else {
            return redirect("user/" .  "profile/" . $id )->with('message1', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

    public function deleteBySelection(Request $request)
    {
        $user_id = $request['userIdArray'];
        foreach ($user_id as $id) {
            $lims_user_data = User::find($id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->is_active = false;
            $lims_user_data->save();
        }
        return 'User deleted successfully!';
    }

    public function destroy($id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        
        $lims_user_data = User::find($id);
        $lims_user_data->is_deleted = true;
        $lims_user_data->is_active = false;
        $lims_user_data->save();
        if(Auth::id() == $id){
            auth()->logout();
            return redirect('/login');
        }
        else
            return redirect('user')->with('message3', 'Data deleted successfullly');
    }
}
