<nav class="container shadow-lg rounded-pill my-4 d-flex bg-white border align-items-center justify-content-between" style="box-shadow: 0 0 10px #e6e4e4;">
    <ol class="m-0 breadcrumb bg-white p-2">
        <li class="breadcrumb-item"><a href="{{ route('welcome_dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @php
                $find       =  [".create", ".index", "vendorproducts " , "customer_group ", "setting.general" , "master-attribute"];
                $replace    =  [" / Add", " / List", "vendor products ", "customer group ", "general setting" , "master attribute"];
                $route      =  str_replace($find, $replace, Route::currentRouteName()  );
            @endphp
            <strong style="text-transform: capitalize">
                {{ Route::is("welcome_dashboard") ? "Weolcome ".Auth::user()->name." !" : "" }}
                {{ $route }}
            </strong>
        </li>
    </ol>
    <ol class="m-0 breadcrumb bg-white p-2">
        <li class="breadcrumb-item"><a href="#" onclick="history.back()"><i class="text-success fa fa-angle-double-left"></i> Back</a></li>
    </ol>
</nav>