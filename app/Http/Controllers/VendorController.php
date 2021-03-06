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
use App\Notifications\VendorNotification;

class VendorController extends Controller
{
    public function vendorregisterview()
    {
        $parentCategories = Category::whereNull('parent_id')
            ->get();
        $subCategories = Category::get()
            ->groupBy('parent_id');
        $categories = [];
        foreach ($parentCategories as $parent) {
            if (!empty($subCategories[$parent->id])) {
                $categories[$parent->name] = $subCategories[$parent->id];
            }
        }
        return view('vendor.create', compact('categories'));
    }
    public function vendorRegister(Request $request)
    {
        // print_r($request->all());
        // die();

        // $attributeNames = array(
        //     'entity_name'  => 'Pan No',
        // );
        $this->validate($request, [
            'company_name' => [
                'max:255',
                Rule::unique('suppliers')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'name' => [
                'max:255',
                Rule::unique('suppliers')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'email' => 'required|email|max:255|unique:suppliers,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone_number' => 'required|digits:10|unique:suppliers,phone_number|min:5',
            'entity_name' => 'required'

        ], []);
        // ], [],$attributeNames);

        $lims_supplier_data = $request->all();
        $lims_supplier_data['is_active'] = true;

        $password = Hash::make($lims_supplier_data['password']);
        $lims_supplier_data['password'] =  $password;

        $lims_supplier_data['category'] = json_encode($lims_supplier_data['category']);
        $lims_supplier_data['nursery_code'] = strtoupper($lims_supplier_data['nursery_code']);
        $vendor_id = Supplier::create($lims_supplier_data)->id;

        $data['name'] =  $lims_supplier_data['name'];
        $data['email'] =  $lims_supplier_data['email'];
        $data['password'] =  $password;
        $data['phone'] =  $lims_supplier_data['phone_number'];
        $data['company_name'] =  $lims_supplier_data['company_name'];
        $data['role_id'] = 6;
        $data['vendor_id'] = $vendor_id;
        $data['is_active'] =  $lims_supplier_data['is_active'];

        $vendorUser = User::create($data);

        if ($vendorUser) {
            $user = User::find(1);
            $user->notify(new VendorNotification($vendorUser));
        }
        $message = 'Vendor register successfully';
        $details = [
            'name'     =>   $lims_supplier_data['name'],
            'email'    =>  $lims_supplier_data['email'],
            'password'     =>   $lims_supplier_data['password'],
            'phone'    =>   $lims_supplier_data['phone_number'],
            'company_name'     =>   $lims_supplier_data['company_name']
        ];

        try {

            $res = Mail::to($lims_supplier_data['email'])->send(new \App\Mail\SupplierMail($details));
        } catch (\Exception $e) {
            $message = $e;
            $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }

        return redirect('/login')->with('message', $message);
        // return view('login')->with('message', $message);
    }
}
