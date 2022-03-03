<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Supplier;
use App\Enquiry;
use App\MailTemplate;
use App\EnquiryMailAttachment;
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
    public function enquiryMail($id)
    {
        # code...
        
        $data = Enquiry::where('id',$id)->first()->toArray();
        $mailDetail = MailTemplate::where('is_active', true)->get();
        // print_r($mailDetail[0]['mail_content']);die();
        $documentData =  $mailDetail[0]['mail_content'];
        $keyData  = array_keys($data);
        $valueData  = array_values($data);
        $new_string = str_replace($keyData,$valueData,strval($documentData));

        $search = array('{','}');
        $mailDetail[0]['mail_content'] = str_replace($search,"",$new_string);
        return view('enquiry.enquiry-mail',compact('data','mailDetail'));
    }
    public function enquirySentMail(Request $request)
    {
        // print_r($request['subject']);die();
        $filePath = 'images/enquiry_attachment/';
        $path = public_path($filePath); 
        if(!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
            
        $files = [];
        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
               if($file->extension() == "pdf")
               {
                // print_r("if"." ".$file->getClientOriginalName()." ");
                $name = $file->getClientOriginalName().'.'.$file->extension();
                $file->move(public_path('images/enquiry_attachment'), $name);  
                $files[] = $name; 
               } 
        
            }
           
         }


        
        $data = new EnquiryMailAttachment();
        $data->enquiry_id = $request['enquiry_id'];
        $data->enquiry_email = $request['email'];
        $data->bcc = $request['bcc'];
        $data->cc = $request['cc'];
        $data->mail_content = $request['mail_content'];
        $data->attachment = json_encode($files);
        $data->is_active = true;
        $data->save();
        $details = [
            
            'email'    =>  $request['email'],
           
            'mail_content'    =>  $request['mail_content'],
            
            ]; 
          
        $ccMail = explode(",",$request['cc']);
        $bccMail = explode(",",$request['bcc']);
       
        try{
       
            $res = Mail::to($request['email'])->cc($ccMail)->bcc($bccMail)->send(new \App\Mail\EnquiryMailTemplate($details));

        }
        catch(\Exception $e) {
            $message = $e;
            $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }

        return redirect('enquiry')->with('message','Enquiry Mail Sent Successfully');

    }


}
