<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Auth;
use App\MasterAttribute;
use App\ProductType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class MasterAttributeController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('attribute-index')){
            // dd("ff");          
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            return view('master_attribute.index', compact('all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
       
    }
    
    public function productTypeData(Request $request)
    {
        $columns = array( 
            2 => 'title', 
            3 => 'shorting',
            4 => 'project_type',
          
        );
        
        $totalData = MasterAttribute::where('is_active', true)->count();
        $totalFiltered = $totalData; 

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'master_attributes.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value'))){
          
            $products = MasterAttribute::where('is_active', true)->get();
        }
        else
        {
           
            $search = $request->input('search.value'); 
            $products =  MasterAttribute::select('master_attributes.*')
                        ->where([
                            ['master_attributes.title', 'LIKE', "%{$search}%"],
                            ['master_attributes.is_active', true]
                        ])
                        ->orWhere([
                            ['master_attributes.shorting', 'LIKE', "%{$search}%"],
                            ['master_attributes.is_active', true]
                        ])
                        ->limit($limit)
                        ->orderBy($order,$dir)->get()->toArray();

            $totalFiltered = MasterAttribute::where([
                                ['master_attributes.title','LIKE',"%{$search}%"],
                                ['master_attributes.is_active', true]
                            ])->orWhere([
                                ['master_attributes.shorting', 'LIKE', "%{$search}%"],
                                ['master_attributes.is_active', true]
                               
                            ])->count();
        }
  
        $data = array();
        if(!empty($products))
        {
            foreach ($products as $key=>$product)
            {
                // print_r($product);die();
                $nestedData['id'] = $product->id;
                $nestedData['key'] = $key+1;
                $product_image = explode(",", $product->image);
                $product_image = htmlspecialchars($product_image[0]);
                $nestedData['image'] = '<img src="'.url('public/images/attribute', $product_image).'" height="60" width="60">';
                $nestedData['title'] = $product->title;
                $nestedData['shorting'] = $product->shorting;

                $productType = ProductType::where('id',$product->product_type)->first();
                $nestedData['product_type'] = $productType->name;

                $nestedData['options'] = '<div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            ';
                            // <li>
                            //     <button="type" class="btn btn-link view"><i class="fa fa-eye"></i> '.trans('file.View').'</button>
                            // </li>
                if(in_array("attribute-edit", $request['all_permission']))
                    $nestedData['options'] .= '<li>
                            <a href="'.route('master-attribute.edit', $product->id).'" class="btn btn-link"><i class="fa fa-edit"></i> '.trans('file.edit').'</a>
                        </li>';
                if(in_array("attribute-delete", $request['all_permission']))
                    $nestedData['options'] .= \Form::open(["route" => ["master-attribute.destroy", $product->id], "method" => "DELETE"] ).'
                            <li>
                              <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> 
                            </li>'.\Form::close().'
                        </ul>
                    </div>';
                // data for product details by one click
               

                $nestedData['product'] = array( '[ "'.$product->title.'"', ' "'.$product->shorting.'"',' "'.$product->image.'"]'
                );
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
            $product_type = ProductType::where('is_active', true)->get();
            return view('master_attribute.create',compact('product_type'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'title' => 'required|max:255|unique:master_attributes',
            
         
        ]);
        $data['title'] = $request->title;
        $data['shorting'] = $request->shorting;
        $data['product_type'] = $request->product_type;
        $data['is_ative'] = 1;
        
        $file = $request->image;
        if ($file) {
            
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move('public/images/attribute', $fileName);
            $data['image'] = $fileName;
        }
        MasterAttribute::create($data);
        return redirect('master-attribute')->with('message', 'Attribute Added Successfully');
    }
    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('attribute-edit')) {
          
            $data = MasterAttribute::where('id',$id)->first();
            // $productType = ProductType::where('is_active',true)->where('id','=',$data->product_type)->first();
            $product_type  = ProductType::where('is_active',true)->get();
            // $data['product_type'] =  $productType['name'];
        //    print_r($data);die();

            return view('master_attribute.edit',compact('data', 'product_type'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           

            'title' => [
                'max:255',
                    Rule::unique('master_attributes')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
           
        ]);
        // $request->all();
        $data = MasterAttribute::where('id', $id)->first();
        $data->title = $request->title;
        $data->shorting = $request->shorting;
        $data->product_type = $request->product_type;
    //    print_r($data);die();
    // dd($request->image);
        $file = $request->image;
        if ($file) {
            // dd("f");
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move('public/images/attribute', $fileName);
            $data->image = $fileName;
        }
        $data->save();
        return redirect('master-attribute')->with('message', 'Attribute Added Successfully');
        // return redirect('master_attribute')->with('message', 'Data updated successfully');
    }
    public function destroy($id)
    {
        $lims_attribute_data = MasterAttribute::findOrFail($id);
        $lims_attribute_data->is_active = 2;
        $lims_attribute_data->save();
        return redirect('master-attribute')->with('not_permitted','Data deleted successfully');
    }
}
