<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Keygen;
use App\Brand;
use App\Category;
use App\User;
use App\Unit;
use App\Sale;
use App\Product;
use App\Purchase;
use App\Expense;
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
                        ->where('is_active', true)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
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
         //print_r($products);die();
        if(!empty($products))
        {
            foreach ($products as $key=>$product)
            {
                $nestedData['id'] = $product->id;
                $nestedData['key'] = $key;
                $product_image = explode(",", $product->image);
                $product_image = htmlspecialchars($product_image[0]);
                $nestedData['image'] = '<img src="'.url('public/images/vendorproduct', $product_image).'" height="80" width="80">';
                $nestedData['name'] = $product->name;
                $nestedData['code'] = $product->code;
                if($product->brand_id)
                    $nestedData['brand'] = $product->brand->title;
                else
                    $nestedData['brand'] = "N/A";
                $nestedData['category'] = $product->category->name;
                $nestedData['qty'] = $product->qty;
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
                    $nestedData['options'] .= \Form::open(["route" => ["vendorproducts.destroy", $product->id], "method" => "DELETE"] ).'
                            <li>
                              <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> 
                            </li>'.\Form::close().'
                        </ul>
                    </div>';
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
        //print_r($data);die();
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
        if ($role->hasPermissionTo('vendorproducts-add')){
            
         //   $lims_product_list_without_variant = $this->productWithoutVariant();
          //  $lims_product_list_with_variant = $this->productWithVariant();
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
             
            return view('vendorproduct.create',compact('lims_brand_list', 'lims_category_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => [
                'max:255',
                    Rule::unique('vendor_products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'name' => [
                'max:255',
                    Rule::unique('vendor_products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ]
        ]);
        $data = $request->except('image', 'file');
        $data['name'] = htmlspecialchars(trim($data['name']));
       
        if($data['type'] == 'combo'){
            $data['product_list'] = implode(",", $data['product_id']);
           // $data['variant_list'] = implode(",", $data['variant_id']);
            $data['qty_list'] = implode(",", $data['product_qty']);
            $data['price_list'] = implode(",", $data['unit_price']);
            $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
        }
        elseif($data['type'] == 'digital' || $data['type'] == 'service')
            $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;

        $data['product_details'] = str_replace('"', '@', $data['product_details']);

        // if($data['starting_date'])
        //     $data['starting_date'] = date('Y-m-d', strtotime($data['starting_date']));
        // if($data['last_date'])
        //     $data['last_date'] = date('Y-m-d', strtotime($data['last_date']));
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
            $file->move('public/vendorproduct/files', $fileName);
            $data['file'] = $fileName;
        }
        $lims_product_data = VendorProduct::create($data);
        //dealing with product variant
        if(!isset($data['is_batch']))
            $data['is_batch'] = null;
        // if(isset($data['is_variant'])) {
        //     foreach ($data['variant_name'] as $key => $variant_name) {
        //         $lims_variant_data = Variant::firstOrCreate(['name' => $data['variant_name'][$key]]);
        //         $lims_variant_data->name = $data['variant_name'][$key];
        //         $lims_variant_data->save();
        //         $lims_product_variant_data = new ProductVariant;             
        //         $lims_product_variant_data->product_id = $lims_product_data->id;
        //         $lims_product_variant_data->variant_id = $lims_variant_data->id;
        //         $lims_product_variant_data->position = $key + 1;
        //         $lims_product_variant_data->item_code = $data['item_code'][$key];
        //         $lims_product_variant_data->additional_price = $data['additional_price'][$key];
        //         $lims_product_variant_data->qty = 0;
        //         $lims_product_variant_data->save();
        //     }
        // }
        // if(isset($data['is_diffPrice'])) {
        //     foreach ($data['diff_price'] as $key => $diff_price) {
        //         if($diff_price) {
        //             Product_Warehouse::create([
        //                 "product_id" => $lims_product_data->id,
        //                 "warehouse_id" => $data["warehouse_id"][$key],
        //                 "qty" => 0,
        //                 "price" => $diff_price
        //             ]);
        //         }
        //     }
        // }
        \Session::flash('create_message', 'Product created successfully');
    }
    public function vendorDashboardEdit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('vendorproducts-edit')) {
         
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
         
            $lims_product_data = VendorProduct::where('id', $id)->first();

            $lims_product_data['dashboardView'] = 1;
            
            // print_r($lims_product_data);die();
            return view('vendorproduct.edit',compact('lims_brand_list', 'lims_category_list',  'lims_product_data'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }
    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('vendorproducts-edit')) {
         
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
         
            $lims_product_data = VendorProduct::where('id', $id)->first();
            
            return view('vendorproduct.edit',compact('lims_brand_list', 'lims_category_list',  'lims_product_data'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
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
                    $image->move('public/images/vendorproduct', $imageName);
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
           // print_r($product_id);die();
            foreach ((array)$product_id as $id) {
                echo $id;
                $lims_product_data =VendorProduct::findOrFail($id);
                $lims_product_data->is_active = false;
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
                    if(file_exists('public/images/vendorproduct/'.$image))
                        unlink('public/images/vendorproduct/'.$image);
                }
            }
            $lims_product_data->save();
            return redirect('vendorproducts')->with('message', 'Product deleted successfully');
        }
        public function allVendorProductsList(Type $var = null)
        {
        
            // print_r("dd");die();
            $role = Role::find(Auth::user()->role_id);
            // print_r($role);die();
            if($role->hasPermissionTo('allvendorproductslist-index')){
                     
                $permissions = Role::findByName($role->name)->permissions;
                foreach ($permissions as $permission)
                    $all_permission[] = $permission->name;
                if(empty($all_permission))
                    $all_permission[] = 'dummy text';
                return view('vendorproduct.all_vendor_product_list', compact('all_permission'));
            }
            else
                   
                return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
           
        }
        public function vendorDashboard()
        {
        
            $role = Role::find(Auth::user()->role_id);
            $sale = Sale::sum('grand_total');
            $sale = round($sale);
            
            $purchase = Purchase::sum('grand_total');
            $purchase = round($purchase);
            $expense = Expense::sum('amount');
            $expense = round($expense);
            if($role->hasPermissionTo('vendor-dashboard-index')){
                     
                $permissions = Role::findByName($role->name)->permissions;
                foreach ($permissions as $permission)
                    $all_permission[] = $permission->name;
                if(empty($all_permission))
                    $all_permission[] = 'dummy text';
                    // print_r($sale);die();
                return view('vendor-dashboard', compact('all_permission','sale','purchase','expense'));
            }
            else
                   
                return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
           
        }
        public function allVendorproductData(Request $request)
        {
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
             //print_r($products);die();
            if(!empty($products))
            {
                foreach ($products as $key=>$product)
                {
             
                    $nestedData['id'] = $product->id;
                    $nestedData['key'] = $key;
                    $product_image = explode(",", $product->image);
                    $product_image = htmlspecialchars($product_image[0]);
                    $nestedData['image'] = '<img src="'.url('public/images/vendorproduct', $product_image).'" height="80" width="80">';


                    $userData = User::where('id',$product->vendoruserid)->select('name')->first()->toArray();
                    
                    $nestedData['user_name'] = $userData['name'];

                    $nestedData['name'] = $product->name;

                    $nestedData['code'] = $product->code;
                    if($product->brand_id)
                        $nestedData['brand'] = $product->brand->title;
                    else
                        $nestedData['brand'] = "N/A";
                    $nestedData['category'] = $product->category->name;
                    $nestedData['qty'] = $product->qty;
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
                    $nestedData['ln_qty'] = '<div class="btn-group">
                    
                    <input type="number" name="ln_qty" id="ln_qty" class="form-control ln_qty"  data-qty_row_id="'.$product->id.'" style="width:70px;">

                    <div>';
                    $nestedData['ln_price'] = '<div class="btn-group">
                    
                    <input type="number" name="ln_qty" id="ln_price" class="form-control ln_price" data-price_row_id="'.$product->id.'" style="width:70px;">

                    <div>';
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
                        $nestedData['options'] .= \Form::open(["route" => ["vendorproducts.destroy", $product->id], "method" => "DELETE"] ).'
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> 
                                </li>'.\Form::close().'
                            </ul>
                        </div>';
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
            //print_r($data);die();
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
            // print_r($id);die();
           
           // print_r($product_id);die();
            if($id) {
                // echo $id;
                $lims_product_data =VendorProduct::findOrFail($id);
                $lims_product_data->is_active = 2;
                $lims_product_data->save();
            }
          
            return redirect('vendor-dashboard')->with('not_permitted', 'Product deleted successfully');
        }
        public function vendorDashboardData(Request $request)
        {
            // dd(Auth::user()->role_id);
           
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
                if($request['fromdate'] || $request['todate'])
                {
                    $startDate = $request['fromdate'];
                    $endDate = $request['todate'];
                    $products = VendorProduct::with('category', 'brand', 'unit')->offset($start)
                    ->where('is_active', '!=',2)
                    ->where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                    // print_r($products);die();
                }
                else{
                    if(Auth::user()->role_id == 6)
                    {
                        $products = VendorProduct::with('category', 'brand', 'unit')->offset($start)
                        ->where('is_active', '!=',2)
                        ->where('vendoruserid',Auth::user()->role_id)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                    }
                    else if(Auth::user()->role_id == 1)
                    {
                       
                        $products = VendorProduct::with('category', 'brand', 'unit')->offset($start)
                        ->where('is_active', '!=',2)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                    }
                   
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
            //  print_r($products);die();
            if(!empty($products))
            { $i = 0;
                foreach ($products as $key=>$product)
                {
                    $i++;
                    // print_r($product->id);die();
                    $nestedData['id'] = $product->id;
                    $nestedData['key'] = $key;
                    $product_image = explode(",", $product->image);
                    $product_image = htmlspecialchars($product_image[0]);
                    $nestedData['image'] = '<img src="'.url('public/images/vendorproduct', $product_image).'" height="80" width="80">';


                    $userData = User::where('id',$product->vendoruserid)->select('name')->first()->toArray();
                    
                    $nestedData['user_name'] = $userData['name'];

                    $nestedData['name'] = $product->name;
                    
                    $nestedData['type'] = $product->type;
                    $nestedData['code'] = $product->code;
                    if($product->brand_id)
                        $nestedData['brand'] = $product->brand->title;
                    else
                        $nestedData['brand'] = "N/A";
                    $nestedData['category'] = $product->category->name;
                    $nestedData['qty'] = $product->qty;
                    if($product->is_active == true)
                    {
                        $nestedData['is_active'] = '<span class="badge badge-success">Active</span>';
                    }
                    else if($product->is_active == false){
                        $nestedData['is_active'] = '<span class="badge badge-warning">Inactive </span>';
                    }
                    
                    // $nestedData['is_active'] = $product->is_active;
                    // dd($product->is_active);
                    // if($product->unit_id)
                    //     $nestedData['unit'] = $product->unit->unit_name;
                    // else
                    //     $nestedData['unit'] = 'N/A';
                    $nestedData['i'] = $i;
                    $nestedData['price'] = $product->price;
                    $nestedData['cost'] = $product->cost;
                    
                    if(config('currency_position') == 'prefix')
                        $nestedData['stock_worth'] = config('currency').' '.($product->qty * $product->price).' / '.config('currency').' '.($product->qty * (float)$product->cost);
                    else
                        $nestedData['stock_worth'] = ($product->qty * $product->price).' '.config('currency').' / '.($product->qty * $product->cost).' '.config('currency');
                    //$nestedData['stock_worth'] = ($product->qty * $product->price).'/'.($product->qty * $product->cost);
                   
                    $nestedData['options'] = '<div class="btn-group">
                                
                               ';
                    if(in_array("vendorproducts-edit", $request['all_permission']))
                        $nestedData['options'] .= '
                                <a href="'.route('vendorproducts.dashboardEdit', $product->id).'" class="btn btn-link"><i class="fa fa-pencil text-info me-1 mr-2 btn btn-light"></i></a>
                            ';
                    if(in_array("vendorproducts-delete", $request['all_permission']))
                        $nestedData['options'] .= \Form::open(["route" => ["vendorproducts.deletebyVendorDashboard", $product->id], "method" => "DELETE"] ).'
                                
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash text-danger btn btn-light"></i> </button> 
                                '.\Form::close().'
                           
                        </div>';
                    // data for product details by one click
                    // if($product->tax_id)
                    //     $tax = Tax::find($product->tax_id)->name;
                    // else
                    //     $tax = "N/A";
    
                    // if($product->tax_method == 1)
                    //     $tax_method = trans('file.Exclusive');
                    // else
                  
                    $nestedData['product'] = array( '[ "'.$product->type.'"', ' "'.$product->name.'"', ' "'.$product->code.'"', ' "'.$nestedData['brand'].'"','"'.$nestedData['is_active'].'"', ' "'.$nestedData['category'].'"',' "'.$product->price.'"',  ' "'.preg_replace('/\s+/S', " ", $product->product_details).'"', ' "'.$product->id.'"', ' "'.$product->product_list.'"',  ' "'.$product->price_list.'"',  ' "'.$product->image.'"',' "'.$product->qty.'"]'
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
        public function rowDataStore(Request $request)
        {
            // print_r($request->all());die();
                foreach($request['is_approve_row_data'] as $val)
                {
                    $data[] = VendorProduct::where('id',$val)->first()->toArray();
                }
                foreach($data as $key=>$value)
                {
                    $insert = new Product();
                    $insert->name = $value['name'];
                    $insert->code = $value['code'];
                    $insert->type = $value['type'];
                    $insert->barcode_symbology = $value['barcode_symbology'];
                    $insert->vendor_product_id = $value['id'];
                    $insert->brand_id = $value['brand_id'];
                    $insert->category_id = $value['category_id'];
                    $insert->subcategory_id = $value['subcategory_id'];
                    $insert->unit_id = $value['unit_id'];
                    $insert->purchase_unit_id = $value['purchase_unit_id'];
                    $insert->sale_unit_id = $value['sale_unit_id'];
                    $insert->cost = $value['cost'];
                    $insert->price = $value['price'];
                    $insert->qty = $value['qty'];
                    $insert->alert_quantity = $value['alert_quantity'];
                    $insert->promotion = $value['promotion'];
                    $insert->promotion_price = $value['promotion_price'];
                    $insert->starting_date = $value['starting_date'];
                    $insert->last_date = $value['last_date'];
                    $insert->tax_id = $value['tax_id'];
                    $insert->tax_method = $value['tax_method'];
                    $insert->image = $value['image'];
                    // $insert->file = $value['name'];
                    // $insert->is_variant = $value['name'];
                    // $insert->is_batch = $value['name'];
                    // $insert->is_diffPrice = $value['name'];
                    // $insert->is_imei = $value['name'];
                    $insert->featured = $value['featured'];
                    // $insert->product_list = $value['name'];
                    // $insert->variant_list = $value['name'];
                    // $insert->qty_list = $value['name'];
                    // $insert->price_list = $value['name'];
                    $insert->product_details = $value['product_details'];
                    $insert->is_active =1;
                    $insert->save();
                
                }
               
                return redirect('all-vendor-products-list')->with('message', 'Product Added successfully');
               
               
        }
    }
    