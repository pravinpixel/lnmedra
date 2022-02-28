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
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    public function vendorregisterview()
    {
        $category = Category::get()->toArray();
        // print_r($category);die();
        return view('vendor.create',compact('category'));
        
    }
    public function vendorRegister(Request $request)
    {
        # code...
        // return $request->all();
        
        $this->validate($request, [
            'company_name' => [
                'max:255',
                    Rule::unique('suppliers')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'email' => 'required|email|max:255|unique:suppliers,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone_number' => 'required|digits:10|min:5',
            // 'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);
        
        $lims_supplier_data = $request->all();
        $lims_supplier_data['is_active'] = true;
        
        $password = Hash::make($lims_supplier_data['password']);
        $lims_supplier_data['password'] =  $password;
      

        $vendor_id = Supplier::create($lims_supplier_data)->id;
        
        // print_r($lims_supplier_data);die();
        $data['name'] =  $lims_supplier_data['name'];
        $data['email'] =  $lims_supplier_data['email'];
        $data['password'] =  $password;
        $data['phone'] =  $lims_supplier_data['phone_number'];
        $data['company_name'] =  $lims_supplier_data['company_name'];
        $data['role_id'] = 6;
        $data['vendor_id'] = $vendor_id;
        $data['is_active'] =  $lims_supplier_data['is_active'];

        User::create($data);
       
        $message = 'Data inserted successfully';
        $details = [
            'name'     =>   $lims_supplier_data['name'],
            'email'    =>  $lims_supplier_data['email'],
            'password'     =>   $lims_supplier_data['password'],
            'phone'    =>   $lims_supplier_data['phone_number'],
            'company_name'     =>   $lims_supplier_data['company_name']
            ]; 
            // print_r($details);die();
        try{
           
            $res = Mail::to($lims_supplier_data['email'])->send(new \App\Mail\SupplierMail($details));
        }
        catch(\Exception $e) {
            $message = $e;
            // $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }
      
        return redirect('vendor/vendor-register')->with('message', $message);
    }
}
