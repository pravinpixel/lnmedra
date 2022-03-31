<?php

namespace App\Http\Controllers;
use App\AccountsDate;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
class AccountsDateController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('accounts-date-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            return view('accounts-date.index', compact('all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    
    public function AccountsData(Request $request)
    {
        $columns = array( 
            2 => 'accounts_date_name', 
            3 => 'percentage',
           
          
        );
        
        $totalData = AccountsDate::where('is_active','!=',2)->count();
        // print_r($totalData);die();
        $totalFiltered = $totalData; 

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'accounts_dates.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value'))){
          
            // $products = AccountsDate::where('is_active',true)->get();

            $products = AccountsDate::where('is_active','!=',2)->offset($start)
                            ->limit($limit)
                            ->orderBy($order, $dir)
                            ->get();

        }
        else
        {
           
            $search = $request->input('search.value'); 
            $products =  AccountsDate::select('accounts_dates.*')
            ->where([
                ['accounts_dates.accounts_date_name', 'LIKE', "%{$search}%"],
                ['accounts_dates.is_active','!=',2]
            ])
            ->orWhere([
                ['accounts_dates.percentage', 'LIKE', "%{$search}%"],
                ['accounts_dates.is_active','!=',2]
            ])
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
            $totalFiltered = count($products);
            $totalData= $totalFiltered;

            // $totalFiltered = AccountsDate::where([
            //                     ['accounts_dates.accounts_date_name','LIKE',"%{$search}%"],
            //                     ['accounts_dates.is_active', '!=',2]
            //                 ])->orWhere([
            //                     ['accounts_dates.percentage', 'LIKE', "%{$search}%"],
            //                     ['accounts_dates.is_active', '!=',2]
                               
            //                 ])->count();
        }
  
        $data = array();
        if(!empty($products))
        {
            foreach ($products as $key=>$product)
            {
                // print_r($product->id);die();
                $nestedData['id'] = $product['id'];
                //  print_r($product);die();
                $nestedData['key'] = $key+1;
               
                $nestedData['accounts_date_name'] = $product['accounts_date_name'];
                $nestedData['percentage'] = $product['percentage'];
                if($product['is_active'])
                {
                    $nestedData['is_active'] = '<div class="badge badge-success">'.trans('file.Active').'</div>';
                }
                else{
                    $nestedData['is_active'] = '<div class="badge badge-danger">'.trans('file.InActive').'</div>';
                }
                $nestedData['description'] = $product['description'];
                $nestedData['options'] = '<div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            ';
                            
                         
                if(in_array("attribute-index", $request['all_permission']))
                    $nestedData['options'] .= '<li>
                            <a href="'.route('accounts-date.edit', $product['id']).'" class="btn btn-link"><i class="fa fa-edit"></i> '.trans('file.edit').'</a>
                        </li>';
                if(in_array("attribute-index", $request['all_permission']))
                    $nestedData['options'] .= \Form::open(["route" => ["accounts-date.destroy", $product['id']], "method" => "DELETE"] ).'
                            <li>
                              <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> 
                            </li>'.\Form::close().'
                        </ul>
                    </div>';
               
                // $nestedData['product'] = array( '[ "'.$product['accounts_date_name'].'"', ' "'.$product['percentage'].'"',' "'.$product['description'].'"]'
                // );
                //$nestedData['imagedata'] = DNS1D::getBarcodePNG($product->code, $product->barcode_symbology);
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data);
    }
    public function create()
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('products-add')){
            // $product_type = ProductType::where('is_active', true)->get();
            return view('accounts-date.create');
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'accounts_date_name' => 'required|max:255|unique:accounts_dates',
            
         
        ]);
        $data['accounts_date_name'] = $request->accounts_date_name;
        $data['percentage'] = $request->percentage;
        $data['description'] = $request->description;
        $data['is_active'] = 1;
       
        AccountsDate::create($data);
        return redirect('accounts-date')->with('message', 'Accounts Added Successfully');
    }
    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('attribute-index')) {
          
            $data = AccountsDate::where('id',$id)->where('is_active',true)->first();
            // $product_type  = AccountsDate::where('is_active',true)->get();
            //    print_r($data);die();

            return view('accounts-date.edit',compact('data'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           

            'accounts_date_name' => [
                'max:255',
                    Rule::unique('accounts_dates')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
           
        ]);
        // $request->all();
        $data = AccountsDate::where('id', $id)->first();
        $data->accounts_date_name = $request->accounts_date_name;
        $data->percentage = $request->percentage;
        $data->description = $request->description;
       
        $data->save();
        return redirect('accounts-date')->with('message', 'Accounts Added Successfully');
        // return redirect('master_attribute')->with('message', 'Data updated successfully');
    }
    public function destroy($id)
    {
        $lims_attribute_data = AccountsDate::findOrFail($id);
        $lims_attribute_data->is_active = 2;
        $lims_attribute_data->save();
        return redirect('accounts-date')->with('not_permitted','Data deleted successfully');
    }
}
