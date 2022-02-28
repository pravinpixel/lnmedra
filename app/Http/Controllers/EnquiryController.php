<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Supplier;
use App\Enquiry;
use Hash;
use Illuminate\Validation\Rule;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function index()
    {
        # code...
        $role = Role::find(Auth::user()->role_id);
      
        if($role->hasPermissionTo('enquiry-index')){
            // print_r("ddd");die();
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_supplier_all = Enquiry::where('is_active', true)->get();
            return view('enquiry.index',compact('lims_supplier_all', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function create(Type $var = null)
    {
        # code...
        $role = Role::find(Auth::user()->role_id);
       
        if($role->hasPermissionTo('enquiry-add')){
            return view('enquiry.create');
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            
            'email' => 'required|email|max:255|unique:enquiries,email|regex:/(.+)@(.+)\.(.+)/i',
            'mobile' => 'required|digits:10|min:5',
        ]);
        
        $lims_enquiry_data = $request->all();
        $lims_enquiry_data['is_active'] = true;
      
        Enquiry::create($lims_enquiry_data);

       if($lims_enquiry_data['requirement'] == 1)
       {
        $lims_enquiry_data['requirement'] = "Landscape Design";
       }
       if($lims_enquiry_data['requirement'] == 2)
       {
        $lims_enquiry_data['requirement'] = "Execution";
       }
        $details = [
            'name'     =>   $lims_enquiry_data['name'],
            'email'    =>  $lims_enquiry_data['email'],
            'mobile'    =>   $lims_enquiry_data['mobile'],
            'requirement'     =>   $lims_enquiry_data['requirement']
            ]; 
            // print_r($details);die();
        $message = 'Data inserted successfully';
        try{
            $res = Mail::to($lims_enquiry_data['email'])->send(new \App\Mail\EnquiryMail($details));
        }
        catch(\Exception $e) {
            $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }
        return redirect('enquiry')->with('message', $message);
    }
    
    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('enquiry-edit')){
            $lims_enquiry_data = Enquiry::where('id',$id)->first();
            return view('enquiry.edit',compact('lims_enquiry_data'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => [
                'max:255',
                    Rule::unique('enquiries')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'mobile' => 'required|digits:10|min:5',
        ]);
        $input = $request->all();
        $lims_enquiry_data = Enquiry::findOrFail($id);
        $input['is_active'] = true;
        $lims_enquiry_data->update($input);

        return redirect('enquiry')->with('message','Data updated successfully');
    }
    public function destroy($id)
    {
        // print_r($id);die();
        $lims_enquiry_data = Enquiry::findOrFail($id);
        $lims_enquiry_data->is_active = false;
        $lims_enquiry_data->save();
        $lims_enquiry_data->delete();
        return redirect('enquiry')->with('not_permitted','Data deleted successfully');
    }


}
