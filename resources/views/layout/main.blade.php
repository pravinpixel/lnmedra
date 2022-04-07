<!DOCTYPE html>
<html dir="@if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl){{'rtl'}}@endif">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <input type="hidden" name="baseUrl" id="baseUrl" value="{{ url('/') }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.css') ?>" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preload" href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" rel="stylesheet"></noscript>
    <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet"></noscript>
    <link rel="preload" href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" rel="stylesheet"></noscript>
    <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" rel="stylesheet"></noscript>
    <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" rel="stylesheet"></noscript>
    <!-- Font Awesome CSS-->
    <link rel="preload" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"></noscript>
    <!-- Drip icon font-->
    <link rel="preload" href="<?php echo asset('vendor/dripicons/webfont.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/dripicons/webfont.css') ?>" rel="stylesheet"></noscript>
    <!-- Google fonts - Roboto -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" rel="stylesheet"></noscript>
    <!-- jQuery Circle-->
    <link rel="preload" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" rel="stylesheet"></noscript>
    <!-- Custom Scrollbar-->
    <link rel="preload" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" rel="stylesheet"></noscript>

    @if(Route::current()->getName() != '/')
    <!-- date range stylesheet-->
    <link rel="preload" href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" rel="stylesheet"></noscript>
    <!-- table sorter stylesheet-->
    <link rel="preload" href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" rel="stylesheet"></noscript>
    <link rel="preload" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" rel="stylesheet"></noscript>
    <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet"></noscript>
    @endif

    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/dropzone.css') ?>">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css" id="custom-style">



    @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
      <!-- RTL css -->
      <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-rtl.min.css') ?>" type="text/css">
      <link rel="stylesheet" href="<?php echo asset('css/custom-rtl.css') ?>" type="text/css" id="custom-style">
    @endif
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <style>
      .dataTable {
        width: 100% !important;
      }
    </style>
  </head>

  @if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
  @endif 

  <body onload="myFunction()">

     {{--======= Alert Session =======--}}
     @include('__sections.alert_notification')
     {{--======== Alert Session =======--}}

   
    <main>
      <div id="loader"></div>
      <!-- Side Navbar -->
      <nav class="side-navbar h-100 bg-dark top-0"  style="background:linear-gradient(#fffffff1 60%,#ffffffab) , url('{{ asset('public/images/leaf-bg.jpg') }}');background-size:cover;">
        <div class="side-navbar-wrapper">
          <!-- Sidebar Header    -->
          <!-- Sidebar Navigation Menus-->
          <div class="main-menu">
            <div class="text-center my-3">
              <a href="{{url('/')}}"><img src="{{url('public/logo/logo.png')}}" width="100px"></a>
              {{-- <a id="toggle-btn" href="#" class="btn-pos rounded-pill"><i class="fa fa-bars"> </i></a> --}}
            </div>
            <ul id="side-main-menu" class="side-menu list-unstyled">
              @if(Auth::user()->role_id == 6) 
              <li id="vendorDashboard-menu"><a href="{{url('/')}}"> <i class="dripicons-meter"></i><span>Vendor dashboard</span></a></li>
                          
              @else
                <li><a href="{{url('/')}}"> <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span></a></li>
              @endif
           

              <?php
                  $role = DB::table('roles')->find(Auth::user()->role_id);
                
                  $store_outlet_permission = DB::table('permissions')->where('name', 'store-outlet-index')->first();
                  $store_outlet_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $store_outlet_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $outlet_setup = DB::table('permissions')->where('name', 'outlet-setup')->first();
                      $outlet_setup_active = DB::table('role_has_permissions')->where([
                          ['permission_id', $outlet_setup->id],
                          ['role_id', $role->id]
                      ])->first();

                  $user_management = DB::table('permissions')->where('name', 'user-management')->first();
                      $user_management_active = DB::table('role_has_permissions')->where([
                          ['permission_id', $user_management->id],
                          ['role_id', $role->id]
                      ])->first();

              ?>
              {{-- @if($store_outlet_permission_active || $outlet_setup_active || $user_management_active)
              <li><a href="#store_outlet" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.store_outlet_management')}}</span><span></a>
                <ul id="store_outlet" class="collapse list-unstyled ">
                  @if($outlet_setup_active)
                  <li id="category-menu"><a href="">{{__('file.outlet_setup')}}</a></li>
                  @endif
                  @if($user_management_active)
                  <li id="printBarcode-menu"><a href="">{{__('file.user_management')}}</a></li>
                  @endif
                  
                </ul>
              </li>
              @endif --}}
              
             
              @if(userHasAccess('customers-add') || userHasAccess('customers-index'))
              <li><a href="#customer_management" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('file.customer_management')}}</span></a>
                <ul id="customer_management" class="collapse list-unstyled ">
                  @if(userHasAccess('customers-index'))
                  <li id="customer-list-menu"><a href="{{route('customer.index')}}">{{trans('file.Customer List')}}</a></li>
                  @endif
                  @if(userHasAccess('customers-add'))
                  <li id="customer-create-menu"><a href="{{route('customer.create')}}">{{trans('file.Add Customer')}}</a></li>
                  @endif
                
                </ul>
              </li>
              @endif

             
              @if(userHasAccess('sales-index') ||  userHasAccess('coupon') || userHasAccess('delivery') || userHasAccess('sales-add'))
              <li><a href="#sale" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span>{{trans('file.Sale')}}</span></a>
                <ul id="sale" class="collapse list-unstyled ">
                  @if(userHasAccess('sales-index'))
                    <li id="sale-list-menu"><a href="{{route('sales.index')}}">{{trans('file.Sale List')}}</a></li>
                    
                  @endif
                  @if(userHasAccess('sales-add'))
                    <!-- <li><a href="{{route('sale.pos')}}">POS</a></li> -->
                    <li id="sale-create-menu"><a href="{{route('sales.create')}}">{{trans('file.Add Sale')}}</a></li>
                    
                  @endif
                  @if(userHasAccess('sale_import'))
                  <li id="sale-import-menu"><a href="{{url('sales/sale_by_csv')}}">{{trans('file.Import Sale By CSV')}}</a></li>
                  @endif
                  @if(userHasAccess('gift_card'))
                  <li id="gift-card-menu"><a href="{{route('gift_cards.index')}}">{{trans('file.Gift Card List')}}</a> </li>
                  @endif
                  @if(userHasAccess('coupon'))
                  <li id="coupon-menu"><a href="{{route('coupons.index')}}">{{trans('file.Coupon List')}}</a> </li>
                  @endif
                  @if(userHasAccess('delivery'))
                  <li id="delivery-menu"><a href="{{route('delivery.index')}}">{{trans('file.Delivery List')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif

              @if(userHasAccess('stock_count'))
                  <li><a href="#stock_inventory" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span>{{trans('file.stock_inventory')}}</span></a>
                    <ul id="stock_inventory" class="collapse list-unstyled">
                        <li id="stock_list"><a href="{{ route('stock-count.index') }}">{{trans('file.stock_list')}}</a></li>
                    </ul>
                  </li>
              @endif

               <?php
                  $role = DB::table('roles')->find(Auth::user()->role_id);
                 

                    $adjustment = DB::table('permissions')->where('name', 'adjustment')->first();
                    $adjustment_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $adjustment->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              
            
              @if(userHasAccess('products-index') || userHasAccess('category') || userHasAccess('print_barcode') )
              <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.product')}}</span><span></a>
                <ul id="product" class="collapse list-unstyled ">
                  @if(userHasAccess('category'))
                  <li id="category-menu"><a href="{{route('category.index')}}">{{__('file.category')}}</a></li>
                  @endif
                  @if(userHasAccess('products-index'))
                  <li id="product-list-menu"><a href="{{route('products.index')}}">{{__('file.product_list')}}</a></li>
                  @endif
                  @if(userHasAccess('products-add'))
                  <li id="product-create-menu"><a href="{{route('products.create')}}">{{__('file.add_product')}}</a></li>
                  @endif
                  @if(userHasAccess('print_barcode'))
                  <li id="printBarcode-menu"><a href="{{route('product.printBarcode')}}">{{__('file.print_barcode')}}</a></li>
                  @endif
                  <!-- @if($adjustment_active)
                    <li id="adjustment-list-menu"><a href="{{route('qty_adjustment.index')}}">{{trans('file.Adjustment List')}}</a></li>
                    <li id="adjustment-create-menu"><a href="{{route('qty_adjustment.create')}}">{{trans('file.Add Adjustment')}}</a></li>
                  @endif
                  -->
                </ul>
              </li>
              @endif


             
                  
                 
              @if(userHasAccess('vendorproducts-index') || userHasAccess('vendorproducts-add'))
              <li><a href="#vendorproduct" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.vendorproduct')}}</span><span></a>
                <ul id="vendorproduct" class="collapse list-unstyled ">
                 
                  @if(userHasAccess('vendorproducts-index'))
                  <li id="vendorproduct-list-menu"><a href="{{route('vendorproducts.index')}}">{{__('file.product_list')}}</a></li>
                  @endif
                  @if(userHasAccess('vendorproducts-add'))
                  <li id="vendorproduct-create-menu"><a href="{{route('vendorproducts.create')}}">{{__('file.add_product')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif
                 
                  @if(userHasAccess('suppliers-index') || userHasAccess('suppliers-add') || userHasAccess('vendor-approval-index'))
                  <li><a href="#vendor_supplier" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('file.vendor_supplier_management')}}</span></a>
                    <ul id="vendor_supplier" class="collapse list-unstyled ">
                      
                      @if(userHasAccess('suppliers-index'))
                        <li id="supplier-list-menu"><a href="{{route('supplier.index')}}">{{trans('file.Supplier List')}}</a></li>
                      @endif
                      @if(userHasAccess('suppliers-add'))
                        <li id="supplier-create-menu"><a href="{{route('supplier.create')}}">{{trans('file.Add Supplier')}}</a></li>
                      @endif

                      @if(userHasAccess('vendor-approval-index'))
                      <li id="vendorproduct-product-list-menu"><a href="{{route('all-vendor-products-list')}}">{{__('file.vendor_product_list')}}</a></li>
                      @endif
                  
                    </ul>
                  </li>
                  @endif

             
             
              @if(userHasAccess('purchases-index')||userHasAccess('purchases-add'))
              <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('file.Purchase')}}</span></a>
                <ul id="purchase" class="collapse list-unstyled ">
                @if(userHasAccess('purchases-index'))
                  <li id="purchase-list-menu"><a href="{{route('purchases.index')}}">{{trans('file.Purchase List')}}</a></li>
                @endif
                @if(userHasAccess('purchases-add'))
                <li id="purchase-create-menu"><a href="{{route('purchases.create')}}">{{trans('file.Add Purchase')}}</a></li>
                @endif
                @if(userHasAccess('purchases_import'))   
                <li id="purchase-import-menu"><a href="{{url('purchases/purchase_by_csv')}}">{{trans('file.Import Purchase By CSV')}}</a></li>
                @endif
                </ul>
              </li>
              @endif
              

             
              @if(userHasAccess('expenses-index')||userHasAccess('expenses-add')||userHasAccess('expense_categories'))
              <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>{{trans('file.Expense')}}</span></a>
                <ul id="expense" class="collapse list-unstyled ">
                  @if(userHasAccess('expense_categories'))
                  <li id="exp-cat-menu"><a href="{{route('expense_categories.index')}}">{{trans('file.Expense Category')}}</a></li>
                  @endif
                  @if(userHasAccess('expenses-index'))
                  <li id="exp-list-menu"><a href="{{route('expenses.index')}}">{{trans('file.Expense List')}}</a></li>
                  @endif
                  @if(userHasAccess('expenses-add'))
                  <li><a id="add-expense" href=""> {{trans('file.Add Expense')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif
              <?php
                $index_permission = DB::table('permissions')->where('name', 'expenses-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                   
              ?>
              @if(userHasAccess('transfers-index') || userHasAccess('transfers-add'))
              <li><a href="#stock_transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>{{trans('file.stock_transfer')}}</span></a>
                <ul id="stock_transfer" class="collapse list-unstyled ">
                  @if(userHasAccess('transfers-index'))
                  <li id="transfer-list-menu"><a href="{{route('transfers.index')}}">{{trans('file.Transfer List')}}</a></li>
                  @endif
                  @if(userHasAccess('transfers-add'))
                  <li id="transfer-create-menu"><a href="{{route('transfers.create')}}">{{trans('file.Add Transfer')}}</a></li>
                  @endif
                  @if(userHasAccess('transfers_import'))
                  <li id="transfer-import-menu"><a href="{{url('transfers/transfer_by_csv')}}">{{trans('file.Import Transfer By CSV')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif
              
              @if(userHasAccess('quotes-index')||userHasAccess('quotes-add'))
              <li><a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>{{trans('file.Quotation')}}</span><span></a>
                <ul id="quotation" class="collapse list-unstyled ">
                  @if(userHasAccess('quotes-index'))
                  <li id="quotation-list-menu"><a href="{{route('quotations.index')}}">{{trans('file.Quotation List')}}</a></li>
                  @endif
                  
                  @if(userHasAccess('quotes-add'))
                  <li id="quotation-create-menu"><a href="{{route('quotations.create')}}">{{trans('file.Add Quotation')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif 
             
              

              <?php
                $sale_return_index_permission = DB::table('permissions')->where('name', 'returns-index')->first();

                $sale_return_index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $sale_return_index_permission->id],
                        ['role_id', $role->id]
                    ])->first();

                $purchase_return_index_permission = DB::table('permissions')->where('name', 'purchase-return-index')->first();

                $purchase_return_index_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $purchase_return_index_permission->id],
                            ['role_id', $role->id]
                        ])->first();
              ?>
              @if(userHasAccess('returns-index') || userHasAccess('purchase-return-index'))
              <li><a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-return"></i><span>{{trans('file.return')}}</span></a>
                <ul id="return" class="collapse list-unstyled ">
                  @if(userHasAccess('returns-index'))
                  <li id="sale-return-menu"><a href="{{route('return-sale.index')}}">{{trans('file.Sale')}}</a></li>
                  @endif
                  @if(userHasAccess('purchase-return-index'))
                  <li id="purchase-return-menu"><a href="{{route('return-purchase.index')}}">{{trans('file.Purchase')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif


            
               @if(userHasAccess('pos_setting'))
              <li><a href="#point_of_sale_setup" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-return"></i><span>{{trans('file.point_of_sale_setup')}}</span></a>
                <ul id="point_of_sale_setup" class="collapse list-unstyled ">
                  @if(userHasAccess('pos_setting'))
                  <li id="pos-setting-menu"><a href="{{route('setting.pos')}}">POS {{trans('file.settings')}}</a></li>
                  @endif
                  
                  <!-- <li id="purchase-return-menu"><a href="">POS {{trans('file.bill_screen')}}</a></li> -->
                  
                </ul>
              </li>
              @endif


              
            
              @if(userHasAccess('account-index') || userHasAccess('money-transfer') || userHasAccess('balance-sheet') || userHasAccess('account-statement'))
              <li class=""><a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{trans('file.Accounting')}}</span></a>
                <ul id="account" class="collapse list-unstyled ">
                  @if(userHasAccess('account-index'))
                  <li id="account-list-menu"><a href="{{route('accounts.index')}}">{{trans('file.Account List')}}</a></li>
                  <li><a id="add-account" href="">{{trans('file.Add Account')}}</a></li>
                  @endif
                  @if(userHasAccess('money-transfer'))
                  <li id="money-transfer-menu"><a href="{{route('money-transfers.index')}}">{{trans('file.Money Transfer')}}</a></li>
                  @endif
                  @if(userHasAccess('balance-sheet'))
                  <li id="balance-sheet-menu"><a href="{{route('accounts.balancesheet')}}">{{trans('file.Balance Sheet')}}</a></li>
                  @endif
                  @if(userHasAccess('account-statement'))
                  <li id="account-statement-menu"><a id="account-statement" href="">{{trans('file.Account Statement')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif 
             
              @if(userHasAccess('department')|| userHasAccess('attendance') || userHasAccess('payroll'))
             
              <li class=""><a href="#hrm" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>HRM</span></a>
                <ul id="hrm" class="collapse list-unstyled ">
                  @if(userHasAccess('department'))
                  <li id="dept-menu"><a href="{{route('departments.index')}}">{{trans('file.Department')}}</a></li>
                  @endif
                  <!-- @if(userHasAccess('employees-index'))
                  <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('file.Employee')}}</a></li>
                  @endif -->
                  @if(userHasAccess('attendance'))
                  <li id="attendance-menu"><a href="{{route('attendance.index')}}">{{trans('file.Attendance')}}</a></li>
                  @endif
                  @if(userHasAccess('payroll'))
                  <li id="payroll-menu"><a href="{{route('payroll.index')}}">{{trans('file.Payroll')}}</a></li>
                  @endif
                  <li id="holiday-menu"><a href="{{route('holidays.index')}}">{{trans('file.Holiday')}}</a></li>
                </ul>
              </li>
              
              @endif

              <?php
                  $user_index_permission_active = DB::table('permissions')
                      ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                      ->where([
                        ['permissions.name', 'users-index'],
                        ['role_id', $role->id] ])->first();

                  $customer_index_permission = DB::table('permissions')->where('name', 'customers-index')->first();

                  $customer_index_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $customer_index_permission->id],
                            ['role_id', $role->id]
                        ])->first();

                  $biller_index_permission = DB::table('permissions')->where('name', 'billers-index')->first();

                  $biller_index_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $biller_index_permission->id],
                            ['role_id', $role->id]
                        ])->first();
                
                  $supplier_index_permission = DB::table('permissions')->where('name', 'suppliers-index')->first();

                  $supplier_index_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $supplier_index_permission->id],
                            ['role_id', $role->id]
                        ])->first();
              ?>
             
              @if(userHasAccess('billers-index') || userHasAccess('billers-add'))
              <li><a href="#biller" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{trans('file.Biller')}}</span></a>
                <ul id="biller" class="collapse list-unstyled ">
                  @if(userHasAccess('billers-index'))
                  <li id="biller-list-menu"><a href="{{route('biller.index')}}">{{trans('file.Biller List')}}</a></li>
                  @endif
                  @if(userHasAccess('billers-add'))
                  <li id="biller-create-menu"><a href="{{route('biller.create')}}">{{trans('file.Add Biller')}}</a></li>
                  @endif
                </ul>
              </li>
              @endif
        
              <!-- @if($user_index_permission_active || $customer_index_permission_active || $biller_index_permission_active || $supplier_index_permission_active)
              <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{trans('file.People')}}</span></a>
                <ul id="people" class="collapse list-unstyled ">

                  @if($user_index_permission_active)
                  <li id="user-list-menu"><a href="{{route('user.index')}}">{{trans('file.User List')}}</a></li>
                  <?php $user_add_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([
                          ['permissions.name', 'users-add'],
                          ['role_id', $role->id] ])->first();
                  ?>
                  @if($user_add_permission_active)
                  <li id="user-create-menu"><a href="{{route('user.create')}}">{{trans('file.Add User')}}</a></li>
                  @endif
                  @endif

                  @if($customer_index_permission_active)
                  <li id="customer-list-menu"><a href="{{route('customer.index')}}">{{trans('file.Customer List')}}</a></li>
                  <?php
                    $customer_add_permission = DB::table('permissions')->where('name', 'customers-add')->first();
                    $customer_add_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $customer_add_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                  ?>
                  @if($customer_add_permission_active)
                  <li id="customer-create-menu"><a href="{{route('customer.create')}}">{{trans('file.Add Customer')}}</a></li>
                  @endif
                  @endif
                  
                  @if($biller_index_permission_active)
                  <li id="biller-list-menu"><a href="{{route('biller.index')}}">{{trans('file.Biller List')}}</a></li>
                  <?php
                    $biller_add_permission = DB::table('permissions')->where('name', 'billers-add')->first();
                    $biller_add_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $biller_add_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                  ?>
                  @if($biller_add_permission_active)
                  <li id="biller-create-menu"><a href="{{route('biller.create')}}">{{trans('file.Add Biller')}}</a></li>
                  @endif
                  @endif

                  @if($supplier_index_permission_active)
                  <li id=""><a href="{{route('supplier.index')}}">{{trans('file.Supplier List')}}</a></li>
                  <?php
                    $supplier_add_permission = DB::table('permissions')->where('name', 'suppliers-add')->first();
                    $supplier_add_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $supplier_add_permission->id],
                        ['role_id', $role->id]
                    ])->first();
                  ?>
                  @if($supplier_add_permission_active)
                  <li id="supplier-create-menu"><a href="{{route('supplier.create')}}">{{trans('file.Add Supplier')}}</a></li>
                  @endif
                  @endif
                </ul>
              </li>
              @endif -->

            
              @if(userHasAccess('profit-loss') || userHasAccess('best-seller') || userHasAccess('warehouse-report') || userHasAccess('warehouse-stock-report') || userHasAccess('product-report') || userHasAccess('daily-sale') || userHasAccess('monthly-sale') || userHasAccess('daily-purchase') || userHasAccess('monthly-purchase') || userHasAccess('purchase-report') || userHasAccess('sale-report') || userHasAccess('payment-report') || userHasAccess('product-qty-alert') || userHasAccess('user-report') || userHasAccess('customer-report') || userHasAccess('supplier-report') || userHasAccess('due-report'))
              <li><a href="#report" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{trans('file.Reports')}}</span></a>
                <ul id="report" class="collapse list-unstyled ">
                  @if(userHasAccess('profit-loss') )
                  <li id="profit-loss-report-menu">
                    {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <a id="profitLoss-link" href="">{{trans('file.Summary Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                  @if(userHasAccess('best-seller'))
                  <li id="best-seller-report-menu">
                    <a href="{{url('report/best_seller')}}">{{trans('file.Best Seller')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('product-report'))
                  <li id="product-report-menu">
                    {!! Form::open(['route' => 'report.product', 'method' => 'get', 'id' => 'product-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <input type="hidden" name="warehouse_id" value="0" />
                    <a id="report-link" href="">{{trans('file.Product Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                  @if(userHasAccess('daily-sale'))
                  <li id="daily-sale-report-menu">
                    <a href="{{url('report/daily_sale/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Sale')}}</a>
                  </li>
                  @endif
                  @if( userHasAccess('monthly-sale'))
                  <li id="monthly-sale-report-menu">
                    <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('daily-purchase'))
                  <li id="daily-purchase-report-menu">
                    <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Purchase')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('monthly-purchase'))
                  <li id="monthly-purchase-report-menu">
                    <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{trans('file.Monthly Purchase')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('sale-report'))
                  <li id="sale-report-menu">
                    {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <input type="hidden" name="warehouse_id" value="0" />
                    <a id="sale-report-link" href="">{{trans('file.Sale Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                  @if(userHasAccess('payment-report'))
                  <li id="payment-report-menu">
                    {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <a id="payment-report-link" href="">{{trans('file.Payment Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                  @if(userHasAccess('purchase-report'))
                  <li id="purchase-report-menu">
                    {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <input type="hidden" name="warehouse_id" value="0" />
                    <a id="purchase-report-link" href="">{{trans('file.Purchase Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                  @if(userHasAccess('warehouse-report'))
                  <li id="warehouse-report-menu">
                    <a id="warehouse-report-link" href="">{{trans('file.Warehouse Report')}}</a>
                  </li>
                  @endif
                  @if( userHasAccess('warehouse-stock-report'))
                  <li id="warehouse-stock-report-menu">
                    <a href="{{route('report.warehouseStock')}}">{{trans('file.Warehouse Stock Chart')}}</a>
                  </li>
                  @endif
                  @if( userHasAccess('product-qty-alert'))
                  <li id="qtyAlert-report-menu">
                    <a href="{{route('report.qtyAlert')}}">{{trans('file.Product Quantity Alert')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('user-report'))
                  <li id="user-report-menu">
                    <a id="user-report-link" href="">{{trans('file.User Report')}}</a>
                  </li>
                  @endif
                  @if( userHasAccess('customer-report'))
                  <li id="customer-report-menu">
                    <a id="customer-report-link" href="">{{trans('file.Customer Report')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('supplier-report'))
                  <li id="supplier-report-menu">
                    <a id="supplier-report-link" href="">{{trans('file.Supplier Report')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('due-report'))
                  <li id="due-report-menu">
                    {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}
                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                    <a id="due-report-link" href="">{{trans('file.Due Report')}}</a>
                    {!! Form::close() !!}
                  </li>
                  @endif
                </ul>
              </li>
              @endif
              
                  @if(userHasAccess('mail_setting')|| userHasAccess('send_notification') || userHasAccess('warehouse')|| userHasAccess('customer_group'))
              <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>{{trans('file.settings')}}</span></a>
                <ul id="setting" class="collapse list-unstyled ">
                  
                  @if(userHasAccess('mail_setting'))
                  <li id="mail-setting-menu"><a href="{{route('setting.mail')}}">{{trans('file.Mail Setting')}}</a></li>
                  @endif
                                   
                  @if(userHasAccess('role_permission'))
                  <li id="role-menu"><a href="{{route('role.index')}}">{{trans('file.Role Permission')}}</a></li>
                  @endif
                 
                  
                  @if(userHasAccess('send_notification'))
                  <li id="notification-menu">
                    <a href="" id="send-notification">{{trans('file.Send Notification')}}</a>
                  </li>
                  @endif
                  @if(userHasAccess('warehouse'))
                  <li id="warehouse-menu"><a href="{{route('warehouse.index')}}">{{trans('file.Warehouse')}}</a></li>
                  @endif
                  @if(userHasAccess('customer_group'))
                  <li id="customer-group-menu"><a href="{{route('customer_group.index')}}">{{trans('file.Customer Group')}}</a></li>
                  @endif
                  @if(userHasAccess('brand') )
                  <li id="brand-menu"><a href="{{route('brand.index')}}">{{trans('file.Brand')}}</a></li>
                  @endif
                  @if(userHasAccess('unit'))
                  <li id="unit-menu"><a href="{{route('unit.index')}}">{{trans('file.Unit')}}</a></li>
                  @endif
                  @if(userHasAccess('currency'))
                  <li id="currency-menu"><a href="{{route('currency.index')}}">{{trans('file.Currency')}}</a></li>
                  @endif
                  @if(userHasAccess('tax'))
                  <li id="tax-menu"><a href="{{route('tax.index')}}">{{trans('file.Tax')}}</a></li>
                  @endif
                  <!-- <li id="user-menu"><a href="{{route('user.profile', ['id' => Auth::id()])}}">{{trans('file.User Profile')}}</a></li> -->
                  @if(userHasAccess('user-profile'))
                  <li id="user-menu"><a href="{{route('user.index')}}">{{trans('file.User Profile')}}</a></li>
                  @endif
                  @if(userHasAccess('create_sms'))
                  <li id="create-sms-menu"><a href="{{route('setting.createSms')}}">{{trans('file.Create SMS')}}</a></li>
                  @endif
                  @if(userHasAccess('backup_database'))
                  <li><a href="{{route('setting.backup')}}">{{trans('file.Backup Database')}}</a></li>
                  @endif
                  @if(userHasAccess('general_setting'))
                  <li id="general-setting-menu"><a href="{{route('setting.general')}}">{{trans('file.General Setting')}}</a></li>
                  @endif
                  
                  @if(userHasAccess('reward_point_setting'))
                  <li id="reward-point-setting-menu"><a href="{{route('setting.rewardPoint')}}">{{trans('file.Reward Point Setting')}}</a></li>
                  @endif 
                  @if(userHasAccess('sms_setting'))
                  <li id="sms-setting-menu"><a href="{{route('setting.sms')}}">{{trans('file.SMS Setting')}}</a></li>
                  @endif
                   @if(userHasAccess('pos_setting'))
                  <li id="pos-setting-menu"><a href="{{route('setting.pos')}}">POS {{trans('file.settings')}}</a></li>
                  @endif
                  @if(userHasAccess('hrm_setting'))
                  <li id="hrm-setting-menu"><a href="{{route('setting.hrm')}}"> {{trans('file.HRM Setting')}}</a></li>
                  @endif
                  @if(userHasAccess('employees-index'))
                  <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('file.Employee')}}</a></li>
                  @endif
                  @if(userHasAccess('attribute-index'))
                  <li id="master-attribute-menu"><a href="{{route('master-attribute.index')}}"><span>{{__('file.Master Attribute')}}</span></a></li>
                  @endif
                  @if( userHasAccess('accounts-date-index'))
                  <li id="accounts-date-menu"><a href="{{route('accounts-date.index')}}"><span>{{__('file.Accounts Heads')}}</span></a></li>
                  @endif
                </ul>
              </li>
             
              @endif
             
              @if(userHasAccess('enquiry-index') || userHasAccess('enquiry-add'))
                
                <li><a href="#enquiry_management" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.enquiry_management')}}</span><span></a>
               
                <ul id="enquiry_management" class="collapse list-unstyled ">
                  @if(userHasAccess('enquiry-index'))
                  <li id="enquiry-list-menu"><a href="{{route('enquiry.index')}}">{{__('file.enquiry_list')}}</a></li>
                  @endif
                  @if(userHasAccess('enquiry-add'))
                  <li id="enquiry-create-menu"><a href="{{route('enquiry.create')}}">{{__('file.add_enquiry')}}</a></li>
                  @endif
                  
                </ul>
              </li>
              @endif
              <?php
                  $role = DB::table('roles')->find(Auth::user()->role_id);
                
                  $vendor_login_permission = DB::table('permissions')->where('name', 'vendor-login')->first();
                  $vendor_login_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $vendor_login_permission->id],
                      ['role_id', $role->id]
                  ])->first();
              ?>
              {{-- @if($vendor_login_permission_active)
                @if($outlet_setup_active)
                <li><a href="#vendor_login" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>{{__('file.vendor_login')}}</span><span></a>
                @endif
                <ul id="vendor_login" class="collapse list-unstyled ">
                  <li id="category-menu"><a href="">{{__('file.secure_login')}}</a></li>
                  <li id="category-menu"><a href="">{{__('file.provision_manage_the_products')}}</a></li>
                  <li id="printBarcode-menu"><a href="">{{__('file.details_of_product_Image')}}</a></li>
                 
                  
                </ul>
              </li>
              @endif --}}
              
               
               <!-- <li id="enquiry-menu"><a href="{{route('enquiry.index')}}"><i class="dripicons-document-remove"></i><span>{{__('file.enquiry_management')}}</span></a></li> -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- navbar-->
      <header class="header" >
        <nav class="navbar" id="header-top" style="padding-left:230px">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <a id="toggle-btn" href="#" class="btn-pos rounded-pill"><i class="fa fa-bars"> </i></a>
              <span class="brand-big">
                <?php $site_title = DB::table('general_settings')->select('site_title')->first(); ?>
                <a href="{{url('/')}}"><h2>{{$site_title->site_title}} | Sales & POS Management</h2></a>
              </span>
           
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
                <?php
                  $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                  $add_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $add_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $empty_database_permission = DB::table('permissions')->where('name', 'empty_database')->first();
                  $empty_database_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $empty_database_permission->id],
                      ['role_id', $role->id]
                  ])->first();
                ?>
                @if($add_permission_active)
                  <li class="nav-item {{ Route::is('vendor-dashboard') ? 'd-none' : '' }}" ><a class="dropdown-item btn-pos btn-sm" href="{{route('sale.pos')}}"><i class="dripicons-shopping-bag"></i><span> POS</span></a></li>
                @endif
                <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip" title="{{trans('file.Full Screen')}}"><i class="dripicons-expand"></i></a></li>
                @if(\Auth::user()->role_id <= 2)
                 <!-- <li class="nav-item"><a href="{{route('cashRegister.index')}}" data-toggle="tooltip" title="{{trans('file.Cash Register List')}}"><i class="dripicons-archive"></i></a></li>-->
                @endif
                @if(userHasAccess('product-qty-alert'))

                  @if(($alert_product + count(\Auth::user()->unreadNotifications)) > 0)
                  <li class="nav-item" id="notification-icon">
                        <a rel="nofollow" data-toggle="tooltip" title="{{__('Notifications')}}" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger notification-number">{{$alert_product + count(\Auth::user()->unreadNotifications)}}</span>
                        </a>
                        
                        <ul class="right-sidebar">
                            <li class="notifications">
                              <a href="{{route('report.qtyAlert')}}" class="btn btn-link"> {{$alert_product}} product exceeds alert quantity</a>
                              
                            </li>
                            @foreach(\Auth::user()->unreadNotifications as $key => $notification)
                              @if($notification->type == "App\Notifications\VendorNotification")
                                <li class="notifications">
                                    <a href="{{route('vendorproducts.index')}}" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                </li>
                                @else
                                <li class="notifications">
                                    <a href="{{route('products.index')}}" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                  </li>
                  @elseif(count(\Auth::user()->unreadNotifications) > 0)
                  <li class="nav-item" id="notification-icon">
                        <a rel="nofollow" data-toggle="tooltip" title="{{__('Notifications')}}" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger notification-number">{{count(\Auth::user()->unreadNotifications)}}</span>
                        </a>
                        <ul class="right-sidebar">
                            @foreach(\Auth::user()->unreadNotifications as $key => $notification)
                                <li class="notifications">
                                    <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                  </li>
                  @endif
                @endif
               <!-- <li class="nav-item">
                      <a rel="nofollow" title="{{trans('file.language')}}" data-toggle="tooltip" class="nav-link dropdown-item"><i class="dripicons-web"></i></a>
                      <ul class="right-sidebar">
                          <li>
                            <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/es') }}" class="btn btn-link"> Español</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/ar') }}" class="btn btn-link"> عربى</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/pt_BR') }}" class="btn btn-link"> Portuguese</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/fr') }}" class="btn btn-link"> Français</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/de') }}" class="btn btn-link"> Deutsche</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/id') }}" class="btn btn-link"> Malay</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/hi') }}" class="btn btn-link"> हिंदी</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/vi') }}" class="btn btn-link"> Tiếng Việt</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/ru') }}" class="btn btn-link"> русский</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/bg') }}" class="btn btn-link"> български</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/tr') }}" class="btn btn-link"> Türk</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/it') }}" class="btn btn-link"> Italiano</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/nl') }}" class="btn btn-link"> Nederlands</a>
                          </li>
                          <li>
                            <a href="{{ url('language_switch/lao') }}" class="btn btn-link"> Lao</a>
                          </li>
                      </ul>
                </li>-->
               
                <!-- <li class="nav-item">
                    <a class="dropdown-item" href="{{ url('public/read_me') }}" target="_blank" data-toggle="tooltip" title="{{__('Help')}}"><i class="dripicons-information"></i></a>
                </li> -->
               
                <li class="nav-item">
                  <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->name)}}</span> <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="right-sidebar">
                      <li>
                        <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
                      </li>
                      @if(userHasAccess('general_setting'))
                      <li>
                        <a href="{{route('setting.general')}}"><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
                      </li>
                      @endif
                      <li>
                        <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>
                      </li>
                      @if(Auth::user()->role_id != 5)
                     <li>
                        <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="dripicons-vibrate"></i> {{trans('file.My Holiday')}}</a>
                      </li>
                      @endif
                      @if($empty_database_permission_active)
                      <li>
                        <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')" href="{{route('setting.emptyDatabase')}}"><i class="dripicons-stack"></i> {{trans('file.Empty Database')}}</a>
                      </li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                            {{trans('file.logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page">

        <!-- notification modal -->
        <div id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Send Notification')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'notifications.store', 'method' => 'post']) !!}
                        <div class="row">
                            <?php
                                $lims_user_list = DB::table('users')->where([
                                  ['is_active', true],
                                  ['id', '!=', \Auth::user()->id]
                                ])->get();
                            ?>
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.User')}} *</label>
                                <select name="user_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select user...">
                                    @foreach($lims_user_list as $user)
                                    <option value="{{$user->id}}">{{$user->name . ' (' . $user->email. ')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{trans('file.Message')}} *</label>
                                <textarea rows="5" name="message" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end notification modal -->

        <!-- expense modal -->
        <div id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Expense')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
                      <?php
                        $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
                        if(Auth::user()->role_id > 2)
                          $lims_warehouse_list = DB::table('warehouses')->where([
                            ['is_active', true],
                            ['id', Auth::user()->warehouse_id]
                          ])->get();
                        else
                          $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                        $lims_account_list = \App\Account::where('is_active', true)->get();

                      ?>
                      <?php $outletId = Auth::user()->warehouse_id ?>
                        <div class="row">
                          <div class="col-md-6 form-group">
                              <label>{{trans('file.Expense Category')}} *</label>
                              <select name="expense_category_id" class="selectpicker form-control " required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                                  @foreach($lims_expense_category_list as $expense_category)
                                  <option value="{{$expense_category->id}}" >{{$expense_category->name . ' (' . $expense_category->code. ')'}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6 form-group" id="outletStoreDiv">
                              <label>{{trans('file.Warehouse')}} *</label>
                              <select name="warehouse_id" class="selectpicker form-control outletStore" required data-live-search="true" data-live-search-style="begins" title="Select Outlet...">
                                  @foreach($lims_warehouse_list as $warehouse)
                                  <option value="{{$warehouse->id}}"  <?php echo "{{$warehouse->id}}" == "{{$outletId}}" ?   "selected" : '' ;?>>{{$warehouse->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6 form-group">
                              <label>{{trans('file.Amount')}} *</label>
                              <input type="number" name="amount" step="any" required class="form-control">
                          </div>
                          <div class="col-md-6 form-group">
                              <label> {{trans('file.Account')}}</label>
                              <select class="form-control selectpicker" name="account_id">
                              @foreach($lims_account_list as $account)
                                  @if($account->is_default)
                                  <option selected value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                                  @else
                                  <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                                  @endif
                              @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Note')}}</label>
                            <textarea name="note" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <div id="outlet-modal" tabindex="-1" role="dialog" aria-labelledby="outletModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Default Warehouse')}}</h5>
                      <button type="button" data-dismiss="modal"  aria-label="Close" class="close"><span aria-hidden="true" ><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <!-- <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p> -->
                      
                      
                      <?php $outletId = Auth::user()->warehouse_id ?>
                        <div class="row">
                          <div class="col-md-6 form-group" id="outletDropdown">
                              <label>{{trans('file.Outlet')}} *</label>
                              <select name="outlet_id" class="selectpicker form-control " required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                                  @foreach($lims_expense_category_list as $expense_category)
                                  <option value="{{$expense_category->id}}" >{{$expense_category->name . ' (' . $expense_category->code. ')'}}</option>
                                  @endforeach
                              </select>
                          </div>
                        
                          
                        </div>
                      
                        <!-- <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div> -->
                    
                  </div>
              </div>
          </div>
        </div>
        <!-- end expense modal -->

        <!-- account modal -->
        <div id="account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Account')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label>{{trans('file.Account No')}} *</label>
                            <input type="text" name="account_no" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.name')}} *</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Initial Balance')}}</label>
                            <input type="number" name="initial_balance" step="any" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Note')}}</label>
                            <textarea name="note" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end account modal -->

        <!-- account statement modal -->
        <div id="account-statement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Account Statement')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
                        <div class="row">
                          <div class="col-md-6 form-group">
                              <label> {{trans('file.Account')}}</label>
                              <select class="form-control selectpicker" name="account_id">
                              @foreach($lims_account_list as $account)
                                  <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="col-md-6 form-group">
                              <label> {{trans('file.Type')}}</label>
                              <select class="form-control selectpicker" name="type">
                                  <option value="0">{{trans('file.All')}}</option>
                                  <option value="1">{{trans('file.Debit')}}</option>
                                  <option value="2">{{trans('file.Credit')}}</option>
                              </select>
                          </div>
                          <div class="col-md-12 form-group">
                              <label>{{trans('file.Choose Your Date')}}</label>
                              <div class="input-group">
                                  <input type="text" class="daterangepicker-field form-control" required />
                                  <input type="hidden" name="start_date" />
                                  <input type="hidden" name="end_date" />
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end account statement modal -->

        <!-- warehouse modal -->
        <div id="warehouse-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Warehouse Report')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}
                      <?php
                        $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                      ?>
                        <div class="form-group">
                            <label>{{trans('file.Warehouse')}} *</label>
                            <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" id="warehouse-id" data-live-search-style="begins" title="Select warehouse...">
                                @foreach($lims_warehouse_list as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                        <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end warehouse modal -->

        <!-- user modal -->
        <div id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.User Report')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
                      <?php
                        $lims_user_list = DB::table('users')->where('is_active', true)->get();
                      ?>
                        <div class="form-group">
                            <label>{{trans('file.User')}} *</label>
                            <select name="user_id" class="selectpicker form-control" required data-live-search="true" id="user-id" data-live-search-style="begins" title="Select user...">
                                @foreach($lims_user_list as $user)
                                <option value="{{$user->id}}">{{$user->name . ' (' . $user->phone. ')'}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                        <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end user modal -->

        <!-- customer modal -->
        <div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Customer Report')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
                      <?php
                        $lims_customer_list = DB::table('customers')->where('is_active', true)->get();
                      ?>
                        <div class="form-group">
                            <label>{{trans('file.customer')}} *</label>
                            <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
                                @foreach($lims_customer_list as $customer)
                                <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number. ')'}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                        <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end customer modal -->

        <!-- supplier modal -->
        <div id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Supplier Report')}}</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                  </div>
                  <div class="modal-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                      {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
                      <?php
                        $lims_supplier_list = DB::table('suppliers')->where('is_active', true)->get();
                      ?>
                        <div class="form-group">
                            <label>{{trans('file.Supplier')}} *</label>
                            <select name="supplier_id" class="selectpicker form-control" required data-live-search="true" id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
                                @foreach($lims_supplier_list as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name . ' (' . $supplier->phone_number. ')'}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                        <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                        </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
        </div>
        <!-- end supplier modal -->

        <div style="display:none" id="content" class="animate-bottom">

          {{--======= Page Navigator =======--}}
            @include('__sections.breadcrumb')
          {{--======== Page Navigator =======--}}

          @yield('content')

        </div>

      
      </div>
      {{-- <div>
        <small class="text-center">© {{$general_setting->site_title}} | {{trans('file.Developed')}} {{trans('file.By')}} <span class="external">{{$general_setting->developed_by}}</span></small>
      </div> --}}
    </main>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
      function Alert(type, text) {
        Swal.fire({
          title: text,
          icon: type, 
          customClass: {
            confirmButton: 'btn btn-primary px-4',
          },
          confirmButtonText: 'Okay !',
          buttonsStyling: false
        }); 
      }
      function confirmDeleteAlert(form) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this record !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0095ff',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Alert("success", "Deleted Successfully !")
            form.submit();
          } 
        })
        return false;
      }
    </script>

    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/charts-custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    
    

    @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
      <script type="text/javascript" src="<?php echo asset('js/front_rtl.js') ?>"></script>
    @else
      <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
    @endif

    @if(Route::current()->getName() != '/')
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/moment.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/daterangepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/dropzone.js') ?>"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.buttons.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.bootstrap4.min.js') ?>">"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.colVis.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.html5.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.print.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo asset('vendor/datatable/sum().js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    @endif
    @stack('scripts')
    <script>
    
    <?php $id =Auth::user()->role_id ?>
    var auth_id = {{$id}};
    if(auth_id != 1)
    {
    
        // $('.outletStore').prop('disabled',true);
        // $('#outletStoreDiv').hide();
    }
    else if(auth_id == 1)
    {
        // $('.outletStore').prop('disabled',false);
       
    }
        if ('serviceWorker' in navigator ) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/salepro/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
    <script type="text/javascript">

      var alert_product = <?php echo json_encode($alert_product) ?>;

      if ($(window).outerWidth() > 1199) {
          $('nav.side-navbar').removeClass('shrink');
      }
      function myFunction() {
          setTimeout(showPage, 150);
      }
      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
      }

      $("div.alert").delay(3000).slideUp(750);

      function confirmDelete() {
          if (confirm("Are you sure want to delete?")) {
              return true;
          }
          return false;
      }

      $("li#notification-icon").on("click", function (argument) {
          $.get('notifications/mark-as-read', function(data) {
              $("span.notification-number").text(alert_product);
          });
      });

      $("a#add-expense").click(function(e){
        e.preventDefault();
        $('#expense-modal').modal();
      });

      $("a#send-notification").click(function(e){
        e.preventDefault();
        $('#notification-modal').modal();
      });

      $("a#add-account").click(function(e){
        e.preventDefault();
        $('#account-modal').modal();
      });

      $("a#account-statement").click(function(e){
        e.preventDefault();
        $('#account-statement-modal').modal();
      });

      $("a#profitLoss-link").click(function(e){
        e.preventDefault();
        $("#profitLoss-report-form").submit();
      });

      $("a#report-link").click(function(e){
        e.preventDefault();
        $("#product-report-form").submit();
      });

      $("a#purchase-report-link").click(function(e){
        e.preventDefault();
        $("#purchase-report-form").submit();
      });

      $("a#sale-report-link").click(function(e){
        e.preventDefault();
        $("#sale-report-form").submit();
      });

      $("a#payment-report-link").click(function(e){
        e.preventDefault();
        $("#payment-report-form").submit();
      });

      $("a#warehouse-report-link").click(function(e){
        e.preventDefault();
        $('#warehouse-modal').modal();
      });

      $("a#user-report-link").click(function(e){
        e.preventDefault();
        $('#user-modal').modal();
      });

      $("a#customer-report-link").click(function(e){
        e.preventDefault();
        $('#customer-modal').modal();
      });

      $("a#supplier-report-link").click(function(e){
        e.preventDefault();
        $('#supplier-modal').modal();
      });

      $("a#due-report-link").click(function(e){
        e.preventDefault();
        $("#due-report-form").submit();
      });

      $(".daterangepicker-field").daterangepicker({
          callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('#account-statement-modal input[name="start_date"]').val(start_date);
            $('#account-statement-modal input[name="end_date"]').val(end_date);
          }
      });

      $('.selectpicker').selectpicker({
          style: 'btn-link',
      });
      function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;
            return true;
        }
    </script> 
  </body>
</html>
