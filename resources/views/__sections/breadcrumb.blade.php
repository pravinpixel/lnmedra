@php
    $find       =  ['vendorproducts.edit', 'customer.edit' ,"product.printBarcode","sales.edit","all-vendor-products-list", "welcome_dashboard",".create", ".index", "vendorproducts " , "customer_group ", "setting.general" , "master-attribute"];
    $replace    =  ['Vendor products / Update','customer / Update', "Product / Print Barcode","Sales / Edit","vendor / all products list", "Weolcome ".Auth::user()->name." !"," / Add", " / List", "vendor products ", "customer group ", "general setting" , "master attribute"];
    $route      =  str_replace($find, $replace, Route::currentRouteName());

    // ========== For Section Titles ========
    $find_title     =   [
                            'customer.index', 'customer.edit','customer.create',
                            'sales.index' ,'sales.edit' ,'sales.create','coupons.index',
                            'stock-count.index','category.index','products.index','products.edit',
                            'product.printBarcode','vendorproduct listing table','vendorupdate products details','vendorproducts.create',
                            'supplier.index','supplier.edit','supplier.create','all-vendor-products-list',
                            'purchases.index','purchases.create','purchases.edit','expense_categories.index',
                            'return-sale.index','employees.index','holidays.index','biller.index','employees.create',
                            'biller.create','role.index','role.permission','warehouse.index','customer_group.index','unit.index','currency.index',
                            'tax.index','user.index','user.edit','user.create','setting.general','master-attribute.index','enquiry.index','enquiry.create'
                        ];

    $replace_title  =   [
                            'customer listing table', "Update Customer Details",'add new customer',
                            'sales listing table', 'Update Sale Details','add new sale','coupons list',
                            'stock counts list','product category list','product listing table','update products details',
                            'Print Product Barcode','vendor product listing table','update vendor products details','Add new vendor products',
                            'supplier listing table','update supplier details','add new supplier','vendor products list',
                            'purchases listing table','Add new purchase','update purchases details','expense categories list',
                            'return sale list','employees listing','holidays listing','biller listing','Add new employee',
                            'add new biller','add new role','role permission listing','warehouse listing','customer group list','Unit Listing','currency Listing',
                            'tax listing','user listing','update user details','Add new user','general settings',' master attribute listing','enquiry listing','add new enquiry',
                        ];
                        
    $title          =  str_replace($find_title, $replace_title, Route::currentRouteName());
 
@endphp 

<div class="container-fluid {{ Route::is('welcome_dashboard') ? "d-none" : ''}}">
    <nav class="container my-4 shadow-sm d-flex bg-white align-items-center justify-content-between" >
        <ol class="m-0 breadcrumb bg-white p-2 align-items-center">
            <li class="breadcrumb-item"><a href="{{ route('welcome_dashboard') }}"><i class="dripicons-home mr-2"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> 
                <strong style="text-transform: capitalize">
                    {{ $route }}
                </strong>
            </li>
        </ol>
        <ol class="m-0 breadcrumb bg-white p-2">
            <li class="breadcrumb-item"><a href="#" onclick="history.back()"><i class="text-success fa fa-angle-double-left"></i> Back</a></li>
        </ol>
    </nav>
    <div class="section-title {{ Route::is('welcome_dashboard') ? "d-none" : ''}}" style="text-transform: capitalize">
        <i class="dripicons-chevron-right"></i> {{ Route::is('welcome_dashboard') ? "" : $title }}
    </div>
</div>