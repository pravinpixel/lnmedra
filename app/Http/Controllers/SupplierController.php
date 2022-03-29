<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Supplier;
use App\Category;
use Hash;
use Illuminate\Validation\Rule;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use App\Mail\VendorResetPassword;
use Illuminate\Support\Facades\Mail;

class SupplierController extends Controller
{
 
    public function index()
    {
     
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('suppliers-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_supplier_all = Supplier::where('is_active','!=',2)->select('id','name','company_name','email','phone_number','address','is_active')->get();
            return view('supplier.index',compact('lims_supplier_all', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        $category = Category::get()->toArray();
        if($role->hasPermissionTo('suppliers-add')){
            return view('supplier.create',compact('category'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => [
                'max:255',
                    Rule::unique('suppliers')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            // 'email' => [
            //     'max:255',
            //         Rule::unique('suppliers')->where(function ($query) {
            //         return $query->where('is_active', 1);
            //     }),
            // ],
            // 'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
            'email' => 'required|email|max:255|unique:suppliers,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone_number' => 'required|digits:10|min:5',
        ]);
        
        $lims_supplier_data = $request->except('image');
        $lims_supplier_data['is_active'] = true;
        $password = Hash::make($lims_supplier_data['password']);
        $lims_supplier_data['password'] =  $password;
        // $image = $request->image;
        // if ($image) {
        //     $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        //     $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['company_name']);
        //     $imageName = $imageName . '.' . $ext;
        //     $image->move('public/images/supplier', $imageName);
        //     $lims_supplier_data['image'] = $imageName;
        // }
        $role = Role::find(Auth::user()->role_id);
        $vendor_id = Supplier::create($lims_supplier_data)->id;
    
        $data['name'] =  $lims_supplier_data['name'];
        $data['email'] =  $lims_supplier_data['email'];
        $data['password'] =  $password;
        $data['phone'] =  $lims_supplier_data['phone_number'];
        $data['company_name'] =  $lims_supplier_data['company_name'];
        $data['role_id'] =  6;
        $data['is_active'] =  $lims_supplier_data['is_active'];
        $data['vendor_id'] =  $vendor_id;
        
        $details = [
            'name'     =>   $lims_supplier_data['name'],
            'email'    =>  $lims_supplier_data['email'],
            'password'     =>   $lims_supplier_data['password'],
            'phone'    =>   $lims_supplier_data['phone_number'],
            'company_name'     =>  $role->id
            ]; 
        User::create($data);
        $message = 'Data inserted successfully';
        try{
            // Mail::send( 'mail.supplier_create', $lims_supplier_data, function( $message ) use ($lims_supplier_data)
            // {
            //     $message->to( $lims_supplier_data['email'] )->subject( 'New Vendor' );
            // });
            $res = Mail::to($lims_supplier_data['email'])->send(new \App\Mail\SupplierMail($details));
        }
        catch(\Exception $e) {
            $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }
        return redirect('supplier')->with('message', $message);
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        $category = Category::get()->toArray();
        if($role->hasPermissionTo('suppliers-edit')){
            $lims_supplier_data = Supplier::where('id',$id)->first();
            return view('supplier.edit',compact('lims_supplier_data','category'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name' => [
                'max:255',
                    Rule::unique('suppliers')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],

            'email' => [
                'max:255',
                    Rule::unique('suppliers')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            // 'email' => 'required|email|max:255|unique:suppliers,email|regex:/(.+)@(.+)\.(.+)/i',
            
            'phone_number' => 'required|digits:10|min:5',
            // 'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);

        $input = $request->except('image');

        $lims_supplier_data = Supplier::findOrFail($id);
        $password = Hash::make($lims_supplier_data['password']);
        $lims_supplier_data['password'] =  $password;
        $input['password']=  $password;
        $lims_supplier_data->update($input);


        $data['name'] =  $lims_supplier_data['name'];
        $data['email'] =  $lims_supplier_data['email'];
        $data['password'] =  $password;
        $data['phone'] =  $lims_supplier_data['phone_number'];
        $data['company_name'] =  $lims_supplier_data['company_name'];
        $data['role_id'] = 6;
        $data['is_active'] =  $lims_supplier_data['is_active'];
        $data['vendor_id'] = $id;
        
        $user_data = User::where('vendor_id',$id)->first();

        $user_data->name = $lims_supplier_data['name'];
        $user_data->email =$lims_supplier_data['email'];
        $user_data->password = $password;
        $user_data->phone = $lims_supplier_data['phone_number'];
        $user_data->company_name = $lims_supplier_data['company_name'];
        $user_data->role_id = 6;
        $user_data->is_active= $lims_supplier_data['is_active'];
        $user_data->vendor_id = $id;
        $user_data->update();

        return redirect('supplier')->with('message','Data updated successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $supplier_id = $request['supplierIdArray'];
        foreach ($supplier_id as $id) {
            $lims_supplier_data = Supplier::findOrFail($id);
            $lims_supplier_data->is_active = false;
            $lims_supplier_data->save();
        }
        return 'Supplier deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_supplier_data = Supplier::findOrFail($id);
        $lims_supplier_data->is_active = 2;
        $lims_supplier_data->save();
        return redirect('supplier')->with('not_permitted','Data deleted successfully');
    }
    public function vendorStatus(Request $request)
    {
        // return $request->all();
        # code...
        $lims_supplier_data = Supplier::findOrFail($request->id);
        if($lims_supplier_data->is_active == 1)
        {

            $lims_supplier_data->is_active = 0;
        }
        else if($lims_supplier_data->is_active == 0){
            $lims_supplier_data->is_active = 1;
        }
       
        $lims_supplier_data->save();
        return true;

    }

    public function importSupplier(Request $request)
    {
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
        $filename =  $upload->getClientOriginalName();
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
                continue;
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
           $data= array_combine($escapedHeader, $columns);

           $supplier = Supplier::firstOrNew(['company_name'=>$data['companyname']]);
           $supplier->name = $data['name'];
           $supplier->image = $data['image'];
           $supplier->vat_number = $data['vatnumber'];
           $supplier->email = $data['email'];
           $supplier->phone_number = $data['phonenumber'];
           $supplier->address = $data['address'];
           $supplier->city = $data['city'];
           $supplier->state = $data['state'];
           $supplier->postal_code = $data['postalcode'];
           $supplier->country = $data['country'];
           $supplier->is_active = true;
           $supplier->save();
           $message = 'Supplier Imported Successfully';
           if($data['email']){
                try{
                    Mail::send( 'mail.supplier_create', $data, function( $message ) use ($data)
                    {
                        $message->to( $data['email'] )->subject( 'New Supplier' );
                    });
                }
                catch(\Excetion $e){
                    $message = 'Supplier imported successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                }   
            }
        }
        return redirect('supplier')->with('message', $message); 
    }

    public function vendorPasswordResetView($id)
    {
      
        $userId=$id; 
        return view('supplier.vendor-reset-password',compact('userId'));
    }
    public function vendorReset(Request $request,$id)
    {
        // print_r($id);die();
        if ($request->new_password == $request->confirm_password) { 
       
            $password = Hash::make($request->confirm_password);
            $user = User::where('vendor_id',$id)->first();
            $user->password = $password;
           
            $user->save();
            $details = [
                'name'     =>   $user->name,
                'password'     =>   $request->confirm_password,
                ]; 
            try{
              
                $res = Mail::to($user->email)->send(new \App\Mail\VendorResetPassword($details));
            }
            catch(\Exception $e) {
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
            return redirect()->back()->with('message','Vendor Password Updated Sucessfully');
            // return redirect()->back()->with('message','Vendor Password Updated Sucessfully');
         } else {
           
             return redirect()->back()->with('not_permitted','Password does not match');
         }
    
        
       
    }
    
}
