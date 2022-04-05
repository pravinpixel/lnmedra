<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Keygen;
use App\Brand;
use App\Category;
use App\User;
use App\Unit;
use App\Sale;
use App\MasterAttribute;
use App\ProductType;
use App\Product;
use App\Purchase;
use App\Expense;
use App\Notifications\ProductCreation;
use App\Tax;
use App\Warehouse;
use App\Supplier;
use App\VendorProduct;
use App\ProductBatch;
use App\Product_Warehouse;
use App\Product_Supplier;
use Auth;
use DNS1D;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use DB;
use App\Variant;
use App\ProductVariant;
use Illuminate\Support\Facades\Validator;

class VendorProductController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('vendorproducts-index')){            
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
                
            return view('vendorproduct.index', compact('all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function productData(Request $request)
    {
      
    }
    
    public function create()
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('vendorproducts-add')){
            
            $productType = ProductType::get();
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            return view('vendorproduct.create',compact('lims_warehouse_list', 'lims_tax_list','lims_unit_list','lims_category_list','lims_brand_list','productType'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        
        $product = Product::findOrFail($request->input('product'));
        $vendorProduct = [
            'created_by' => user()->id,
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
        ];
        $result = $product->vendorProduct()->create($vendorProduct);
        if($result){
            response(['status' => true, 'msg' => 'product addeded']);
        }
        response(['status' => false, 'msg' => 'something went wrong']);
    }
    public function vendorDashboardEdit($id)
    {
        if (!userHasAccess('vendorproducts-edit')) {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
        $lims_brand_list     = Brand::where('is_active', true)->get();
        $lims_category_list  = Category::where('is_active', true)->get();
        $productType         = ProductType::get();
        $lims_product_data   = VendorProduct::with('product')->find($id);
        $lims_unit_list      = Unit::where('is_active', true)->get();
        $lims_tax_list       = Tax::where('is_active', true)->get();
        $lims_warehouse_list = Warehouse::where('is_active', true)->get();
        $lims_product_data['dashboardView'] = 1;
        return view('vendorproduct.edit',compact('id','lims_unit_list', 'lims_tax_list','lims_warehouse_list','lims_brand_list', 'lims_category_list',  'lims_product_data','productType'));
    }


    public function edit($id)
    {
        if(!userHasAccess('vendorproducts-edit')) {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
        $productType = ProductType::get();
        $lims_brand_list = Brand::where('is_active', true)->get();
        $lims_category_list = Category::where('is_active', true)->get();
        $lims_product_data = VendorProduct::where('id', $id)->first();
        return view('vendorproduct.edit',compact('lims_brand_list', 'lims_category_list',  'lims_product_data','productType'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($request->input('product'));
        $vendorProduct = [
            'created_by' => user()->id,
            'qty'        => $request->input('qty'),
            'price'      => $request->input('price'),
            'product_id' => $product->id
        ];
        $result = VendorProduct::findOrFail($id)->update($vendorProduct);
        if($result){
            response(['status' => true, 'msg' => 'product updated']);
        }
        response(['status' => false, 'msg' => 'something went wrong']);
    }

    public function updateProduct(Request $request)
    {
        if(!env('USER_VERIFIED')) {
            \Session::flash('not_permitted', 'This feature is disable for demo!');
        }
        else {
      
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('vendor_products')->ignore($request->input('id'))->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],

                'code' => [
                    'max:255',
                    Rule::unique('vendor_products')->ignore($request->input('id'))->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ]
            ]);
            
            $lims_product_data = VendorProduct::findOrFail($request->input('id'));
            $data = $request->except('image', 'file', 'prev_img');
            $data['name'] = htmlspecialchars(trim($data['name']));
           
            if($request['attribute']){
                $data['attribute'] = implode(',',$request['attribute']);
            }

            if($data['type'] == 'combo') {
                $data['product_list'] = implode(",", $data['product_id']);
              //  $data['variant_list'] = implode(",", $data['variant_id']);
                $data['qty_list'] = implode(",", $data['product_qty']);
                $data['price_list'] = implode(",", $data['unit_price']);
                $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
            }
            elseif($data['type'] == 'digital' || $data['type'] == 'service')
                $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;

            if(!isset($data['featured']))
                $data['featured'] = 0;

            if(!isset($data['promotion']))
                $data['promotion'] = null;

            // if(!isset($data['is_batch']))
            //     $data['is_batch'] = null;

            // if(!isset($data['is_imei']))
            //     $data['is_imei'] = null;

            $data['product_details'] = str_replace('"', '@', $data['product_details']);
            $data['product_details'] = $data['product_details'];

            
            // if($data['starting_date'])
            //     $data['starting_date'] = date('Y-m-d', strtotime($data['starting_date']));
            // if($data['last_date'])
            //     $data['last_date'] = date('Y-m-d', strtotime($data['last_date']));

            $previous_images = [];
            //dealing with previous images
            if($request->prev_img) {
                foreach ($request->prev_img as $key => $prev_img) {
                    if(!in_array($prev_img, $previous_images))
                        $previous_images[] = $prev_img;
                }
                $lims_product_data->image = implode(",", $previous_images);
                $lims_product_data->save();
            }
            else {
                $lims_product_data->image = null;
                $lims_product_data->save();
            }

            //dealing with new images
            if($request->image) {
                $images = $request->image;
                $image_names = [];
                $length = count(explode(",", $lims_product_data->image));
                foreach ($images as $key => $image) {
                    $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                    /*$image = Image::make($image)->resize(512, 512);*/
                    $imageName = date("Ymdhis") . ($length + $key+1) . '.' . $ext;
                    $image->move('public/images/product', $imageName);
                    $image_names[] = $imageName;
                }
                if($lims_product_data->image)
                    $data['image'] = $lims_product_data->image. ',' . implode(",", $image_names);
                else
                    $data['image'] = implode(",", $image_names);
            }
            else
                $data['image'] = $lims_product_data->image;

            $file = $request->file;
            if ($file) {
                $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $fileName = strtotime(date('Y-m-d H:i:s'));
                $fileName = $fileName . '.' . $ext;
                $file->move('public/vendorproduct/files', $fileName);
                $data['file'] = $fileName;
            }

            
          
            $lims_product_data->update($data);
            return response(['data'=>$data,'edit_message'=>\Session::flash('edit_message', 'Product updated successfully')]);
          
        }
    }
    public function getAttributeImage($id)
    {
        
       $data = MasterAttribute::where('product_type',$id)->get();
       foreach($data as $key=>$val)
       {
        $attribute_image = explode(",", $val->image);
        $attribute_image = htmlspecialchars($attribute_image[0]);
        $val['checkbox'] = '<input type="checkbox" name="attribute[]" value='.$val->id.' required>
        <span class="validation-msg"></span>
        ';
        $val['image'] = '<img src="'.url('public/images/attribute', $attribute_image).'" height="60" width="60">';
       }
        // dd($data);
        
          return response()->json(['data' => $data]);
    }
    public function generateCode()
    {
        $id = Keygen::numeric(8)->generate();
        return $id;
    }

    public function search(Request $request)
    {
        $product_code = explode(" ", $request['data']);
        $lims_product_data = VendorProduct::where('code', $product_code[0])->first();

        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->qty;
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->id;
        return $product;
    }

    public function saleUnit($id)
    {
        $unit = Unit::where("base_unit", $id)->orWhere('id', $id)->pluck('unit_name','id');
        return json_encode($unit);
    }

    public function getData($id, $variant_id)
    {
        if($variant_id) {
            $data = VendorProduct::join('vendor_products.id')
                ->select('vendor_products.name')
                ->where('vendor_products.id', $id)->first();
            $data->code = $data->item_code;
        }
        else
            $data = VendorProduct::select('name', 'code')->find($id);
        return $data;
    }

    public function productWarehouseData($id)
    {
        $warehouse = [];
        $qty = [];
        $batch = [];
        $expired_date = [];
        $imei_number = [];
        $warehouse_name = [];
        $variant_name = [];
        $variant_qty = [];
        $product_warehouse = [];
        $product_variant_warehouse = [];
        $lims_product_data = VendorProduct::select('id', 'is_variant')->find($id);
        if($lims_product_data->is_variant) {
            $lims_product_variant_warehouse_data = Product_Warehouse::where('product_id', $lims_product_data->id)->orderBy('warehouse_id')->get();
            $lims_product_warehouse_data = Product_Warehouse::select('warehouse_id', DB::raw('sum(qty) as qty'))->where('product_id', $id)->groupBy('warehouse_id')->get();
            foreach ($lims_product_variant_warehouse_data as $key => $product_variant_warehouse_data) {
                $lims_warehouse_data = Warehouse::find($product_variant_warehouse_data->warehouse_id);
                $lims_variant_data = Variant::find($product_variant_warehouse_data->variant_id);
                $warehouse_name[] = $lims_warehouse_data->name;
                $variant_name[] = $lims_variant_data->name;
                $variant_qty[] = $product_variant_warehouse_data->qty;
            }
        }
        else {
            $lims_product_warehouse_data = Product_Warehouse::where('product_id', $id)->orderBy('warehouse_id', 'asc')->get();
        }
        foreach ($lims_product_warehouse_data as $key => $product_warehouse_data) {
            $lims_warehouse_data = Warehouse::find($product_warehouse_data->warehouse_id);
            if($product_warehouse_data->product_batch_id) {
                $product_batch_data = ProductBatch::select('batch_no', 'expired_date')->find($product_warehouse_data->product_batch_id);
                $batch_no = $product_batch_data->batch_no;
                $expiredDate = date(config('date_format'), strtotime($product_batch_data->expired_date));
            }
            else {
                $batch_no = 'N/A';
                $expiredDate = 'N/A';
            }
            $warehouse[] = $lims_warehouse_data->name;
            $batch[] = $batch_no;
            $expired_date[] = $expiredDate;
            $qty[] = $product_warehouse_data->qty;
            if($product_warehouse_data->imei_number)
                $imei_number[] = $product_warehouse_data->imei_number;
            else
                $imei_number[] = 'N/A';
        }

        $product_warehouse = [$warehouse, $qty, $batch, $expired_date, $imei_number];
        $product_variant_warehouse = [$warehouse_name, $variant_name, $variant_qty];
        return ['product_warehouse' => $product_warehouse, 'product_variant_warehouse' => $product_variant_warehouse];
    }

    /* public function printBarcode()
    {
        $lims_product_list_without_variant = $this->productWithoutVariant();
        $lims_product_list_with_variant = $this->productWithVariant();
        return view('product.print_barcode', compact('lims_product_list_without_variant', 'lims_product_list_with_variant'));
    }

   public function productWithoutVariant()
    {
        return VendorProduct::ActiveStandard()->select('id', 'name', 'code')
                ->whereNull('is_variant')->get();              
      
    }

    public function productWithVariant()
    {
        return VendorProduct::join('product_variants', 'vendor_products.id', 'product_variants.product_id')
                ->ActiveStandard()
                ->whereNotNull('is_variant')
                ->select('vendor_products.id', 'vendor_products.name', 'product_variants.item_code')
                ->orderBy('position')->get();
    }
*/

    public function limsProductSearch(Request $request)
    {
        $product_code = explode("(", $request['data']);
        $product_code[0] = rtrim($product_code[0], " ");
        $lims_product_data = VendorProduct::where([
            ['code', $product_code[0] ],
            ['is_active', true]
        ])->first();
        if(!$lims_product_data) {
            $lims_product_data = VendorProduct::join('product_variants', 'vendor_products.id', 'product_variants.product_id')
                ->select('vendor_products.*', 'product_variants.item_code', 'product_variants.variant_id', 'product_variants.additional_price')
                ->where('product_variants.item_code', $product_code[0])
                ->first();

            $variant_id = $lims_product_data->variant_id;
            $additional_price = $lims_product_data->additional_price;
        }
        else {
            $variant_id = '';
            $additional_price = 0;
        }
        $product[] = $lims_product_data->name;
        if($lims_product_data->is_variant)
            $product[] = $lims_product_data->item_code;
        else
            $product[] = $lims_product_data->code;
        
        $product[] = $lims_product_data->price + $additional_price;
        $product[] = DNS1D::getBarcodePNG($lims_product_data->code, $lims_product_data->barcode_symbology);
        $product[] = $lims_product_data->promotion_price;
        $product[] = config('currency');
        $product[] = config('currency_position');
        $product[] = $lims_product_data->qty;
        $product[] = $lims_product_data->id;
        $product[] = $variant_id;
        return $product;
    }

    /*public function getBarcode()
    {
        return DNS1D::getBarcodePNG('72782608', 'C128');
    }*/

    public function checkBatchAvailability($product_id, $batch_no, $warehouse_id)
    {
        $product_batch_data = ProductBatch::where([
            ['product_id', $product_id],
            ['batch_no', $batch_no]
        ])->first();
        if($product_batch_data) {
            $product_warehouse_data = Product_Warehouse::select('qty')
            ->where([
                ['product_batch_id', $product_batch_data->id],
                ['warehouse_id', $warehouse_id]
            ])->first();
            if($product_warehouse_data) {
                $data['qty'] = $product_warehouse_data->qty;
                $data['product_batch_id'] = $product_batch_data->id;
                $data['expired_date'] = date(config('date_format'), strtotime($product_batch_data->expired_date));
                $data['message'] = 'ok';
            }
            else {
                $data['qty'] = 0;
                $data['message'] = 'This Batch does not exist in the selected warehouse!';
            }            
        }
        else {
            $data['message'] = 'Wrong Batch Number!';
        }
        return $data;
    }

    public function importProduct(Request $request)
    {   
        //get file
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('message', 'Please upload a CSV file');

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
        //looping through other columns
        while($columns=fgetcsv($file))
        {
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
           $data= array_combine($escapedHeader, $columns);
           
           if($data['brand'] != 'N/A' && $data['brand'] != ''){
                $lims_brand_data = Brand::firstOrCreate(['title' => $data['brand'], 'is_active' => true]);
                $brand_id = $lims_brand_data->id;
           }
            else
                $brand_id = null;

           $lims_category_data = Category::firstOrCreate(['name' => $data['category'], 'is_active' => true]);

           $lims_unit_data = Unit::where('unit_code', $data['unitcode'])->first();
           if(!$lims_unit_data)
                return redirect()->back()->with('not_permitted', 'Unit code does not exist in the database.');

           $product = VendorProduct::firstOrNew([ 'name'=>$data['name'], 'is_active'=>true ]);
            if($data['image'])
                $product->image = $data['image'];
            else
                $product->image = 'zummXD2dvAtI.png';

           $product->name = $data['name'];
           $product->code = $data['code'];
           $product->type = strtolower($data['type']);
           $product->barcode_symbology = 'C128';
           $product->brand_id = $brand_id;
           $product->category_id = $lims_category_data->id;
           $product->unit_id = $lims_unit_data->id;
           $product->purchase_unit_id = $lims_unit_data->id;
           $product->sale_unit_id = $lims_unit_data->id;
           $product->cost = $data['cost'];
           $product->price = $data['price'];
           $product->tax_method = 1;
           $product->qty = 0;
           $product->product_details = $data['productdetails'];
           $product->is_active = true;
           $product->save();

            if($data['variantname']) {
                //dealing with variants
                $variant_names = explode(",", $data['variantname']);
                $item_codes = explode(",", $data['itemcode']);
                $additional_prices = explode(",", $data['additionalprice']);
                foreach ($variant_names as $key => $variant_name) {
                    $variant = Variant::firstOrCreate(['name' => $variant_name]);
                    if($data['itemcode'])
                        $item_code = $item_codes[$key];
                    else
                        $item_code = $variant_name . '-'     . $data['code'];
                    
                    if($data['additionalprice'])
                        $additional_price = $additional_prices[$key];
                    else
                        $additional_price = 0;

                        ProductVariant::create([
                            'product_id' => $product->id,
                            'variant_id' => $variant->id,
                            'position' => $key + 1,
                            'item_code' => $item_code,
                            'additional_price' => $additional_price,
                            'qty' => 0
                        ]);
                    }
                    $product->is_variant = true;
                    $product->save();
                }
             }
             return redirect('vendorproducts')->with('import_message', 'Product imported successfully');
        }
    
        public function deleteBySelection(Request $request)
        {
            $product_id = $request['productIdArray'];
            foreach ((array)$product_id as $id) {
                $lims_product_data =VendorProduct::findOrFail($id);
                $lims_product_data->is_active = 2;
                $lims_product_data->save();
            }
            return 'Product deleted successfully!';
        }
       
        public function destroy($id)
        {
            $lims_product_data = VendorProduct::findOrFail($id);
            $lims_product_data->is_active = false;
            if($lims_product_data->image != 'zummXD2dvAtI.png') {
                $images = explode(",", $lims_product_data->image);
                foreach ($images as $key => $image) {
                    if(file_exists('public/images/product/'.$image))
                        unlink('public/images/product/'.$image);
                }
            }
            $lims_product_data->save();
            return redirect('vendorproducts')->with('message', 'Product deleted successfully');
        }
        public function allVendorProductsList(Type $var = null)
        {

            
            $role = Role::find(Auth::user()->role_id);
            if($role->hasPermissionTo('vendor-approval-index')){
                     
                $permissions = Role::findByName($role->name)->permissions;
                foreach ($permissions as $permission)
                    $all_permission[] = $permission->name;
                if(empty($all_permission))
                    $all_permission[] = 'dummy text';
                
                $lims_supplier_list = User::where('role_id',6)->where('is_active', true)->get();
                $lims_warehouse_list = Warehouse::where('is_active', true)->get();
                return view('vendorproduct.all_vendor_product_list', compact('all_permission','lims_warehouse_list','lims_supplier_list'));
            }
            else
                   
                return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
           
        }
        public function vendorDashboard()
        {
        
            $project = VendorProduct::where('created_by',Auth::user()->id)->where('is_active', '!=',2)->count();
            $approved = VendorProduct::where('created_by',Auth::user()->id)->where('is_approve', '=',1)->where('is_active', '=',1)->count();
            $rejected = VendorProduct::where('created_by',Auth::user()->id)->where('is_approve', '=',2)->where('is_active', '=',1)->count();
            $pending = VendorProduct::where('created_by',Auth::user()->id)->where('is_approve', '=',0)->where('is_active', '=',1)->count();
            if(userHasAccess('vendor-dashboard-index')){
                $permissions = Role::findByName($role->name)->permissions;
                foreach ($permissions as $permission)
                    $all_permission[] = $permission->name;
                if(empty($all_permission))
                    $all_permission[] = 'dummy text';
                return view('vendor-dashboard', compact('all_permission','project','approved','rejected','pending'));
            }
            else
                return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
           
        
            // $role = Role::find(Auth::user()->role_id);

            // $project = VendorProduct::where('vendoruserid',Auth::user()->id)->where('is_active', '!=',2)->count();
            // $approved = VendorProduct::where('vendoruserid',Auth::user()->id)->where('is_approve', '=',1)->where('is_active', '=',1)->count();
            // $rejected = VendorProduct::where('vendoruserid',Auth::user()->id)->where('is_approve', '=',2)->where('is_active', '=',1)->count();
            // $pending = VendorProduct::where('vendoruserid',Auth::user()->id)->where('is_approve', '=',0)->where('is_active', '=',1)->count();
            
            // if($role->hasPermissionTo('vendor-dashboard-index')){
                     
            //     $permissions = Role::findByName($role->name)->permissions;
            //     foreach ($permissions as $permission)
            //         $all_permission[] = $permission->name;
            //     if(empty($all_permission))
            //         $all_permission[] = 'dummy text';
            //     return view('vendor-dashboard', compact('all_permission','project','approved','rejected','pending'));
            // }
            // else
                   
            //     return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
           
        }
        public function allVendorproductData(Request $request)
        {

            if ($request->ajax() == true) {
                $draw            = $request->get('draw');
                $start           = $request->get("start");
                $rowperpage      = $request->get("length");
                $columnIndex_arr = $request->get('order');
                $columnName_arr  = $request->get('columns');
                $order_arr       = $request->get('order');
                $search_arr      = $request->get('search');
                $columnIndex     = $columnIndex_arr[0]['column'];
                $columnName      = $columnName_arr[$columnIndex]['data'];
                $columnSortOrder = $order_arr[0]['dir'];
                $searchValue     = $search_arr['value'];
         
                $totalRecords =  VendorProduct::join('products','vendor_products.product_id','=','products.id')
                                    ->where('is_approve', 0)
                                    ->leftJoin('brands','brands.id','=','products.brand_id')
                                    ->leftJoin('categories','categories.id','=','products.category_id')
                                    ->leftJoin('product_types','product_types.id','=','products.type')
                                    ->get()
                                    ->count();

                $records = VendorProduct::join('products','vendor_products.product_id','=','products.id')
                                    ->where('is_approve', 0)
                                    ->leftJoin('brands','brands.id','=','products.brand_id')
                                    ->leftJoin('categories','categories.id','=','products.category_id')
                                    ->leftJoin('product_types','product_types.id','=','products.type')
                                    ->leftJoin('users','users.id','=','vendor_products.created_by')
                                    ->when(!empty($searchValue), function($q) use($searchValue){
                                        $q->where('products.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('categories.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('brands.title', 'like', '%' .$searchValue. '%')
                                        ->orWhere('product_types.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('vendor_products.qty', 'like', '%' .$searchValue. '%')
                                        ->orWhere('vendor_products.price', 'like', '%' .$searchValue. '%')
                                        ->orWhere('products.code', 'like', '%' .$searchValue. '%');
                                    })->select('products.*',
                                        'brands.title as brand_name',
                                        'categories.name as category_name',
                                        'product_types.name as product_type_name',
                                        'vendor_products.id as vendor_id',
                                        'vendor_products.price as vendor_price',
                                        'vendor_products.ln_price as ln_price',
                                        'vendor_products.ln_qty as ln_qty',
                                        'vendor_products.qty as vendor_qty',
                                        'vendor_products.is_approve as vendor_is_approve',
                                        'users.name as user_name',
                                    )
                                    ->orderBy($columnName,$columnSortOrder)
                                    ->skip($start)
                                    ->take($rowperpage == -1 ? $totalRecords : $rowperpage)
                                    ->get();
                $data_arr = array();
                foreach($records as $record){
                    $id                      = $record->id;
                    $code                    = $record->code;
                    $product_name            = $record->name;
                    $brand_name              = $record->brand_name;
                    $category_name           = $record->category_name;
                    $product_type            = $record->product_type_name;
                    $vendor_product_qty      = $record->vendor_qty;
                    $vendor_product_price    = $record->vendor_price;
                    
                    $vendor_product_ln_qty   = '<div class="btn-group">
                        <input type="number" name="ln_qty[]" min="0" id="ln_qty'.$record->vendor_id.'" class="form-control ln_qty check'.$record->vendor_id.'text"  data-qty_row_id="'.$record->vendor_id.'" value="'.$record->ln_qty.'" style="width:70px;" >
                    <div>';
                    $vendor_product_ln_price = '<div class="btn-group">
                            <input type="number" name="ln_price[]" id="ln_price'.$record->vendor_id.'" min="0" class="form-control ln_price check'.$record->vendor_id.'text" data-price_row_id="'.$record->vendor_id.'" value="'.$record->ln_price.'" style="width:70px;">
                    <div>';
                    $user_name               = $record->user_name;
                    $image                   = '<img src="'.url('public/images/product', $record->image).'" height="80" width="80">';
                    $action ='<div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">';
                    $action .=' <li> <a href="'.route('vendorproducts.dashboardEdit', $record->vendor_id).'" class="btn btn-link"><i class="fa fa-edit"></i> Edit </a> </li>';
                    $action .='<li>'. \Form::open(["route" => ["vendorproducts.deletebyVendorDashboard", $record->vendor_id], "method" => "DELETE", 'onsubmit' => 'return confirmDeleteAlert(this);'] ).'
                                    <button type="submit" class="btn btn-link"  ><i class="fa fa-trash"></i> Delete </button> 
                                '.\Form::close().'</li>';
                    $data_arr[] = array(
                        "id"                => $id,
                        "image"             => $image,
                        "code"              => $code,
                        "name"              => $product_name,
                        "brand_name"        => $brand_name,
                        "product_type_name" => $product_type,
                        "category_name"     => $category_name,
                        "vendor_qty"        => $vendor_product_qty,
                        "vendor_price"      => $vendor_product_price,
                        "ln_qty"            => $vendor_product_ln_qty,
                        "ln_price"          => $vendor_product_ln_price,
                        "vendor_is_approve" => $record->vendor_is_approve,
                        "user_name"         => $user_name,
                        "vendor_id"         => $record->vendor_id,
                        "action"            => $action
                    );
                }
                $response = array(
                    "draw" => intval($draw),
                    "iTotalRecords" => $totalRecords,
                    "iTotalDisplayRecords" => $records->count(),
                    "aaData" => $data_arr
                );
                echo json_encode($response);
                return false;
            }


            $columns = array( 
                2 => 'name', 
                3 => 'code',
                4 => 'brand_id',
                5 => 'category_id',            
                6 => 'price'
            );
            
            $totalData = VendorProduct::where('is_active', true)->count();
            $totalFiltered = $totalData; 
    
            if($request->input('length') != -1)
                $limit = $request->input('length');
            else
                $limit = $totalData;
            $start = $request->input('start');
            $order = 'vendor_products.'.$columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            if(empty($request->input('search.value'))){
                
                $products = VendorProduct::with('category', 'brand', 'unit')->offset($start)
                        ->where('is_active', '!=',2)
                            ->where('is_active', true)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                if($request->vendorName)
                {
                    $totalData =VendorProduct::where('vendoruserid',$request->vendorName)->with('category', 'brand', 'unit')->offset($start)
                    ->where('is_active', true)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->count();
                    $totalFiltered = $totalData; 
                    $products = VendorProduct::where('vendoruserid',$request->vendorName)->with('category', 'brand', 'unit')->offset($start)
                      
                            ->where('is_active', true)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
                }
            }
            else
            {
                $search = $request->input('search.value'); 
                $products =  VendorProduct::select('vendor_products.*')
                            ->with('category', 'brand', 'unit')
                            ->join('categories', 'vendor_products.category_id', '=', 'categories.id')
                            ->leftjoin('brands', 'vendor_products.brand_id', '=', 'brands.id')
                            ->where([
                                ['vendor_products.name', 'LIKE', "%{$search}%"],
                                ['vendor_products.is_active', true]
                            ])
                            ->orWhere([
                                ['vendor_products.code', 'LIKE', "%{$search}%"],
                                ['vendor_products.is_active', true]
                            ])
                            ->orWhere([
                                ['categories.name', 'LIKE', "%{$search}%"],
                                ['categories.is_active', true],
                                ['vendor_products.is_active', true]
                            ])
                            ->orWhere([
                                ['brands.title', 'LIKE', "%{$search}%"],
                                ['brands.is_active', true],
                                ['vendor_products.is_active', true]
                            ])
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)->get();
    
                $totalFiltered = VendorProduct::
                                join('categories', 'vendor_products.category_id', '=', 'categories.id')
                                ->leftjoin('brands', 'vendor_products.brand_id', '=', 'brands.id')
                                ->where([
                                    ['vendor_products.name','LIKE',"%{$search}%"],
                                    ['vendor_products.is_active', true]
                                ])
                                ->orWhere([
                                    ['vendor_products.code', 'LIKE', "%{$search}%"],
                                    ['vendor_products.is_active', true]
                                ])
                                ->orWhere([
                                    ['categories.name', 'LIKE', "%{$search}%"],
                                    ['categories.is_active', true],
                                    ['vendor_products.is_active', true]
                                ])
                                ->orWhere([
                                    ['brands.title', 'LIKE', "%{$search}%"],
                                    ['brands.is_active', true],
                                    ['vendor_products.is_active', true]
                                ])
                                ->count();
            }
            $data = array();
            if(!empty($products))
            {
                foreach ($products as $key=>$product)
                {
             
                    $nestedData['id'] = $product->id;
                    $nestedData['key'] = $key;
                    $product_image = explode(",", $product->image);
                    $product_image = htmlspecialchars($product_image[0]);
                    $nestedData['image'] = '<img src="'.url('public/images/product', $product_image).'" height="80" width="80">';


                    $userData = User::where('id',$product->vendoruserid)->select('name')->first();
                      
                    $nestedData['user_name'] = $userData['name'];
                    $nestedData['name'] = $product->name;

                    $nestedData['code'] = $product->code;
                    if($product->brand_id)
                        $nestedData['brand'] = $product->brand->title;
                    else
                        $nestedData['brand'] = "N/A";
                    $nestedData['category'] = $product->category->name;
                    $nestedData['qty'] = $product->qty;
                    $nestedData['is_approve'] = $product->is_approve;
                    // if($product->unit_id)
                    //     $nestedData['unit'] = $product->unit->unit_name;
                    // else
                    //     $nestedData['unit'] = 'N/A';
                    
                    $nestedData['price'] = $product->price;
                    $nestedData['cost'] = $product->cost;
                    
                    if(config('currency_position') == 'prefix')
                        $nestedData['stock_worth'] = config('currency').' '.($product->qty * $product->price).' / '.config('currency').' '.($product->qty * (float)$product->cost);
                    else
                        $nestedData['stock_worth'] = ($product->qty * $product->price).' '.config('currency').' / '.($product->qty * $product->cost).' '.config('currency');
                    //$nestedData['stock_worth'] = ($product->qty * $product->price).'/'.($product->qty * $product->cost);
                    if($product->is_approve == 1)
                    {
                        $nestedData['ln_qty'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_qty[]" min="0" id="ln_qty'.$product->id.'" class="form-control ln_qty check'.$product->id.'text"  data-qty_row_id="'.$product->id.'" value="'.$product->ln_qty.'" style="width:70px;" readonly >
    
                        <div>';
                    }
                    elseif($product->is_approve == 2)
                    {
                        $nestedData['ln_qty'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_qty[]" min="0" id="ln_qty'.$product->id.'" class="form-control ln_qty check'.$product->id.'text"  data-qty_row_id="'.$product->id.'" value="'.$product->ln_qty.'" style="width:70px;" readonly >
    
                        <div>';
                    }
                    elseif($product->is_approve == 0)
                    {
                        $nestedData['ln_qty'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_qty[]" min="0" id="ln_qty'.$product->id.'" class="form-control ln_qty check'.$product->id.'text"  data-qty_row_id="'.$product->id.'" value="'.$product->ln_qty.'" style="width:70px;" >
    
                        <div>';
                    }

                    if($product->is_approve == 1)
                    {
                        $nestedData['ln_price'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_price[]" id="ln_price'.$product->id.'" min="0" class="form-control ln_price check'.$product->id.'text" data-price_row_id="'.$product->id.'" value="'.$product->ln_price.'" style="width:70px;" readonly>
    
                        <div>';
                    }
                    elseif($product->is_approve == 0)
                    {
                        $nestedData['ln_price'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_price[]" id="ln_price'.$product->id.'" min="0" class="form-control ln_price check'.$product->id.'text" data-price_row_id="'.$product->id.'" value="'.$product->ln_price.'" style="width:70px;">
    
                        <div>';
                    } 
                    elseif($product->is_approve == 2) {
                        $nestedData['ln_price'] = '<div class="btn-group">
                    
                        <input type="number" name="ln_price[]" id="ln_price'.$product->id.'" min="0" class="form-control ln_price check'.$product->id.'text" data-price_row_id="'.$product->id.'" value="'.$product->ln_price.'" style="width:70px;" readonly>
    
                        <div>';
                    }
                   
                   
                    $nestedData['discount'] = '<div class="btn-group">
                    <input type="text" class="discount-value form-control discount" min="0" name="discount[]" data-discount_row_id="'.$product->id.'" value="'.$product->discount.'" style="width:70px;"/>
                    <div>';
                    $unit = Unit::where('is_active',1)->get();
                    $nestedData['unit'] = '<div class="btn-group">

                    <select name="edit_tax_rate[]" class="form-control">';
                        foreach($unit as $key => $name)
                        {
                            $nestedData['unit'] .= '<option value='.$name['id'].'>'.$name['unit_name'].'</option>';
                        }
                        $nestedData['unit'] .='</select>
                    </div>';

                                $tax = Tax::where('is_active',1)->get();
                               
                              
                                $nestedData['tax'] = '<div class="btn-group">

                            <select name="edit_tax_rate[]" class="form-control">';
                                foreach($tax as $key => $name)
                                {
                                    $nestedData['tax'] .= '<option value='.$name['id'].'>'.$name['name'].'</option>';
                                }
                                $nestedData['tax'] .='</select>
                            </div>';
                  
                    if($product->is_approve == 1)
                    {
                        $nestedData['options'] = 'Approved';
                    }
                    else if($product->is_approve == 2)
                    {
                        $nestedData['options'] = 'Rejected';
                    }
                    else{
                        $nestedData['options'] = '<div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button="type" class="btn btn-link view"><i class="fa fa-eye"></i> '.trans('file.View').'</button>
                                </li>';
                    if(in_array("vendorproducts-edit", $request['all_permission']))
                        $nestedData['options'] .= '<li>
                                <a href="'.route('vendorproducts.edit', $product->id).'" class="btn btn-link"><i class="fa fa-edit"></i> '.trans('file.edit').'</a>
                            </li>';
                    if(in_array("vendorproducts-delete", $request['all_permission']))
                        $nestedData['options'] .= \Form::open(["route" => ["vendorproducts.destroy", $product->id], "method" => "DELETE", 'onsubmit' => 'return confirmDeleteAlert(this);'] ).'
                                <li>
                                  <button type="submit" class="btn btn-link"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> 
                                </li>'.\Form::close().'
                            </ul>
                        </div>';

                    }
                    
                    // data for product details by one click
                    // if($product->tax_id)
                    //     $tax = Tax::find($product->tax_id)->name;
                    // else
                    //     $tax = "N/A";
    
                    // if($product->tax_method == 1)
                    //     $tax_method = trans('file.Exclusive');
                    // else
                    //     $tax_method = trans('file.Inclusive');
    
                    $nestedData['product'] = array( '[ "'.$product->type.'"', ' "'.$product->name.'"', ' "'.$product->code.'"', ' "'.$nestedData['brand'].'"', ' "'.$nestedData['category'].'"',' "'.$product->price.'"',  ' "'.preg_replace('/\s+/S', " ", $product->product_details).'"', ' "'.$product->id.'"', ' "'.$product->product_list.'"',  ' "'.$product->price_list.'"',  ' "'.$product->image.'"',' "'.$product->qty.'"]'
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
        
        public function deletebyVendorDashboard($id)
        {
            $lims_product_data =VendorProduct::findOrFail($id);
            $lims_product_data->delete();
            return redirect()->back()->with('message', 'Product deleted successfully');
        }

        public function vendorDashboardData(Request $request)
        {
            if ($request->ajax() == true) {
                $draw            = $request->get('draw');
                $start           = $request->get("start");
                $rowperpage      = $request->get("length");
                $columnIndex_arr = $request->get('order');
                $columnName_arr  = $request->get('columns');
                $order_arr       = $request->get('order');
                $search_arr      = $request->get('search');
                $columnIndex     = $columnIndex_arr[0]['column'];
                $columnName      = $columnName_arr[$columnIndex]['data'];
                $columnSortOrder = $order_arr[0]['dir'];
                $searchValue     = $search_arr['value'];
         
                $totalRecords =  VendorProduct::join('products','vendor_products.product_id','=','products.id')
                                    ->leftJoin('brands','brands.id','=','products.brand_id')
                                    ->leftJoin('categories','categories.id','=','products.category_id')
                                    ->leftJoin('product_types','product_types.id','=','products.type')
                                    ->where('vendor_products.created_by', user()->id)
                                    ->get()
                                    ->count();

                $records = VendorProduct::join('products','vendor_products.product_id','=','products.id')
                                    ->leftJoin('brands','brands.id','=','products.brand_id')
                                    ->leftJoin('categories','categories.id','=','products.category_id')
                                    ->leftJoin('product_types','product_types.id','=','products.type')
                                    ->where('vendor_products.created_by', user()->id)
                                    ->when(!empty($searchValue), function($q) use($searchValue){
                                        $q->where('products.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('categories.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('brands.title', 'like', '%' .$searchValue. '%')
                                        ->orWhere('product_types.name', 'like', '%' .$searchValue. '%')
                                        ->orWhere('vendor_products.qty', 'like', '%' .$searchValue. '%')
                                        ->orWhere('vendor_products.price', 'like', '%' .$searchValue. '%')
                                        ->orWhere('products.code', 'like', '%' .$searchValue. '%');
                                    })->select('products.*',
                                        'brands.title as brand_name',
                                        'categories.name as category_name',
                                        'product_types.name as product_type_name',
                                        'vendor_products.id as vendor_id',
                                        'vendor_products.price as vendor_price',
                                        'vendor_products.qty as vendor_qty',
                                        'vendor_products.is_approve as vendor_is_approve'
                                    )
                                    ->orderBy($columnName,$columnSortOrder)
                                    ->skip($start)
                                    ->take($rowperpage == -1 ? $totalRecords : $rowperpage)
                                    ->get();
                $data_arr = array();
                foreach($records as $record){
                    $id                   = $record->id;
                    $code                 = $record->code;
                    $product_name         = $record->name;
                    $brand_name           = $record->brand_name;
                    $category_name        = $record->category_name;
                    $product_type         = $record->product_type_name;
                    $vendor_product_qty   = $record->vendor_price;
                    $vendor_product_price = $record->vendor_qty;
                    if($record->vendor_is_approve == 1){
                        $approve_status = '<span class="badge badge-danger">Rejected</span>';
                    } else if($record->vendor_is_approve == 2){
                        $approve_status = '<span class="badge badge-danger">Approved</span>';
                    } else {
                        $approve_status = '<span class="badge badge-info">Pending</span>';
                    }
                    $action ='<div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">';
                    $action .=' <li> <a href="'.route('vendorproducts.dashboardEdit', $record->vendor_id).'" class="btn btn-link"><i class="fa fa-edit"></i> Edit </a> </li>';
                    $action .='<li>'. \Form::open(["route" => ["vendorproducts.deletebyVendorDashboard", $record->vendor_id], "method" => "DELETE", 'onsubmit' => 'return confirmDeleteAlert(this);'] ).'
                                    <button type="submit" class="btn btn-link"  ><i class="fa fa-trash"></i> Delete </button> 
                                '.\Form::close().'</li>';
                    $data_arr[] = array(
                        "id"                => $id,
                        "code"              => $code,
                        "name"              => $product_name,
                        "brand_name"        => $brand_name,
                        "product_type_name" => $product_type,
                        "category_name"     => $category_name,
                        "vendor_qty"        => $vendor_product_qty,
                        "vendor_price"      => $vendor_product_price,
                        "vendor_is_approve" => $approve_status,
                        "action"            => $action
                    );
                }
                $response = array(
                    "draw" => intval($draw),
                    "iTotalRecords" => $totalRecords,
                    "iTotalDisplayRecords" => $records->count(),
                    "aaData" => $data_arr
                );
                echo json_encode($response);
            }
        }
        
        public function lnQtyStore(Request $request)
        {
            
            $data = VendorProduct::find($request['row_id']);
            $data->ln_qty = $request['row_qty_value'];
            $res = $data->update();
           
            return true;
            
        }
        public function lnPriceStore(Request $request)
        {
           
            $data = VendorProduct::find($request['row_id']);
            $data->ln_price = $request['row_price_value'];
            $res = $data->update();
           
            return true;
            
        }
        public function lnDiscountStore(Request $request)
        {
            # code...
            
            $data = VendorProduct::find($request['row_id']);
            $data->discount = $request['row_discount_value'];
            $res = $data->update();
           
            return true;
        }

        public function vendorProductDeny(Request $request)
        {
            $ids = $request->input('productIdArray');
            $vendorProducts = VendorProduct::find($ids);
            foreach($vendorProducts as $vendorProduct){
                $vendorProduct->is_approve = 2;
                $vendorProduct->save();
            }
            return response(['status' => true, 'msg' => 'Product rejected successfully']);
        }

        public function approveProducts(Request $request)
        {
            $ids = $request->input('selectedRow');
            $vendorProducts = VendorProduct::find($ids);
            foreach($vendorProducts as $vendorProduct){
                $vendorProduct->is_approve = 1;
                $vendorProduct->save();
            }
            return response(['status' => true, 'msg' => 'Product approved successfully']);
        }
        public function vendorDashboardStatus(Request $request)
        {
             // return $request->id;
            $data = VendorProduct::where('id',$request->id)->first();
            if($data->is_active == true){
                $data->is_active = false;
            }else{
                $data->is_active = true;
            }
            
            $res = $data->save();
            if($res)
            {
                return response()->json(['status', 'Status Updated successfully!']);
            }
        }
        public function getEditAttributeImage(Request $request,$id)
    {
       $dd = explode(",",$request->data);
        // dd($dd);
        
        $data = MasterAttribute::where('product_type',$id)->get();
        foreach($data as $key=>$val)
        {
         $attribute_image = explode(",", $val->image);
         $attribute_image = htmlspecialchars($attribute_image[0]);
         if(in_array("$val->id",$dd))
         {
            $val['checkbox'] = '<input type="checkbox" name="attribute[]" checked value='.$val->id.' required>
            ';
         }
         else{
            $val['checkbox'] = '<input type="checkbox" name="attribute[]" value='.$val->id.' required>';
         }
        
         $val['image'] = '<img src="'.url('public/images/attribute', $attribute_image).'" height="60" width="60">';
        }
         // dd($data);
         
           return response()->json(['data' => $data]);
    }

    public function addProduct(Request $request)
    {  
        $this->validate($request, [
            'code' => [
                'max:255',
                    Rule::unique('products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'name' => [
                'max:255',
                    Rule::unique('products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ]
        ]);
        $data = $request->except('image', 'file');
        $data['name'] = htmlspecialchars(trim($data['name']));
        $data['product_details'] = str_replace('"', '@', $data['product_details']);
        if($request['attribute']){
            $data['attribute'] = implode(',',$request['attribute']);
        }
        if($data['starting_date'])
            $data['starting_date'] = date('Y-m-d', strtotime($data['starting_date']));
        if($data['last_date'])
            $data['last_date'] = date('Y-m-d', strtotime($data['last_date']));
        $data['is_active'] = true;
        $images = $request->image;
        $image_names = [];
        if($images) {            
            foreach ($images as $key => $image) {
                $imageName = $image->getClientOriginalName();
                $image->move('public/images/product', $imageName);
                $image_names[] = $imageName;
            }
            $data['image'] = implode(",", $image_names);
        }
        else {
            $data['image'] = 'zummXD2dvAtI.png';
        }
        $file = $request->file;
        if ($file) {
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move('public/product/files', $fileName);
            $data['file'] = $fileName;
        }
        $lims_product_data = Product::create($data);
        if($lims_product_data){
            $user = User::find(1);
            $user->notify(new ProductCreation($lims_product_data));
        }
        //dealing with product variant
        if(!isset($data['is_batch']))
            $data['is_batch'] = null;
        if(isset($data['is_variant'])) {
            foreach ($data['variant_name'] as $key => $variant_name) {
                $lims_variant_data = Variant::firstOrCreate(['name' => $data['variant_name'][$key]]);
                $lims_variant_data->name = $data['variant_name'][$key];
                $lims_variant_data->save();
                $lims_product_variant_data = new ProductVariant;             
                $lims_product_variant_data->product_id = $lims_product_data->id;
                $lims_product_variant_data->variant_id = $lims_variant_data->id;
                $lims_product_variant_data->position = $key + 1;
                $lims_product_variant_data->item_code = $data['item_code'][$key];
                $lims_product_variant_data->additional_price = $data['additional_price'][$key];
                $lims_product_variant_data->qty = 0;
                $lims_product_variant_data->save();
            }
        }
        if(isset($data['is_diffPrice'])) {
            foreach ($data['diff_price'] as $key => $diff_price) {
                if($diff_price) {
                    Product_Warehouse::create([
                        "product_id" => $lims_product_data->id,
                        "warehouse_id" => $data["warehouse_id"][$key],
                        "qty" => 0,
                        "price" => $diff_price
                    ]);
                }
            }
        }
       return response(['status' => true, 'data' => $lims_product_data]);
    }

}
    