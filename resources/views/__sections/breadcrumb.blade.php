<nav class="container shadow-sm mt-4 d-flex bg-white align-items-center justify-content-between" >
    <ol class="m-0 breadcrumb bg-white p-2">
        <li class="breadcrumb-item"><a href="{{ route('welcome_dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @php
                $find       =  [ "product.printBarcode","sales.edit","all-vendor-products-list", "welcome_dashboard",".create", ".index", "vendorproducts " , "customer_group ", "setting.general" , "master-attribute"];
                $replace    =  [ "Product / Print Barcode","Sales / Edit","vendor / all products list", "Weolcome ".Auth::user()->name." !"," / Add", " / List", "vendor products ", "customer group ", "general setting" , "master attribute"];
                $route      =  str_replace($find, $replace, Route::currentRouteName()  );
            @endphp
            <strong style="text-transform: capitalize">
                {{ $route }}
            </strong>
        </li>
    </ol>
    <ol class="m-0 breadcrumb bg-white p-2">
        <li class="breadcrumb-item"><a href="#" onclick="history.back()"><i class="text-success fa fa-angle-double-left"></i> Back</a></li>
    </ol>
</nav>