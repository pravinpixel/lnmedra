@extends('layout.top-head')
@section('content')
<style>
    .modal-header {
        align-items: center !important;
        background: #204A24 !important;
        color: white !important;
        font-weight: bold !important; 
    }
    .modal-header h5 {
        font-size: 1.5rem !important; 
    }
    .table.change_grid  tr{
        display: flex !important;
        flex-direction: column !important;
    }
    .table.change_grid  tr:hover {
        background: unset !important
    }
    .table.change_grid td {
        width: 99% !important;
        display: flex !important;
        justify-content: start !important;
        align-items: center !important;
        padding: 0 !important;
        flex-direction: row-reverse !important
    }
    .table.change_grid td:hover p {
        color: black !important
    }
    .table.change_grid td:hover {
        background: #f6fff6 !important;
        box-shadow: 0 3px 6px lightgray !important;
    }
    .table.change_grid td img {
        display: none !important
    }
    .table.change_grid td p {
        margin-left:auto !important;
        margin-top:  0 !important;
        margin-bottom:  0 !important;
        border-left: 1px solid #d8d8d8 !important;
        padding: 0 0 0 15px !important;
        color :  slategrey !important;
        font-weight: bold !important;
        letter-spacing: 1px !important;
        min-width: 70% !important;
        text-align: start;
        line-height: 25px !important
    }
    .table.change_grid td span {
        color: #fff;
        background-color: #28a745;
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        margin: 0 10px !important
    }
    .btn-info {
        background:  #ABD5E1 !important;
        border-color:  #ABD5E1 !important;
        color: #272524 !important
    }
</style>
@php
    if($lims_pos_setting_data)
        $keybord_active = $lims_pos_setting_data->keybord_active;
    else
        $keybord_active = 0;

    $customer_active = DB::table('permissions')
        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
        ->where([
        ['permissions.name', 'customers-add'],
        ['role_id', \Auth::user()->role_id] ])->first();
        $role = DB::table('roles')->find(Auth::user()->role_id);

    // =========== Index Permission  ====== ======

        $index_permission = DB::table('permissions')->where('name', 'products-index')->first();
        $index_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $index_permission->id],
            ['role_id', $role->id]
        ])->first();

        $print_barcode = DB::table('permissions')->where('name', 'print_barcode')->first();
        $print_barcode_active = DB::table('role_has_permissions')->where([
            ['permission_id', $print_barcode->id],
            ['role_id', $role->id]
        ])->first();

        $stock_count = DB::table('permissions')->where('name', 'stock_count')->first();
        $stock_count_active = DB::table('role_has_permissions')->where([
            ['permission_id', $stock_count->id],
            ['role_id', $role->id]
        ])->first();

        $adjustment = DB::table('permissions')->where('name', 'adjustment')->first();
        $adjustment_active = DB::table('role_has_permissions')->where([
            ['permission_id', $adjustment->id],
            ['role_id', $role->id]
        ])->first();

    // =========== END: Index Permission  ====== ======

   $outletId = Auth::user()->warehouse_id ;


   if($lims_pos_setting_data)
        $keybord_active = $lims_pos_setting_data->keybord_active;
    else
        $keybord_active = 0;

    $customer_active = DB::table('permissions')->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')->where([['permissions.name', 'customers-add'],['role_id', \Auth::user()->role_id] ])->first();

    $general_setting_permission = DB::table('permissions')->where('name', 'general_setting')->first();
    $general_setting_permission_active = DB::table('role_has_permissions')->where([
                ['permission_id', $general_setting_permission->id],
                ['role_id', Auth::user()->role_id]
            ])->first();

    $pos_setting_permission = DB::table('permissions')->where('name', 'pos_setting')->first();

    $pos_setting_permission_active = DB::table('role_has_permissions')->where([
        ['permission_id', $pos_setting_permission->id],
        ['role_id', Auth::user()->role_id]
    ])->first();
    $today_sale_permission = DB::table('permissions')->where('name', 'today_sale')->first();
    $today_sale_permission_active = DB::table('role_has_permissions')->where([
                ['permission_id', $today_sale_permission->id],
                ['role_id', Auth::user()->role_id]
            ])->first();

    $today_profit_permission = DB::table('permissions')->where('name', 'today_profit')->first();
    $today_profit_permission_active = DB::table('role_has_permissions')->where([
                ['permission_id', $today_profit_permission->id],
                ['role_id', Auth::user()->role_id]
            ])->first();
@endphp    
 
 <!-- add cash register modal -->
 <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row m-0">
                  <div class="col-md-6 form-group warehouse-section">
                      <label>{{trans('file.Outlet')}} *</strong> </label>
                      <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                          @foreach($lims_warehouse_list as $warehouse)
                          <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                      <input type="number" name="cash_in_hand" required class="form-control">
                  </div>
                  <div class="col-md-12 form-group">
                      <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                  </div>
                </div>
            </div>
            <!-- payment modal -->
   
            {{ Form::close() }}
          </div>
        </div>
    </div>
    <!-- add customer modal -->
    <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="form-group">
                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                    <select required class="form-control selectpicker" name="customer_group_id">
                        @foreach($lims_customer_group_all as $customer_group)
                            <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('file.name')}} *</strong> </label>
                    <input type="text" name="customer_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone_number" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Address')}} *</label>
                    <input type="text" name="address" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.City')}} *</label>
                    <input type="text" name="city" required class="form-control">
                </div>
               
                <div class="form-group">
                    <label>{{trans('file.requirement')}}</strong> </label>
                    
                        <select name="requirement" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('requirement')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins" required>
                            <option value="1" {{old ('requirement') == 1 ? 'selected' : ''}}>Landscape design</option>
                            <option value="2" {{old ('requirement') == 2 ? 'selected' : ''}}>Landscape execution</option>
                            <option value="3" {{old ('requirement') == 3 ? 'selected' : ''}}>Retail sale</option>
                        </select>
                    
                </div>
                        
                <div class="form-group">
                <input type="hidden" name="pos" value="1">
                  <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>
<!-- Side Navbar -->
<div id="holdbillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Hold Bill')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            {{-- <div class="form-group">
                <p>Hold Bill ?</p>
                <div class="row">
                    <button class="btn btn-light" onclick="holdbillsave('yes')" >Yes</button>
                    <button class="btn btn-light " onclick="holdbillsave('no')">No</button>
                </div>
            </div> --}}
            <table class="table m-0 border-0" style="cursor: pointer;"> 
                <tbody id="modalHoldBill">
                    
                </tbody>
            </table>
            
        </div>
      </div>
    </div>
</div>
<header class="header m-0 bg-dark text-white " style="border-bottom: 2px solid #272524">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark text-white">
            <a class="navbar-brand py-2" href="{{ route('home') }}">
                <img src="{{ asset('logo/logo_dark.png') }}" height="90"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div>
            <?php $site_title = DB::table('general_settings')->select('site_title')->first(); ?>
                <a href="{{url('/')}}" class="text-white"><strong>{{$site_title->site_title}} | Sales & POS Management</strong></a>
                
            </div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-warning" onclick="holldbillModal()" >Hold Bill</button>
                        {{-- <button type="button" class="btn btn-info" onclick="localStorageClear()" >clear</button> --}}
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link"><i class="dripicons-home text-white"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i  id="goFS" onclick="toggleFullScreen()" class="text-white dripicons-expand"></i></a>
                    </li>
                    <li class="nav-item dropdown text-white">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-gear text-white"></i> <b>{{ucfirst(Auth::user()->name)}}</b>
                        </a>
                        <div class="dropdown-menu shadow-sm border" aria-labelledby="navbarDropdownMenuLink" style="transform: translateX(-66px);">
                            <a class="dropdown-item" href="{{route('user.profile', ['id' => Auth::id()])}}">
                                <i class="dripicons-user"></i> {{trans('file.profile')}}
                            </a>
                            {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="dripicons-power"></i>
                                {{trans('file.logout')}}
                            </a> --}}
                            <a class="dropdown-item" href="#" onclick="logoutFun()">
                                <i class="dripicons-power"></i>
                                {{trans('file.logout')}}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav> 
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</header>
 
<nav class="side-navbar  shrink">
    <div class="side-navbar-wrapper">
      <div class="main-menu">
        <ul id="side-main-menu" class="side-menu list-unstyled">
          <li><a href="{{url('/')}}"> <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span></a></li>  
          <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.product')}}</span><span></a>
            <ul id="product" class="collapse list-unstyled ">
              <li id="category-menu"><a href="{{route('category.index')}}">{{__('file.category')}}</a></li>
              @if($index_permission_active)
              <li id="product-list-menu"><a href="{{route('products.index')}}">{{__('file.product_list')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'products-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="product-create-menu"><a href="{{route('products.create')}}">{{__('file.add_product')}}</a></li>
              @endif
              @endif
              @if($print_barcode_active)
              <li id="printBarcode-menu"><a href="{{route('product.printBarcode')}}">{{__('file.print_barcode')}}</a></li>
              @endif
              @if($adjustment_active)
                <li id="adjustment-list-menu"><a href="{{route('qty_adjustment.index')}}">{{trans('file.Adjustment List')}}</a></li>
                <li id="adjustment-create-menu"><a href="{{route('qty_adjustment.create')}}">{{trans('file.Add Adjustment')}}</a></li>
              @endif
              @if($stock_count_active)
                <li id="stock-count-menu"><a href="{{route('stock-count.index')}}">{{trans('file.Stock Count')}}</a></li>
              @endif
            </ul>
          </li>
          <?php
            $index_permission = DB::table('permissions')->where('name', 'purchases-index')->first();
              $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('file.Purchase')}}</span></a>
            <ul id="purchase" class="collapse list-unstyled ">
              <li id="purchase-list-menu"><a href="{{route('purchases.index')}}">{{trans('file.Purchase List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'purchases-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="purchase-create-menu"><a href="{{route('purchases.create')}}">{{trans('file.Add Purchase')}}</a></li>
              <li id="purchase-import-menu"><a href="{{url('purchases/purchase_by_csv')}}">{{trans('file.Import Purchase By CSV')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php
            $index_permission = DB::table('permissions')->where('name', 'sales-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();

            $gift_card_permission = DB::table('permissions')->where('name', 'gift_card')->first();
            $gift_card_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $gift_card_permission->id],
                    ['role_id', $role->id]
                ])->first();

            $coupon_permission = DB::table('permissions')->where('name', 'coupon')->first();
            $coupon_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $coupon_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>

          <li><a href="#sale" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span>{{trans('file.Sale')}}</span></a>
            <ul id="sale" class="collapse list-unstyled ">
              @if($index_permission_active)
              <li id="sale-list-menu"><a href="{{route('sales.index')}}">{{trans('file.Sale List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li><a href="{{route('sale.pos')}}">POS</a></li>
              <li id="sale-create-menu"><a href="{{route('sales.create')}}">{{trans('file.Add Sale')}}</a></li>
              <li id="sale-import-menu"><a href="{{url('sales/sale_by_csv')}}">{{trans('file.Import Sale By CSV')}}</a></li>
              @endif
              @endif
              @if($gift_card_permission_active)
              <li id="gift-card-menu"><a href="{{route('gift_cards.index')}}">{{trans('file.Gift Card List')}}</a> </li>
              @endif
              @if($coupon_permission_active)
              <li id="coupon-menu"><a href="{{route('coupons.index')}}">{{trans('file.Coupon List')}}</a> </li>
              @endif
              <li id="delivery-menu"><a href="{{route('delivery.index')}}">{{trans('file.Delivery List')}}</a></li>
            </ul>
          </li>
          <?php
            $index_permission = DB::table('permissions')->where('name', 'expenses-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>{{trans('file.Expense')}}</span></a>
            <ul id="expense" class="collapse list-unstyled ">
              <li id="exp-cat-menu"><a href="{{route('expense_categories.index')}}">{{trans('file.Expense Category')}}</a></li>
              <li id="exp-list-menu"><a href="{{route('expenses.index')}}">{{trans('file.Expense List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'expenses-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li><a id="add-expense" href=""> {{trans('file.Add Expense')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php
            $index_permission = DB::table('permissions')->where('name', 'quotes-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>{{trans('file.Quotation')}}</span><span></a>
            <ul id="quotation" class="collapse list-unstyled ">
              <li id="quotation-list-menu"><a href="{{route('quotations.index')}}">{{trans('file.Quotation List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'quotes-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="quotation-create-menu"><a href="{{route('quotations.create')}}">{{trans('file.Add Quotation')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php
            $index_permission = DB::table('permissions')->where('name', 'transfers-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-export"></i><span>{{trans('file.Transfer')}}</span></a>
            <ul id="transfer" class="collapse list-unstyled ">
              <li id="transfer-list-menu"><a href="{{route('transfers.index')}}">{{trans('file.Transfer List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'transfers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="transfer-create-menu"><a href="{{route('transfers.create')}}">{{trans('file.Add Transfer')}}</a></li>
              <li id="transfer-import-menu"><a href="{{url('transfers/transfer_by_csv')}}">{{trans('file.Import Transfer By CSV')}}</a></li>
              @endif
            </ul>
          </li>
          @endif

          <li><a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-return"></i><span>{{trans('file.return')}}</span></a>
            <ul id="return" class="collapse list-unstyled ">
              <?php
                $index_permission = DB::table('permissions')->where('name', 'returns-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="sale-return-menu"><a href="{{route('return-sale.index')}}">{{trans('file.Sale')}}</a></li>
              @endif
              <?php
                $index_permission = DB::table('permissions')->where('name', 'purchase-return-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="purchase-return-menu"><a href="{{route('return-purchase.index')}}">{{trans('file.Purchase')}}</a></li>
              @endif
            </ul>
          </li>
          <?php
            $index_permission = DB::table('permissions')->where('name', 'account-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();

            $money_transfer_permission = DB::table('permissions')->where('name', 'money-transfer')->first();
            $money_transfer_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $money_transfer_permission->id],
                    ['role_id', $role->id]
                ])->first();

            $balance_sheet_permission = DB::table('permissions')->where('name', 'balance-sheet')->first();
            $balance_sheet_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $balance_sheet_permission->id],
                    ['role_id', $role->id]
                ])->first();

            $account_statement_permission = DB::table('permissions')->where('name', 'account-statement')->first();
            $account_statement_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $account_statement_permission->id],
                    ['role_id', $role->id]
                ])->first();

          ?>
          @if($index_permission_active || $balance_sheet_permission_active || $account_statement_permission_active)
          <li><a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{trans('file.Accounting')}}</span></a>
            <ul id="account" class="collapse list-unstyled ">
              @if($index_permission_active)
              <li id="account-list-menu"><a href="{{route('accounts.index')}}">{{trans('file.Account List')}}</a></li>
              <li><a id="add-account" href="">{{trans('file.Add Account')}}</a></li>
              @endif
              @if($money_transfer_permission_active)
              <li id="money-transfer-menu"><a href="{{route('money-transfers.index')}}">{{trans('file.Money Transfer')}}</a></li>
              @endif
              @if($balance_sheet_permission_active)
              <li id="balance-sheet-menu"><a href="{{route('accounts.balancesheet')}}">{{trans('file.Balance Sheet')}}</a></li>
              @endif
              @if($account_statement_permission_active)
              <li id="account-statement-menu"><a id="account-statement" href="">{{trans('file.Account Statement')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php
            $department = DB::table('permissions')->where('name', 'department')->first();
            $department_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $department->id],
                    ['role_id', $role->id]
                ])->first();
            $index_employee = DB::table('permissions')->where('name', 'employees-index')->first();
            $index_employee_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_employee->id],
                    ['role_id', $role->id]
                ])->first();
            $attendance = DB::table('permissions')->where('name', 'attendance')->first();
            $attendance_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $attendance->id],
                    ['role_id', $role->id]
                ])->first();
            $payroll = DB::table('permissions')->where('name', 'payroll')->first();
            $payroll_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $payroll->id],
                    ['role_id', $role->id]
                ])->first();
          ?>

          <li><a href="#hrm" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>HRM</span></a>
            <ul id="hrm" class="collapse list-unstyled ">
              @if($department_active)
              <li id="dept-menu"><a href="{{route('departments.index')}}">{{trans('file.Department')}}</a></li>
              @endif
              @if($index_employee_active)
              <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('file.Employee')}}</a></li>
              @endif
              @if($attendance_active)
              <li id="attendance-menu"><a href="{{route('attendance.index')}}">{{trans('file.Attendance')}}</a></li>
              @endif
              @if($payroll_active)
              <li id="payroll-menu"><a href="{{route('payroll.index')}}">{{trans('file.Payroll')}}</a></li>
              @endif
              <li id="holiday-menu"><a href="{{route('holidays.index')}}">{{trans('file.Holiday')}}</a></li>
            </ul>
          </li>

          <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{trans('file.People')}}</span></a>
            <ul id="people" class="collapse list-unstyled ">
              <?php $index_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'users-index'],
                      ['role_id', $role->id] ])->first();
              ?>
              @if($index_permission_active)
              <li id="user-list-menu"><a href="{{route('user.index')}}">{{trans('file.User List')}}</a></li>
              <?php $add_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'users-add'],
                      ['role_id', $role->id] ])->first();
              ?>
              @if($add_permission_active)
              <li id="user-create-menu"><a href="{{route('user.create')}}">{{trans('file.Add User')}}</a></li>
              @endif
              @endif
              <?php
                $index_permission = DB::table('permissions')->where('name', 'customers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="customer-list-menu"><a href="{{route('customer.index')}}">{{trans('file.Customer List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'customers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="customer-create-menu"><a href="{{route('customer.create')}}">{{trans('file.Add Customer')}}</a></li>
              @endif
              @endif
              <?php
                $index_permission = DB::table('permissions')->where('name', 'billers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="biller-list-menu"><a href="{{route('biller.index')}}">{{trans('file.Biller List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'billers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="biller-create-menu"><a href="{{route('biller.create')}}">{{trans('file.Add Biller')}}</a></li>
              @endif
              @endif
              <?php
                $index_permission = DB::table('permissions')->where('name', 'suppliers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="supplier-list-menu"><a href="{{route('supplier.index')}}">{{trans('file.Supplier List')}}</a></li>
              <?php
                $add_permission = DB::table('permissions')->where('name', 'suppliers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="supplier-create-menu"><a href="{{route('supplier.create')}}">{{trans('file.Add Supplier')}}</a></li>
              @endif
              @endif
            </ul>
          </li>
          <li><a href="#report" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{trans('file.Reports')}}</span></a>
            <?php
              $profit_loss_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'profit-loss'],
                      ['role_id', $role->id] ])->first();
              $best_seller_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'best-seller'],
                      ['role_id', $role->id] ])->first();
              $warehouse_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'warehouse-report'],
                      ['role_id', $role->id] ])->first();
              $warehouse_stock_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'warehouse-stock-report'],
                      ['role_id', $role->id] ])->first();
              $product_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'product-report'],
                      ['role_id', $role->id] ])->first();
              $daily_sale_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'daily-sale'],
                      ['role_id', $role->id] ])->first();
              $monthly_sale_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'monthly-sale'],
                      ['role_id', $role->id]])->first();
              $daily_purchase_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'daily-purchase'],
                      ['role_id', $role->id] ])->first();
              $monthly_purchase_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'monthly-purchase'],
                      ['role_id', $role->id] ])->first();
              $purchase_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'purchase-report'],
                      ['role_id', $role->id] ])->first();
              $sale_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'sale-report'],
                      ['role_id', $role->id] ])->first();
              $payment_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'payment-report'],
                      ['role_id', $role->id] ])->first();
              $product_qty_alert_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'product-qty-alert'],
                      ['role_id', $role->id] ])->first();
              $user_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'user-report'],
                      ['role_id', $role->id] ])->first();

              $customer_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'customer-report'],
                      ['role_id', $role->id] ])->first();
              $supplier_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'supplier-report'],
                      ['role_id', $role->id] ])->first();
              $due_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'due-report'],
                      ['role_id', $role->id] ])->first();
            ?>
            <ul id="report" class="collapse list-unstyled ">
              @if($profit_loss_active)
              <li id="profit-loss-report-menu">
                {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="profitLoss-link" href="">{{trans('file.Summary Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($best_seller_active)
              <li id="best-seller-report-menu">
                <a href="{{url('report/best_seller')}}">{{trans('file.Best Seller')}}</a>
              </li>
              @endif
              @if($product_report_active)
              <li id="product-report-menu">
                {!! Form::open(['route' => 'report.product', 'method' => 'get', 'id' => 'product-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="report-link" href="">{{trans('file.Product Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($daily_sale_active)
              <li id="daily-sale-report-menu">
                <a href="{{url('report/daily_sale/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Sale')}}</a>
              </li>
              @endif
              @if($monthly_sale_active)
              <li id="monthly-sale-report-menu">
                <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>
              </li>
              @endif
              @if($daily_purchase_active)
              <li id="daily-purchase-report-menu">
                <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Purchase')}}</a>
              </li>
              @endif
              @if($monthly_purchase_active)
              <li id="monthly-purchase-report-menu">
                <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{trans('file.Monthly Purchase')}}</a>
              </li>
              @endif
              @if($sale_report_active)
              <li id="sale-report-menu">
                {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="sale-report-link" href="">{{trans('file.Sale Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($payment_report_active)
              <li id="payment-report-menu">
                {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="payment-report-link" href="">{{trans('file.Payment Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($purchase_report_active)
              <li id="purchase-report-menu">
                {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="purchase-report-link" href="">{{trans('file.Purchase Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($warehouse_report_active)
              <li id="warehouse-report-menu">
                <a id="warehouse-report-link" href="">{{trans('file.Outlet Report')}}</a>
              </li>
              @endif
              @if($warehouse_stock_report_active)
              <li id="warehouse-stock-report-menu">
                <a href="{{route('report.warehouseStock')}}">{{trans('file.Outlet Stock Chart')}}</a>
              </li>
              @endif
              @if($product_qty_alert_active)
              <li id="qtyAlert-report-menu">
                <a href="{{route('report.qtyAlert')}}">{{trans('file.Product Quantity Alert')}}</a>
              </li>
              @endif
              @if($user_report_active)
              <li id="user-report-menu">
                <a id="user-report-link" href="">{{trans('file.User Report')}}</a>
              </li>
              @endif
              @if($customer_report_active)
              <li id="customer-report-menu">
                <a id="customer-report-link" href="">{{trans('file.Customer Report')}}</a>
              </li>
              @endif
              @if($supplier_report_active)
              <li id="supplier-report-menu">
                <a id="supplier-report-link" href="">{{trans('file.Supplier Report')}}</a>
              </li>
              @endif
              @if($due_report_active)
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
          <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>{{trans('file.settings')}}</span></a>
            <ul id="setting" class="collapse list-unstyled ">
              <?php

                  $warehouse_permission = DB::table('permissions')->where('name', 'warehouse')->first();
                  $warehouse_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $warehouse_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $customer_group_permission = DB::table('permissions')->where('name', 'customer_group')->first();
                  $customer_group_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $customer_group_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $brand_permission = DB::table('permissions')->where('name', 'brand')->first();
                  $brand_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $brand_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $unit_permission = DB::table('permissions')->where('name', 'unit')->first();
                  $unit_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $unit_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $tax_permission = DB::table('permissions')->where('name', 'tax')->first();
                  $tax_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $tax_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $general_setting_permission = DB::table('permissions')->where('name', 'general_setting')->first();
                  $general_setting_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $general_setting_permission->id],
                              ['role_id', $role->id]
                          ])->first();

                  $mail_setting_permission = DB::table('permissions')->where('name', 'mail_setting')->first();
                  $mail_setting_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $mail_setting_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $sms_setting_permission = DB::table('permissions')->where('name', 'sms_setting')->first();
                  $sms_setting_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $sms_setting_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $create_sms_permission = DB::table('permissions')->where('name', 'create_sms')->first();
                  $create_sms_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $create_sms_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $pos_setting_permission = DB::table('permissions')->where('name', 'pos_setting')->first();
                  $pos_setting_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $pos_setting_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $hrm_setting_permission = DB::table('permissions')->where('name', 'hrm_setting')->first();
                  $hrm_setting_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $hrm_setting_permission->id],
                      ['role_id', $role->id]
                  ])->first();

                  $reward_point_setting_permission = DB::table('permissions')->where('name', 'reward_point_setting')->first();
                  $reward_point_setting_permission_active = DB::table('role_has_permissions')->where([
                      ['permission_id', $reward_point_setting_permission->id],
                      ['role_id', $role->id]
                  ])->first();
              ?>
              @if($role->id <= 2)
              <li id="role-menu"><a href="{{route('role.index')}}">{{trans('file.Role Permission')}}</a></li>
              @endif
              @if($warehouse_permission_active)
              <li id="warehouse-menu"><a href="{{route('warehouse.index')}}">{{trans('file.Outlet')}}</a></li>
              @endif
              @if($customer_group_permission_active)
              <li id="customer-group-menu"><a href="{{route('customer_group.index')}}">{{trans('file.Customer Group')}}</a></li>
              @endif
              @if($brand_permission_active)
              <li id="brand-menu"><a href="{{route('brand.index')}}">{{trans('file.Brand')}}</a></li>
              @endif
              @if($unit_permission_active)
              <li id="unit-menu"><a href="{{route('unit.index')}}">{{trans('file.Unit')}}</a></li>
              @endif
              @if($tax_permission_active)
              <li id="tax-menu"><a href="{{route('tax.index')}}">{{trans('file.Tax')}}</a></li>
              @endif
              <li id="user-menu"><a href="{{route('user.profile', ['id' => Auth::id()])}}">{{trans('file.User Profile')}}</a></li>
              @if($create_sms_permission_active)
              <li id="create-sms-menu"><a href="{{route('setting.createSms')}}">{{trans('file.Create SMS')}}</a></li>
              @endif
              @if($general_setting_permission_active)
              <li id="general-setting-menu"><a href="{{route('setting.general')}}">{{trans('file.General Setting')}}</a></li>
              @endif
              @if($mail_setting_permission_active)
              <li id="mail-setting-menu"><a href="{{route('setting.mail')}}">{{trans('file.Mail Setting')}}</a></li>
              @endif
              @if($reward_point_setting_permission_active)
              <li id="reward-point-setting-menu"><a href="{{route('setting.rewardPoint')}}">{{trans('file.Reward Point Setting')}}</a></li>
              @endif
              @if($sms_setting_permission_active)
              <li id="sms-setting-menu"><a href="{{route('setting.sms')}}">{{trans('file.SMS Setting')}}</a></li>
              @endif
              @if($pos_setting_permission_active)
              <li id="pos-setting-menu"><a href="{{route('setting.pos')}}">POS {{trans('file.settings')}}</a></li>
              @endif
              @if($hrm_setting_permission_active)
              <li id="hrm-setting-menu"><a href="{{route('setting.hrm')}}"> {{trans('file.HRM Setting')}}</a></li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>

<audio id="mysoundclip1" preload="auto"><source src="{{url('public/beep/beep-timber.mp3')}}"></source></audio>
<audio id="mysoundclip2" preload="auto"><source src="{{url('public/beep/beep-07.mp3')}}"></source></audio>

<section class="forms pos-section p-0">
    {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
    <div class="row m-0">
        <div class="col-12 bg-white shadow-sm border-bottom ">
            <div class="p-2">
                <div class="row m-0"> 
                    <div class="col pr-1 pl-0">
                        <div class="form-group m-0" id="warehouse_dev">
                            <small class="text-dark fw-bold">Enter Outlet</small>
                            @if($lims_pos_setting_data)
                                <input type="hidden" name="warehouse_id_hidden" value="{{$outletId}}">
                            @endif
                            <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control outletStore" data-live-search="true" data-live-search-style="begins" title="Select outlet...">
                                @foreach($lims_warehouse_list as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col px-1" id="biller_dev">
                        <div class="form-group m-0">
                            <small class="text-dark fw-bold">Biller</small>
                            @if($lims_pos_setting_data)
                            <input type="hidden" name="biller_id_hidden" value="{{$lims_pos_setting_data->biller_id}}">
                            @endif
                            <select required id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                            @foreach($lims_biller_list as $biller)
                            <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col px-1">
                        <div class="form-group m-0">
                            <small class="text-dark fw-bold">Sales Person Code</small>
                            <input type="text" name="salesPersonCode" class="form-control" value="" onkeyup='saveValue(this);'  placeholder="Type sales person code.." >
                        </div>
                    </div>
                    <div class="col pl-1 pr-0">
                        <small class="text-dark fw-bold">Enter Customer</small>
                        <div class="form-group m-0">

                            @if($lims_pos_setting_data)
                            <input type="hidden" name="customer_id" value="{{$lims_pos_setting_data->customer_id}}">
                            @endif
                            <div class="input-group pos">
                                @if($customer_active)
                                    <div class="btn-group w-100 d-flex">
                                        <select required name="customer_id" id="customer_id" class="selectpicker form-control w-100"  data-live-search="true" title="Select customer..." style="width: 100px">
                                            <?php
                                            $deposit = [];
                                            $points = [];
                                            ?>
                                        @foreach($lims_customer_list as $customer)
                                            @php
                                            $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                            $points[$customer->id] = $customer->points;
                                            @endphp
                                            <option  data-tokens="{{$customer->name . ' (' . $customer->phone_number . ')'}}" value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                        @endforeach
                                        </select>
                                        <button type="button" title="Add Customers" class="btn btn-light border btn-sm" data-toggle="modal" data-target="#addCustomer">
                                            <i class="dripicons-plus mr-1"></i> 
                                        </button>
                                    </div>
                                @else
                                <?php
                                    $deposit = [];
                                    $points = [];
                                ?>
                                
                                <select required name="customer_id" id="customer_id" class="selectpicker form-control"   data-live-search="true"  title="Select customer...">
                                @foreach($lims_customer_list as $customer)
                                    @php
                                        $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                        $points[$customer->id] = $customer->points;
                                    @endphp
                                    <option data-tokens="{{$customer->name . ' (' . $customer->phone_number . ')'}}" value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> 
        </div>  
        <div class="col-md-6 p-0">
            <div>
                <div class="p-3">  
                    <div class="m-0 card form-group border-0">
                        <div class="border border-success border-top-0" style="min-height: 58vh;background:linear-gradient(#fffffff8, #fffffff8) , url('{{ asset('public/logo/logo_two.png') }}');background-size: cover;background-position-y: -135px;">
                            <table id="myTable" class="table order-list m-0 border-0" style="border: none !important">
                                <thead>
                                    <tr class="text-white bg-success border border-success">
                                        <td colspan="6" style="padding: 0 !important" class="text-center"><b>Order Table</b></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left !important;padding: 0 0 0 20px !important">{{trans('file.product')}}</th>
                                        <th>Stock</th>
                                        <th style="text-align: right !important ; padding-right:0 !important">{{trans('file.Price')}}</th>
                                        <th style="text-align: right !important ; padding-right:23px !important">{{trans('file.Quantity')}}</th>
                                        <th style="text-align: right !important ; padding-right:0 !important">{{trans('file.Subtotal')}}</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-id" ></tbody>
                                <input type="hidden" name="holdbillnum" id="holdbillnum" >
                                {{-- <input type="hidden" name="holdbillId" id="holdbillId" > --}}
                            </table>
                        </div>
                    </div>
                    <div class="row m-0" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_qty" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_discount" value="0.00" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_tax" value="0.00"/>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="warehouse_id" id="warehousePaymentId" class="form-control warehousePaymentId"> --}}
                        <input type="hidden" name="paid_amount" class="form-control numkey"  step="any">
                        {{-- <input type="hidden" name="customer_id_hidden"> --}}
                        {{-- <input type="hidden" id="customer_id_hidden" name="customer_id"> --}}
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_price" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="item" />
                                <input type="hidden" name="order_tax" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="grand_total" />
                                <input type="hidden" name="used_points" />
                                <input type="hidden" name="coupon_discount" />
                                <input type="hidden" name="sale_status" value="1" />
                                <input type="hidden" name="coupon_active">
                                <input type="hidden" name="coupon_id">
                                <input type="hidden" name="coupon_discount" />
                                <input type="hidden" name="pos" value="1" />
                                <input type="hidden" name="draft" value="0" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 totals p-0 shadow" >
                        <div class="row m-0 bg-white">
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0 border-right-0">
                                <span class="totals-title">{{trans('file.Items')}}</span><b id="item">0</b>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0 border-right-0">
                                <span class="totals-title">{{trans('file.Total')}}</span><b id="subtotal">0.00</b>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0">
                                <span class="totals-title">{{trans('file.Discount')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount-modal"> <i class="dripicons-document-edit"></i></button></span><b id="discount">0.00</b>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0 border-right-0">
                                <span class="totals-title">{{trans('file.Coupon')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#coupon-modal"><i class="dripicons-document-edit"></i></button></span><b id="coupon-text">0.00</b>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0 border-right-0">
                                <span class="totals-title">{{trans('file.Tax')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax"><i class="dripicons-document-edit"></i></button></span><b id="tax">0.00</b>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-between border border border-success border-top-0">
                                <span class="totals-title">{{trans('file.Shipping')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal"><i class="dripicons-document-edit"></i></button></span><b id="shipping-cost">0.00</b>
                            </div>
                        </div>
                    </div>
                  
                    <!-- order_discount modal -->
                    <div id="order-discount-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{trans('file.Order Discount')}}</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check border shadow-sm p-2 rounded">
                                            
                                            <input type="radio" name="order_discount_method"  class="mr-2" value="amount" <?php if('amount' == $lims_pos_setting_data->discount_method) echo 'checked="checked"'; ?> class="form-control numkey" id="order-total-discount" >
                                            <label  class="form-check-label" for="exampleRadios2">Flat</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check border shadow-sm p-2 rounded">
                                            <input type="radio" name="order_discount_method"  class="mr-2" value="discount" <?php if('discount' == $lims_pos_setting_data->discount_method) echo 'checked="checked"'; ?> class="form-control numkey" id="order-total-discount" >
                                            <label  class="form-check-label" for="exampleRadios2">Percentage</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="" name="order_total_discount" id="order_total_discount">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="order_discount" class="form-control numkey" id="order-discount" onkeyup='saveValue(this);'>
                                    </div>
                                    <button type="button" name="order_discount_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- coupon modal -->
                    <div id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{trans('file.Coupon Code')}}</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" id="coupon-code" class="form-control" placeholder="Type Coupon Code...">
                                    </div>
                                    <button type="button" class="btn btn-primary coupon-check" data-dismiss="modal">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- order_tax modal -->
                    <div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{trans('file.Order Tax')}}</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="order_tax_rate">
                                        <select class="form-control" name="order_tax_rate_select" id="order-tax-rate-select">
                                            <option value="0">No Tax</option>
                                            @foreach($lims_tax_list as $tax)
                                            <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" name="order_tax_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shipping_cost modal -->
                    <div id="shipping-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{trans('file.Shipping Cost')}}</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="shipping_cost" class="form-control numkey" id="shipping-cost-val" step="any" onkeyup='saveValue(this);'>
                                    </div>
                                    <button type="button" name="shipping_cost_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-0 shadow bg-dark">
                        <div class="row m-0  p-0 ">
                            <div class="col p-0">
                                <button type="button" class="h-100 h3 text-white w-100  rounded-0 btn btn-info payment-btn" data-toggle="modal"  id="paypal-btn">
                                    <i class="fa fa-paypal"></i> <b>UPI</b>
                                </button>
                            </div> 
                            
                            <div class="col p-0">
                                <button type="button" class="h-100 w-100 h3 text-white rounded-0 btn btn-primary payment-btn" data-toggle="modal"  id="credit-card-btn">
                                    <i class="fa fa-credit-card"></i> <b>{{trans('file.Card')}}</b>
                                </button>
                            </div>
                            <div class="col p-0">
                                <button type="button" class="h-100 h3 text-white w-100 rounded-0 btn btn-warning payment-btn" data-toggle="modal"  id="cash-btn">
                                    <i class="fa fa-money"></i> <b>{{trans('file.Cash')}}</b>
                                </button>
                            </div>
                            
                            
                            <div class="col p-0">
                                <button type="button" class="h-100 w-100 h3 text-white rounded-0 btn btn-danger" id="cancel-btn" onclick="return confirmCancel()">
                                    <i class="fa fa-close"></i> {{trans('file.Cancel')}}
                                </button>
                            </div> 
                        </div>
                        <div class="text-center p-3">
                            <span class="text-light ">
                                {{trans('file.grand total')}} : 
                            </span>
                            <span class="text-white h1" id="grand-total">0.00</span>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="col-md-6 mt-3 card p-0">
            <div class="card-header bg-light text-white shadow-sm border-bottom">
                <div class="search-box m-0 text-dark">
                    <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control form-control-lg rounded-pill active text-dark"  />
                </div>
                <div class="row m-0 align-items-center">
                    <div class="btn-group col-10 mt-3  p-0">
                        <span class="btn btn-sm w-100 btn-success" id="featured-filter">{{trans('file.Featured')}}</span>
                        <span class="btn btn-sm w-100 btn-info" id="top-sale-filter">{{trans('file.Top Sale')}}</span>
                        <span class="btn btn-sm w-100 btn-warning " id="category-filter">{{trans('file.category')}}</span>
                        <span class="btn btn-sm w-100 btn-dark" id="brand-filter">{{trans('file.Brand')}}</span>
                        
                    </div>
                    <div class="btn-group col mt-3 text-right">
                        <span onclick="change_grid()" class="btn btn-sm btn-light"><i id="grid_icon" class="fa fa-th" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div> 
            <div class="card-body"> 
                <div class="filter-window">
                    <div class="category ">
                        <div class="row m-0 ml-2 mr-2 px-2 p-3">
                            <div class="col-7 h3">Choose category</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row m-0 ml-2 p-3">
                            @foreach($lims_category_list as $category)
                                <div class="col-md-3 category-img" data-category="{{$category->id}}">
                                    <div class="card shadow" style="overflow: hidden">
                                        @if($category->image)
                                        <img src="{{url('public/images/category', $category->image)}}" class="card-img-top"/>
                                        @else
                                            <img  src="{{url('public/images/product/zummXD2dvAtI.png')}}" class="card-img-top"/>
                                        @endif
                                        <div class="card-body p-2 text-center">
                                            <h5 class="card-title m-0">{{$category->name}}</h5> 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="subcategory">
                        <div class="row m-0 ml-2 mr-2 px-2 p-3">
                            <div class="col-7 h3">Choose Subcategory</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row m-0 ml-2 p-3" id="_subcategories_">
                            
                        </div>
                    </div>
                    <div class="brand">
                        <div class="row m-0 ml-2 mr-2 px-2 p-3">
                            <div class="col-7 h3">Choose brand</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row m-0 ml-2 mt-3 p-3">
                            @foreach($lims_brand_list as $brand)
                                <div class="col-md-3 brand-img" data-brand="{{$brand->id}}">
                                    <div class="card shadow" style="overflow: hidden">
                                        @if($brand->image)
                                            <img src="{{url('public/images/brand', $brand->image)}}" class="card-img-top"/>
                                        @else
                                            <img  src="{{url('public/images/product/zummXD2dvAtI.png')}}" class="card-img-top"/>
                                        @endif
                                        <div class="card-body p-2 text-center">
                                            <h5 class="card-title m-0">{{$brand->title}}</h5> 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="p-0 m-0 table-container" >
                    <table id="product-table" class="change_grid table no-shadow product-list m-0 border-0" style="margin: 0 !important; border:none !important">
                        <thead class="d-none">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i=0; $i < ceil($product_number/5); $i++)
                                <tr>
                                    <td class="product-img sound-btn" title="{{$lims_product_list[0+$i*5]->name}}" data-product ="{{$lims_product_list[0+$i*5]->code . ' (' . $lims_product_list[0+$i*5]->name . ')'}}">
                                        <img  src="{{url('public/images/product',$lims_product_list[0+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[0+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[0+$i*5]->code}}</span>
                                    </td>
                                    @if(!empty($lims_product_list[1+$i*5]))
                                        <td class="product-img sound-btn" title="{{$lims_product_list[1+$i*5]->name}}" data-product ="{{$lims_product_list[1+$i*5]->code . ' (' . $lims_product_list[1+$i*5]->name . ')'}}">
                                            <img  src="{{url('public/images/product',$lims_product_list[1+$i*5]->base_image)}}" width="100%" />
                                            <p>{{$lims_product_list[1+$i*5]->name}}</p>
                                            <span>{{$lims_product_list[1+$i*5]->code}}</span>
                                        </td>
                                        @else
                                        <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[2+$i*5]))
                                        <td class="product-img sound-btn" title="{{$lims_product_list[2+$i*5]->name}}" data-product ="{{$lims_product_list[2+$i*5]->code . ' (' . $lims_product_list[2+$i*5]->name . ')'}}">
                                            <img  src="{{url('public/images/product',$lims_product_list[2+$i*5]->base_image)}}" width="100%" />
                                            <p>{{$lims_product_list[2+$i*5]->name}}</p>
                                            <span>{{$lims_product_list[2+$i*5]->code}}</span>
                                        </td>
                                        @else
                                        <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[3+$i*5]))
                                        <td class="product-img sound-btn" title="{{$lims_product_list[3+$i*5]->name}}" data-product ="{{$lims_product_list[3+$i*5]->code . ' (' . $lims_product_list[3+$i*5]->name . ')'}}">
                                            <img  src="{{url('public/images/product',$lims_product_list[3+$i*5]->base_image)}}" width="100%" />
                                            <p>{{$lims_product_list[3+$i*5]->name}}</p>
                                            <span>{{$lims_product_list[3+$i*5]->code}}</span>
                                        </td>
                                    @else
                                        <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[4+$i*5]))
                                        <td class="product-img sound-btn" title="{{$lims_product_list[4+$i*5]->name}}" data-product ="{{$lims_product_list[4+$i*5]->code . ' (' . $lims_product_list[4+$i*5]->name . ')'}}">
                                            <img  src="{{url('public/images/product',$lims_product_list[4+$i*5]->base_image)}}" width="100%" />
                                            <p>{{$lims_product_list[4+$i*5]->name}}</p>
                                            <span>{{$lims_product_list[4+$i*5]->code}}</span>
                                        </td>
                                        @else
                                        <td style="border:none;"></td>
                                    @endif
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Payment </h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col">
                            <div class="row m-0">
                                <div class="col-md-6 mt-1">
                                    <label>{{trans('file.Recieved Amount')}} *</label>
                                    <input type="text" name="paying_amount" class="form-control numkey" required step="any">
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label>{{trans('file.Paying Amount')}} *</label>
                                    <input type="text" name="paid_amount" class="form-control numkey"  step="any">
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label>{{trans('file.Change')}} : </label>
                                    <div id="change" class="form-control fw-bold">0.00</div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <input type="hidden" name="paid_by_id">
                                    <label>{{trans('file.Paid By')}}</label>
                                    <select name="paid_by_id_select" class="form-control selectpicker">
                                    
                                        <option value="5">UPI</option>
                                     
                                        <option value="1">Cash</option>
                                         
                                        <option value="3">Credit Card</option>
                                     
                                      
                                       
                                    </select>
                                </div>
                                {{-- <div class="form-group col-md-12 mt-3">
                                    <div class="card-element form-control">
                                    </div>
                                    <div class="card-errors" role="alert"></div>
                                </div> --}}
                                <div class="form-group col-md-12 gift-card">
                                    <label> {{trans('file.Gift Card')}} *</label>
                                    <input type="hidden" name="gift_card_id">
                                    <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                                </div>
                                
                                 
                               
                                <div class="form-group col-md-12 cheque">
                                    <label>{{trans('file.Cheque Number')}} *</label>
                                    <input type="text" name="cheque_no" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>{{trans('file.Payment Note')}}</label>
                                    <textarea id="payment_note" rows="2" class="form-control" name="payment_note"></textarea>
                                </div>
                            </div>

                            <div class="row m-0">
                               <div class="col-md-6 form-group">
                                    <label>{{trans('file.Sale Note')}}</label>
                                    <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{trans('file.Staff Note')}}</label>
                                    <textarea rows="3" class="form-control" name="staff_note"></textarea>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button id="submit-btn" type="button" class="btn btn-primary">{{trans('file.submit')}}</button>
                            </div>
                        </div>
                        <div class="col-md-2 qc" data-initial="1">
                            <h4><strong>{{trans('file.Quick Cash')}}</strong></h4>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10" type="button">10</button>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20" type="button">20</button>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50" type="button">50</button>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100" type="button">100</button>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="500" type="button">500</button>
                            <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000" type="button">1000</button>
                            <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0" type="button">{{trans('file.Clear')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    
    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row m-0 modal-element">
                            <div class="col-md-12 form-group">
                                <label>{{trans('file.Unit Price')}}</label>
                                <input type="text" name="edit_unit_price" class="form-control numkey" step="any">
                            <?php
                                $tax_name_all[] = 'No Tax';
                                $tax_rate_all[] = 0;
                                foreach($lims_tax_list as $tax) {
                                    $tax_name_all[] = $tax->name;
                                    $tax_rate_all[] = $tax->rate;
                                }
                            ?>
                            <div class="col-md-12 mt-2 form-group p-0">
                                <label>{{trans('file.Tax Rate')}}</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    @foreach($tax_name_all as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="edit_unit" class="col-md-4 form-group">
                                <label>{{trans('file.Product Unit')}}</label>
                                <select name="edit_unit" class="form-control selectpicker">
                                </select>
                            </div>
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- recent transaction modal -->
    <div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Recent Transaction')}} <div class="badge badge-primary">{{trans('file.latest')}} 10</div></h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">{{trans('file.Draft')}}</a>
                  </li>
                </ul>
                <div class="tab-content p-3">
                  <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.customer')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                              <th>{{trans('file.action')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                            @foreach($recent_sale as $sale)
                            <?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                            <tr>
                              <td>{{date('d-m-Y', strtotime($sale->created_at))}}</td>
                              <td>{{$sale->reference_no}}</td>
                              <td>{{$customer->name}}</td>
                              <td>{{$sale->grand_total}}</td>
                              <td>
                                <div class="btn-group">
                                    @if(in_array("sales-edit", $all_permission))
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                    @endif
                                    @if(in_array("sales-delete", $all_permission))
                                    {{ Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE'] ) }}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                    {{ Form::close() }}
                                    @endif
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.customer')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                              <th>{{trans('file.action')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_draft as $draft)
                            <?php $customer = DB::table('customers')->find($draft->customer_id); ?>
                            <tr>
                              <td>{{date('d-m-Y', strtotime($draft->created_at))}}</td>
                              <td>{{$draft->reference_no}}</td>
                              <td>{{$customer->name}}</td>
                              <td>{{$draft->grand_total}}</td>
                              <td>
                                <div class="btn-group">
                                    @if(in_array("sales-edit", $all_permission))
                                    <a href="{{url('sales/'.$draft->id.'/create') }}" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                    @endif
                                    @if(in_array("sales-delete", $all_permission))
                                    {{ Form::open(['route' => ['sales.destroy', $draft->id], 'method' => 'DELETE'] ) }}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                    {{ Form::close() }}
                                    @endif
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
   
    <!-- cash register details modal -->
    <div id="register-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Cash Register Details')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p>{{trans('file.Please review the transaction and payments.')}}</p>
                <div class="row m-0">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                  <td>{{trans('file.Cash in Hand')}}:</td>
                                  <td id="cash_in_hand" class="text-right">0</td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Sale Amount')}}:</td>
                                  <td id="total_sale_amount" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Payment')}}:</td>
                                  <td id="total_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Cash Payment')}}:</td>
                                  <td id="cash_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Credit Card Payment')}}:</td>
                                  <td id="credit_card_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Cheque Payment')}}:</td>
                                  <td id="cheque_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Gift Card Payment')}}:</td>
                                  <td id="gift_card_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Deposit Payment')}}:</td>
                                  <td id="deposit_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Paypal Payment')}}:</td>
                                  <td id="paypal_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Sale Return')}}:</td>
                                  <td id="total_sale_return" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Expense')}}:</td>
                                  <td id="total_expense" class="text-right"></td>
                                </tr>
                                <tr>
                                  <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                  <td id="total_cash" class="text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" id="closing-section">
                      <form action="{{route('cashRegister.close')}}" method="POST">
                          @csrf
                          <input type="hidden" name="cash_register_id">
                          <button type="submit" class="btn btn-primary">{{trans('file.Close Register')}}</button>
                      </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <!-- today sale modal -->
    <div id="today-sale-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Sale')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p>{{trans('file.Please review the transaction and payments.')}}</p>
                <div class="row m-0">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                  <td>{{trans('file.Total Sale Amount')}}:</td>
                                  <td class="total_sale_amount text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Cash Payment')}}:</td>
                                  <td class="cash_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Credit Card Payment')}}:</td>
                                  <td class="credit_card_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Cheque Payment')}}:</td>
                                  <td class="cheque_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Gift Card Payment')}}:</td>
                                  <td class="gift_card_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Deposit Payment')}}:</td>
                                  <td class="deposit_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Paypal Payment')}}:</td>
                                  <td class="paypal_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Payment')}}:</td>
                                  <td class="total_payment text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Sale Return')}}:</td>
                                  <td class="total_sale_return text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Total Expense')}}:</td>
                                  <td class="total_expense text-right"></td>
                                </tr>
                                <tr>
                                  <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                  <td class="total_cash text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <!-- today profit modal -->
    <div id="today-profit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Profit')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row m-0">
                    <div class="col-md-6">
                        <select required name="warehouseId" class="form-control">
                            <option value="0">{{trans('file.All Outlet')}}</option>
                            @foreach($lims_warehouse_list as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                  <td>{{trans('file.Product Revenue')}}:</td>
                                  <td class="product_revenue text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Product Cost')}}:</td>
                                  <td class="product_cost text-right"></td>
                                </tr>
                                <tr>
                                  <td>{{trans('file.Expense')}}:</td>
                                  <td class="expense_amount text-right"></td>
                                </tr>
                                <tr>
                                  <td><strong>{{trans('file.Profit')}}:</strong></td>
                                  <td class="profit text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    
    
    
    
</section>


@endsection
 
@push('scripts')
    <script>
        $(document).ready(function() {
        $('#customer_id').val('');
        $('#order-discount').val('');
        $('#featured-filter').trigger('click');
        });
        function change_grid() {
            $("#product-table").toggleClass("change_grid"); 

            var el  = document.getElementById('grid_icon');
             
            if (el.className === 'fa fa-list'){
                el.className = 'fa fa-th';
            } else {
                el.className = 'fa fa-list';
            }
        }
        $(document).ready(function () {
            $(".hide_image").hide();

            $("#hide_btn").attr('disabled', true);
            
            $("#hide_btn").click(function () {
                $(".hide_image").hide();
                $("#hide_btn").attr('disabled', true);
                $("#show_btn").attr('disabled', false);
            });

            $("#show_btn").click(function () {
                $(".hide_image").show();
                $("#hide_btn").attr('disabled', false);
                $("#show_btn").attr('disabled', true);
            });
        });
    </script>

<script type="text/javascript">
function logoutFun()
{
    $.ajax({
          url: 'holdbill-clear',
          type: "GET",
          success:function(data) {
            localStorage.clear();
                event.preventDefault();document.getElementById('logout-form').submit();
          }
        
        });
        // return false;
}
<?php $id =Auth::user()->role_id ?>
    var auth_id = {{$id}};
    // if(auth_id != 1)
    // {
    
    //     $('.outletStore').prop('disabled',true);
    //     $('#warehouse_dev').hide();
    //     $("#biller_dev").hide();
        
    // }
    // else if(auth_id == 1)
    // {
    //     $('.outletStore').prop('disabled',false);
    // }
    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-pos-menu").addClass("active");

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var alert_product = <?php echo json_encode($alert_product) ?>;
    var currency = <?php echo json_encode($currency) ?>;
    var valid;

// array data depend on warehouse
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];
var product_type = [];
var product_id = [];
var product_list = [];
var qty_list = [];

// array data with selection
var product_price = [];
var product_discount = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];
var is_imei = [];
var gift_card_amount = [];
var gift_card_expense = [];

// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var deposit = <?php echo json_encode($deposit) ?>;
var points = <?php echo json_encode($points) ?>;
var reward_point_setting = <?php echo json_encode($lims_reward_point_setting_data) ?>;

var product_row_number = <?php echo json_encode($lims_pos_setting_data->product_number) ?>;
var rowindex;
var customer_group_rate;
var row_product_price;
var pos;
var keyboard_active = <?php echo json_encode($keybord_active); ?>;
var role_id = <?php echo json_encode(\Auth::user()->role_id) ?>;
var warehouse_id = <?php echo json_encode(\Auth::user()->warehouse_id) ?>;
var biller_id = <?php echo json_encode(\Auth::user()->biller_id) ?>;
var coupon_list = <?php echo json_encode($lims_coupon_list) ?>;
var currency = <?php echo json_encode($currency) ?>;

var localStorageQty = [];
var localStorageProductId = [];
var localStorageProductDiscount = [];
var localStorageTaxRate = [];
var localStorageNetUnitPrice = [];
var localStorageTaxValue = [];
var localStorageTaxName = [];
var localStorageTaxMethod = [];
var localStorageSubTotalUnit = [];
var localStorageSubTotal = [];
var localStorageProductCode = [];
var localStorageSaleUnit = [];
var localStorageTempUnitName = [];
var localStorageSaleUnitOperator = [];
var localStorageSaleUnitOperationValue = [];

$("#reference-no").val(getSavedValue("reference-no"));
$("#order-discount").val(getSavedValue("order-discount"));
$("#order-tax-rate-select").val(getSavedValue("order-tax-rate-select"));


$("#shipping-cost-val").val(getSavedValue("shipping-cost-val"));

if(localStorage.getItem("tbody-id")) {
  $("#tbody-id").html(localStorage.getItem("tbody-id"));
}

function saveValue(e) {
    var id = e.id;  // get the sender's id to save it.
    var val = e.value; // get the value.
    localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override.
}
//get the saved value function - return the value of "v" from localStorage.
function getSavedValue  (v) {
    if (!localStorage.getItem(v)) {
        return "";// You can change this to your defualt value.
    }
    return localStorage.getItem(v);
}

if(getSavedValue("localStorageQty")) {
  localStorageQty = getSavedValue("localStorageQty").split(",");
  localStorageProductDiscount = getSavedValue("localStorageProductDiscount").split(",");
  localStorageTaxRate = getSavedValue("localStorageTaxRate").split(",");
  localStorageNetUnitPrice = getSavedValue("localStorageNetUnitPrice").split(",");
  localStorageTaxValue = getSavedValue("localStorageTaxValue").split(",");
  localStorageTaxName = getSavedValue("localStorageTaxName").split(",");
  localStorageTaxMethod = getSavedValue("localStorageTaxMethod").split(",");
  localStorageSubTotalUnit = getSavedValue("localStorageSubTotalUnit").split(",");
  localStorageSubTotal = getSavedValue("localStorageSubTotal").split(",");
  localStorageProductId = getSavedValue("localStorageProductId").split(",");
  localStorageProductCode = getSavedValue("localStorageProductCode").split(",");
  localStorageSaleUnit = getSavedValue("localStorageSaleUnit").split(",");
  localStorageTempUnitName = getSavedValue("localStorageTempUnitName").split(",,");
  localStorageSaleUnitOperator = getSavedValue("localStorageSaleUnitOperator").split(",,");
  localStorageSaleUnitOperationValue = getSavedValue("localStorageSaleUnitOperationValue").split(",,");
  /*localStorageQty.pop();
  localStorage.setItem("localStorageQty", localStorageQty);*/
  for(var i = 0; i < localStorageQty.length; i++) {
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ') .qty').val(localStorageQty[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.discount-value').val(localStorageProductDiscount[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val(localStorageTaxRate[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.net_unit_price').val(localStorageNetUnitPrice[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-value').val(localStorageTaxValue[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val(localStorageTaxName[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val(localStorageTaxMethod[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-price').text(localStorageSubTotalUnit[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sub-total').text(localStorageSubTotal[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.subtotal-value').val(localStorageSubTotal[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-id').val(localStorageProductId[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-code').val(localStorageProductCode[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(localStorageSaleUnit[i]);
    if(i==0) {
      localStorageTempUnitName[i] += ',';
      localStorageSaleUnitOperator[i] += ',';
      localStorageSaleUnitOperationValue[i] += ',';
    }
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val(localStorageSaleUnitOperator[i]);
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val(localStorageSaleUnitOperationValue[i]);

    product_price.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product_price').val()));
    var quantity = parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
    product_discount.push(parseFloat(localStorageProductDiscount[i] / localStorageQty[i]).toFixed(2));
    tax_rate.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val()));
    tax_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val());
    tax_method.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val());
    temp_unit_name = $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val();
    unit_name.push(localStorageTempUnitName[i]);
    unit_operator.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val());
    unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val());
    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(temp_unit_name);
    calculateTotal();
    //calculateRowProductData(localStorageQty[i]);
  }
}


$('.selectpicker').selectpicker({
  style: 'btn-link',
});

if(keyboard_active==1){

    $("input.numkey:text").keyboard({
        usePreview: false,
        layout: 'custom',
        display: {
        'accept'  : '&#10004;',
        'cancel'  : '&#10006;'
        },
        customLayout : {
          'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']
        },
        restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
        preventPaste : true,  // prevent ctrl-v and right click
        autoAccept : true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active'
        },
    });

    $('input[type="text"]').keyboard({
        usePreview: false,
        autoAccept: true,
        autoAcceptOnEsc: true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active',
            // used when disabling the decimal button {dec}
            // when a decimal exists in the input area
            buttonDisabled: 'disabled'
        },
        change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')
              }
    });

    $('textarea').keyboard({
        usePreview: false,
        autoAccept: true,
        autoAcceptOnEsc: true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active',
            // used when disabling the decimal button {dec}
            // when a decimal exists in the input area
            buttonDisabled: 'disabled'
        },
        change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')
              }
    });

    $('#lims_productcodeSearch').keyboard().autocomplete().addAutocomplete({
        // add autocomplete window positioning
        // options here (using position utility)
        position: {
          of: '#lims_productcodeSearch',
          my: 'top+18px',
          at: 'center',
          collision: 'flip'
        }
    });
}

  $("li#notification-icon").on("click", function (argument) {
      $.get('notifications/mark-as-read', function(data) {
          $("span.notification-number").text(alert_product);
      });
  });

  $("#register-details-btn").on("click", function (e) {
      e.preventDefault();
      $.ajax({
          url: 'cash-register/showDetails/'+warehouse_id,
          type: "GET",
          success:function(data) {
              $('#register-details-modal #cash_in_hand').text(data['cash_in_hand']);
              $('#register-details-modal #total_sale_amount').text(data['total_sale_amount']);
              $('#register-details-modal #total_payment').text(data['total_payment']);
              $('#register-details-modal #cash_payment').text(data['cash_payment']);
              $('#register-details-modal #credit_card_payment').text(data['credit_card_payment']);
              $('#register-details-modal #cheque_payment').text(data['cheque_payment']);
              $('#register-details-modal #gift_card_payment').text(data['gift_card_payment']);
              $('#register-details-modal #deposit_payment').text(data['deposit_payment']);
              $('#register-details-modal #paypal_payment').text(data['paypal_payment']);
              $('#register-details-modal #total_sale_return').text(data['total_sale_return']);
              $('#register-details-modal #total_expense').text(data['total_expense']);
              $('#register-details-modal #total_cash').text(data['total_cash']);
              $('#register-details-modal input[name=cash_register_id]').val(data['id']);
          }
      });
      $('#register-details-modal').modal('show');
  });

  $("#today-sale-btn").on("click", function (e) {
      e.preventDefault();
      $.ajax({
          url: 'sales/today-sale/',
          type: "GET",
          success:function(data) {
              $('#today-sale-modal .total_sale_amount').text(data['total_sale_amount']);
              $('#today-sale-modal .total_payment').text(data['total_payment']);
              $('#today-sale-modal .cash_payment').text(data['cash_payment']);
              $('#today-sale-modal .credit_card_payment').text(data['credit_card_payment']);
              $('#today-sale-modal .cheque_payment').text(data['cheque_payment']);
              $('#today-sale-modal .gift_card_payment').text(data['gift_card_payment']);
              $('#today-sale-modal .deposit_payment').text(data['deposit_payment']);
              $('#today-sale-modal .paypal_payment').text(data['paypal_payment']);
              $('#today-sale-modal .total_sale_return').text(data['total_sale_return']);
              $('#today-sale-modal .total_expense').text(data['total_expense']);
              $('#today-sale-modal .total_cash').text(data['total_cash']);
          }
      });
      $('#today-sale-modal').modal('show');
  });

  $("#today-profit-btn").on("click", function (e) {
      e.preventDefault();
      calculateTodayProfit(0);
  });

  $("#today-profit-modal select[name=warehouseId]").on("change", function() {
      calculateTodayProfit($(this).val());
  });

  function calculateTodayProfit(warehouse_id) {
      $.ajax({
            url: 'sales/today-profit/' + warehouse_id,
            type: "GET",
            success:function(data) {
                $('#today-profit-modal .product_revenue').text(data['product_revenue']);
                $('#today-profit-modal .product_cost').text(data['product_cost']);
                $('#today-profit-modal .expense_amount').text(data['expense_amount']);
                $('#today-profit-modal .profit').text(data['profit']);
            }
        });
      $('#today-profit-modal').modal('show');
  }

if(role_id > 2){
    // $('#biller_id').addClass('d-none');
    // $('#warehouse_id').addClass('d-none');
    $('select[name=warehouse_id]').val(warehouse_id);
    $('select[name=biller_id]').val(biller_id);
    isCashRegisterAvailable(warehouse_id);
}
else {
    if(getSavedValue("warehouse_id")){
      warehouse_id = getSavedValue("warehouse_id");
    }
    else {
      warehouse_id = $("input[name='warehouse_id_hidden']").val();
    }

    if(getSavedValue("customer_id")){
        customer_id = getSavedValue("customer_id");
    }
    else {
        customer_id = $("input[name='customer_id_hidden']").val();
    }
    if(getSavedValue("biller_id")){   
      biller_id = getSavedValue("biller_id");
    }
    else {  
      biller_id = $("input[name='biller_id_hidden']").val();
    } 
    $('select[name=warehouse_id]').val(warehouse_id);
    $('select[name=biller_id]').val(biller_id);
    $('select[name=customer_id]').val(customer_id);
}
    biller_id = $("input[name='biller_id_hidden']").val();
    $('select[name=biller_id]').val(biller_id);
//   if(getSavedValue("biller_id")) {
//     $('select[name=customer_id]').val(getSavedValue("customer_id"));
//   }
//   else {
//     $('select[name=customer_id]').val($("input[name='customer_id_hidden']").val());
    
//   }

$('.selectpicker').selectpicker('refresh');

var id = $("#customer_id").val();
$.get('sales/getcustomergroup/' + id, function(data) {
    customer_group_rate = (data / 100);
});

var id = $("#warehouse_id").val();
$.get('sales/getproduct/' + id, function(data) {
    lims_product_array = [];
    product_code = data[0];
    product_name = data[1];
    product_qty = data[2];
    product_type = data[3];
    product_id = data[4];
    product_list = data[5];
    qty_list = data[6];
    product_warehouse_price = data[7];
    batch_no = data[8];
    product_batch_id = data[9];
    $.each(product_code, function(index) {
        lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
    });
});

isCashRegisterAvailable(id);

function isCashRegisterAvailable(warehouse_id) {
    $.ajax({
        url: 'cash-register/check-availability/'+warehouse_id,
        type: "GET",
        success:function(data) {
            if(data == 'false') {
              $("#register-details-btn").addClass('d-none');
              $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);

              if(role_id <= 2)
                $("#cash-register-modal .warehouse-section").removeClass('d-none');
              else
                $("#cash-register-modal .warehouse-section").addClass('d-none');

              $('.selectpicker').selectpicker('refresh');
              $("#cash-register-modal").modal('show');
            }
            else
              $("#register-details-btn").removeClass('d-none');
        }
    });
}

if(keyboard_active==1){
    $('#lims_productcodeSearch').bind('keyboardChange', function (e, keyboard, el) {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('select[name="warehouse_id"]').val();
        temp_data = $('#lims_productcodeSearch').val();
        if(!customer_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
          
            Alert('warning', 'Please select Customer!')
        }
        else if(!warehouse_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            Alert('warning','Please select Outlet!');
        }
    });
}
else{
    $('#lims_productcodeSearch').on('input', function(){
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('#warehouse_id').val();
        temp_data = $('#lims_productcodeSearch').val();
        if(!customer_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            Alert( 'warning','Please select Customer!');
        }
        else if(!warehouse_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            Alert( 'warning','Please select Outlet!');
        }

    });
}

$("#print-btn").on("click", function(){
      var divToPrint=document.getElementById('sale-details');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},10);
});

$('body').on('click', function(e){
    $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
});

$('#category-filter').on('click', function(e){
    e.stopPropagation();
    $('.filter-window').show('slide', {direction: 'right'}, 'fast');
    $('.category').show();
    $('.brand').hide();
    $('.subcategory').hide();
});

$('.category-img').on('click', function(e){
    e.stopPropagation();
    var category_id = $(this).data('category');
    
    $('.filter-window').show('slide', {direction: 'left'}, 'fast');
    $.get("{{route('sales/check-subcategory')}}",{parent_id:category_id},function(data) {
        //    alert(data)
        if(data)
        {
            $.get("{{route('sales/get-subcategory')}}",{parent_id:category_id},function(data) {
                $("#_subcategories_").html(data);
            
            });
                $('.subcategory').show();
                $('.category').hide();
                $('.brand').hide();
        }
        else{
            
            var brand_id = 0;
            $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
                populateProduct(data);
                $('.filter-window').hide();
            });
        }

    });
});

$(document).on('click',".subcategory-img", function(e){
    var category_id = $(this).data('category');
    var brand_id = 0;
    $(".table-container").children().remove();
    $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
        populateProduct(data);
    });
});

$('#brand-filter').on('click', function(e){
    e.stopPropagation();
    $('.filter-window').show('slide', {direction: 'right'}, 'fast');
    $('.brand').show();
    $('.category').hide();
    $('.subcategory').hide();
});

$('.brand-img').on('click', function(){
    var brand_id = $(this).data('brand');
    var category_id = 0;

    $(".table-container").children().remove();
    $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
        populateProduct(data);
    });
});

$('#featured-filter').on('click', function(){
    $(".table-container").children().remove();
    $.get('sales/getfeatured', function(data) {
        populateProduct(data);
    });
});
$('#top-sale-filter').on('click', function(){
    $(".table-container").children().remove();
    $.get('sales/get-top-sale', function(data) {
        populateProduct(data);
    });
});


function populateProduct(data) {
    var tableData = '<table id="product-table" class="change_grid table no-shadow product-list"> <thead class="d-none"> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> </tr></thead> <tbody><tr>';

    if (Object.keys(data).length != 0) {
        $.each(data['name'], function(index) {
            var product_info = data['code'][index]+' (' + data['name'][index] + ')';
            if(index % 5 == 0 && index != 0)
                tableData += '</tr><tr><td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img class="hide_image" src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
            else
                tableData += '<td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img class="hide_image" src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
        });

        if(data['name'].length % 5){
            var number = 5 - (data['name'].length % 5);
            while(number > 0)
            {
                tableData += '<td style="border:none;"></td>';
                number--;
            }
        }

        tableData += '</tr></tbody></table>';
        console.log(tableData)
        $(".table-container").html(tableData);
        $('#product-table').DataTable( {
          "order": [],
          'pageLength': product_row_number,
           'language': {
              'paginate': {
                  'previous': '<i class="fa fa-angle-left"></i>',
                  'next': '<i class="fa fa-angle-right"></i>'
              }
          },
          dom: 'tp'
        });
        $('table.product-list').hide();
        $('table.product-list').show(500);
    }
    else{
        tableData += '<td class="text-center">No data available</td></tr></tbody></table>'
        $(".table-container").html(tableData);
    }
}

$('select[name="customer_id"]').on('change', function() {
    saveValue(this);
    var id = $(this).val();
    $("#customer_id_hidden").val(id);
    $.get('sales/getcustomergroup/' + id, function(data) {
        // alert(data/100)
        customer_group_rate = (data / 100);
    });
});

$('select[name="biller_id"]').on('change', function() {
    saveValue(this);
});

$('select[name="warehouse_id"]').on('change', function() {
    saveValue(this);
    warehouse_id = $(this).val();
    $.get('sales/getproduct/' + warehouse_id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        product_type = data[3];
        product_id = data[4];
        product_list = data[5];
        qty_list = data[6];
        product_warehouse_price = data[7];
        batch_no = data[8];
        product_batch_id = data[9];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });

    isCashRegisterAvailable(warehouse_id);
});

var lims_productcodeSearch = $('#lims_productcodeSearch');

lims_productcodeSearch.autocomplete({
    source: function(request, response) {
        var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(lims_product_array, function(item) {
            return matcher.test(item);
        }));
    },
    response: function(event, ui) {
        if (ui.content.length == 1) {
            var data = ui.content[0].value;
            $(this).autocomplete( "close" );
            productSearch(data);
        };
    },
    select: function(event, ui) {
        var data = ui.item.value;
        productSearch(data);
    },
});

$('#myTable').keyboard({
        accepted : function(event, keyboard, el) {
            checkQuantity(el.value, true);
      }
    });

$("#myTable").on('click', '.plus', function() {
    rowindex = $(this).closest('tr').index();
    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
    var actualQty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text();
    if(parseFloat(qty) >= parseFloat(actualQty)){
        Alert('warning', `Product out of stock`);
        return false;
    }
    if(!qty)
      qty = 1;
    else
      qty = parseFloat(qty) + 1;

    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
    checkQuantity(String(qty), true);
    localStorage.setItem("tbody-id", $("table.order-list tbody").html());
});

$("#myTable").on('click', '.minus', function() {
    rowindex = $(this).closest('tr').index();
    var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
    if (qty > 0) {
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
    } else {
        qty = 1;
    }
    checkQuantity(String(qty), true);
});

$("#myTable").on("change", ".batch-no", function () {
    rowindex = $(this).closest('tr').index();
    var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-id').val();
    var warehouse_id = $('#warehouse_id').val();
    $.get('check-batch-availability/' + product_id + '/' + $(this).val() + '/' + warehouse_id, function(data) {
        // console.log(data);
        if(data['message'] != 'ok') {
            Alert("warning" , data['message']);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.batch-no').val('');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val('');
        }
        else {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val(data['product_batch_id']);
            code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
            pos = product_code.indexOf(code);
            product_qty[pos] = data['qty'];
        }
    });
});

//Change quantity
$("#myTable").on('input', '.qty', function() {
    rowindex = $(this).closest('tr').index();
    if($(this).val() < 0 && $(this).val() != '') {
      $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
      Alert("warning", "Quantity can't be less than 0");
    }
    checkQuantity($(this).val(), true);
});

$("#myTable").on('click', '.qty', function() {
    rowindex = $(this).closest('tr').index();
});

$(document).on('click', '.sound-btn', function() {
    var audio = $("#mysoundclip1")[0];
    audio.play();
});
$('select[name="warehouse_id"]').change(function(){
    // console.log('called warehouse');
    // console.log($(this).val());

})
$(document).on('click', '.product-img', function() {
    var customer_id = $('#customer_id').val();
    var warehouse_id = $('select[name="warehouse_id"]').val();
    if(!customer_id)
        Alert('warning', 'Please select Customer!');
    else if(!warehouse_id)
        Alert('warning', 'Please select Outlet!');
    else{
        var data = $(this).data('product');
        data = data.split(" ");
        pos = product_code.indexOf(data[0]);
        if(pos < 0)
            Alert('warning', 'Product is not available in the selected outlet !');
        else{     
            productSearch(data[0]);
        }
    }
});
//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
    var audio = $("#mysoundclip2")[0];
    audio.play();
    rowindex = $(this).closest('tr').index();
    product_price.splice(rowindex, 1);
    product_discount.splice(rowindex, 1);
    tax_rate.splice(rowindex, 1);
    tax_name.splice(rowindex, 1);
    tax_method.splice(rowindex, 1);
    unit_name.splice(rowindex, 1);
    unit_operator.splice(rowindex, 1);
    unit_operation_value.splice(rowindex, 1);

    localStorageProductId.splice(rowindex, 1);
    localStorageQty.splice(rowindex, 1);
    localStorageSaleUnit.splice(rowindex, 1);
    localStorageProductDiscount.splice(rowindex, 1);
    localStorageTaxRate.splice(rowindex, 1);
    localStorageNetUnitPrice.splice(rowindex, 1);
    localStorageTaxValue.splice(rowindex, 1);
    localStorageSubTotalUnit.splice(rowindex, 1);
    localStorageSubTotal.splice(rowindex, 1);
    localStorageProductCode.splice(rowindex, 1);

    localStorageTaxName.splice(rowindex, 1);
    localStorageTaxMethod.splice(rowindex, 1);
    localStorageTempUnitName.splice(rowindex, 1);
    localStorageSaleUnitOperator.splice(rowindex, 1);
    localStorageSaleUnitOperationValue.splice(rowindex, 1);

    localStorage.setItem("localStorageProductId", localStorageProductId);
    localStorage.setItem("localStorageQty", localStorageQty);
    localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
    localStorage.setItem("localStorageProductCode", localStorageProductCode);
    localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
    localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
    localStorage.setItem("localStorageTaxName", localStorageTaxName);
    localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
    localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
    localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
    localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
    localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
    localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
    localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
    localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

    $(this).closest("tr").remove();
    localStorage.setItem("tbody-id", $("table.order-list tbody").html());
    calculateTotal();
});

//Edit product
$("table.order-list").on("click", ".edit-product", function() {
    rowindex = $(this).closest('tr').index();
    edit();
});

//Update product
$('button[name="update_btn"]').on("click", function() {
    if(is_imei[rowindex]) {
        var imeiNumbers = $("#editModal input[name=imei_numbers]").val();
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val(imeiNumbers);
    }

    var edit_discount = $('input[name="edit_discount"]').val();
    var edit_qty = $('input[name="edit_qty"]').val();
    var edit_unit_price = $('input[name="edit_unit_price"]').val();

    if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
        Alert('warning', 'Invalid Discount Input!');
        return;
    }

    if(edit_qty < 1) {
        $('input[name="edit_qty"]').val(1);
        edit_qty = 1;
        Alert('warning', "Quantity can't be less than 1");
    }

    var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;

    tax_rate[rowindex] = localStorageTaxRate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
    tax_name[rowindex] = localStorageTaxName[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();

    product_discount[rowindex] = $('input[name="edit_discount"]').val();
    if(product_type[pos] == 'standard'){
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
        if (row_unit_operator == '*') {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val() / row_unit_operation_value;
        } else {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val() * row_unit_operation_value;
        }
        var position = $('select[name="edit_unit"]').val();
        var temp_operator = temp_unit_operator[position];
        var temp_operation_value = temp_unit_operation_value[position];
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
        temp_unit_name.splice(position, 1);
        temp_unit_operator.splice(position, 1);
        temp_unit_operation_value.splice(position, 1);

        temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
        temp_unit_operator.unshift(temp_operator);
        temp_unit_operation_value.unshift(temp_operation_value);

        unit_name[rowindex] = localStorageTempUnitName[rowindex] = temp_unit_name.toString() + ',';
        unit_operator[rowindex] = localStorageSaleUnitOperator[rowindex] = temp_unit_operator.toString() + ',';
        unit_operation_value[rowindex] = localStorageSaleUnitOperationValue[rowindex] = temp_unit_operation_value.toString() + ',';

        localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
        localStorage.setItem("localStorageTaxName", localStorageTaxName);
        localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
        localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
        localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
    }
    else {
        product_price[rowindex] = $('input[name="edit_unit_price"]').val();
    }
    checkQuantity(edit_qty, false);
});

$('button[name="order_discount_btn"]').on("click", function() {
    calculateGrandTotal();
});

$('button[name="shipping_cost_btn"]').on("click", function() {
    calculateGrandTotal();
});

$('button[name="order_tax_btn"]').on("click", function() {
    calculateGrandTotal();
});

$(".coupon-check").on("click",function() {
    couponDiscount();
});

$(".payment-btn").on("click", function() {
    $('#change').text('0.00');
    var audio = $("#mysoundclip2")[0];
    audio.play();
    $('input[name="paid_amount"]').val($("#grand-total").text());
    $('input[name="paying_amount"]').val($("#grand-total").text());
    $('.qc').data('initial', 1);
});

$("#draft-btn").on("click",function(){
    var audio = $("#mysoundclip2")[0];
    audio.play();
    $('input[name="sale_status"]').val(3);
    $('input[name="paying_amount"]').prop('required',false);
    $('input[name="paid_amount"]').prop('required',false);
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        Alert('warning', "Please insert product to order table!")
    }
    else
        $('.payment-form').submit();
});

$("#submit-btn").on("click", function() {

     var holdbillNumber = $('#holdbillnum').val();
    if(holdbillNumber)
    {
        $.ajax({
                type: 'GET',
                url: 'hold_bill_delete/'+holdbillNumber,
                // data : {id:ids}
                success: function(data) {
                $('.payment-form').submit();
                }
            });
    }
    else{
        $('.payment-form').submit();
    }      
});

$("#gift-card-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(2);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    giftCard();
});

$("#credit-card-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(3);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    creditCard();
});

$("#cheque-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(4);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    cheque();
});

$("#cash-btn").on("click",function() {

    var wareId = $('#warehouse_id').val();
  
  $('#warehousePaymentId').val(wareId);


  $('select[name="paid_by_id_select"]').val(1).change();

  $('input[name="paid_by_id"]').val(1);
  $('.selectpicker').selectpicker('refresh');
  $('div.qc').show();
  hide();
});

$("#paypal-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(5);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    hide();
});

$("#deposit-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(6);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    hide();
    deposits();
});

$("#point-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(7);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    hide();
    pointCalculation();
});

$('select[name="paid_by_id_select"]').on("change", function() {
    var id = $(this).val();
    $(".payment-form").off("submit");
    if(id == 2) {
        $('div.qc').hide();
        giftCard();
    }
    else if (id == 3) {
        $('div.qc').hide();
        creditCard();
    } else if (id == 4) {
        $('div.qc').hide();
        cheque();
    } else {
        hide();
        if(id == 1)
            $('div.qc').show();
        else if(id == 6) {
            $('div.qc').hide();
            deposits();
        }
        else if(id == 7) {
            $('div.qc').hide();
            pointCalculation();
        }
    }
});

$('#add-payment select[name="gift_card_id_select"]').on("change", function() {
    var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
    $('#add-payment input[name="gift_card_id"]').val($(this).val());
    if($('input[name="paid_amount"]').val() > balance){
        Alert('warning', 'Amount exceeds card balance! Gift Card balance: '+ balance);
    }
});

$('#add-payment input[name="paying_amount"]').on("input", function() {
    change($(this).val(), $('input[name="paid_amount"]').val());
});

$('input[name="paid_amount"]').on("input", function() {
    if( $(this).val() > parseFloat($('input[name="paying_amount"]').val()) ) {
        Alert('warning', 'Paying amount cannot be bigger than recieved amount');
        $(this).val('');
    }
    else if( $(this).val() > parseFloat($('#grand-total').text()) ){
        Alert('warning', 'Paying amount cannot be bigger than grand total');
        $(this).val('');
    }

    change( $('input[name="paying_amount"]').val(), $(this).val() );
    var id = $('select[name="paid_by_id_select"]').val();
    if(id == 2){
        var balance = gift_card_amount[$("#gift_card_id_select").val()] - gift_card_expense[$("#gift_card_id_select").val()];
        if($(this).val() > balance)
            Alert('warning', 'Amount exceeds card balance! Gift Card balance: '+ balance);
    }
    else if(id == 6){
        if( $('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()] )
            Alert('warning', 'Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
});

$('.transaction-btn-plus').on("click", function() {
    $(this).addClass('d-none');
    $('.transaction-btn-close').removeClass('d-none');
});

$('.transaction-btn-close').on("click", function() {
    $(this).addClass('d-none');
    $('.transaction-btn-plus').removeClass('d-none');
});

$('.coupon-btn-plus').on("click", function() {
    $(this).addClass('d-none');
    $('.coupon-btn-close').removeClass('d-none');
});

$('.coupon-btn-close').on("click", function() {
    $(this).addClass('d-none');
    $('.coupon-btn-plus').removeClass('d-none');
});

$(document).on('click', '.qc-btn', function(e) {
    if($(this).data('amount')) {
        if($('.qc').data('initial')) {
            $('input[name="paying_amount"]').val( $(this).data('amount').toFixed(2) );
            $('.qc').data('initial', 0);
        }
        else {
            $('input[name="paying_amount"]').val( (parseFloat($('input[name="paying_amount"]').val()) + $(this).data('amount')).toFixed(2) );
        }
    }
    else
        $('input[name="paying_amount"]').val('0.00');
    change( $('input[name="paying_amount"]').val(), $('input[name="paid_amount"]').val() );
});

function change(paying_amount, paid_amount) {
    $("#change").text( parseFloat(paying_amount - paid_amount).toFixed(2) );
}

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

function productSearch(data) {
    $.ajax({
        type: 'GET',
        url: 'sales/lims_product_search',
        data: {
            data: data
        },
        success: function(data) {
            var flag = 1;
            $(".product-code").each(function(i) {
                if ($(this).val() == data[1]) {
                    rowindex = i;
                    var pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
                    if(pre_qty)
                        var qty = parseFloat(pre_qty) + 1;
                    else
                        var qty = 1;
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                    flag = 0;
                    checkQuantity(String(qty), true);
                    flag = 0;
                    localStorage.setItem("tbody-id", $("table.order-list tbody").html());
                }
            });
            $("input[name='product_code_name']").val('');
            if(flag){
                addNewProduct(data);
            }
        }
    });
}

function addNewProduct(data){
    var newRow = $("<tr>");
    var cols = '';
    temp_unit_name = (data[6]).split(',');
    pos = product_code.indexOf(data[1]);
    cols += `
        <td style="text-align:left;padding:0 0 0 15px !important" class=" product-title">
            <button type="button" class="edit-product btn btn-sm text-success btn-link" data-toggle="modal" data-target="#editModal">
                <strong >${data[0]}</strong>
            </button> - ${data[1]} 
        </td>
    `;
    cols += `
        <td style="text-align:center;padding:0 !important">
            <small class="stock-count text-white"><b class="text-white fw-bold in-stock"></b></small>
        </td>
    `;
    if(data[12]) {
        cols += '<td style="display:none !important ;text-align:center;padding:0 !important"><input type="text" class="form-control form-control-sm batch-no" value="'+batch_no[pos]+'" required/> <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="'+product_batch_id[pos]+'"/> </td>';
    }
    else {
        cols += '<td style="display:none !important ;text-align:center;padding:0 !important"><input type="text" class="form-control form-control-sm batch-no" disabled/> <input type="hidden" class="product-batch-id" name="product_batch_id[]"/> </td>';
    }
    cols += '<td style="text-align:right;padding:0 !important" class="product-price fw-bold"></td>';
    cols += '<td style="text-align:right;padding:0 !important"><div class="btn-group"><span class="btn-group-btn"><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" step="any" required><span class="btn-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>';
    cols += '<td style="text-align:right;padding:0 !important" class="sub-total"></td>';
    cols += '<td style="text-align:center;padding:0 !important"> <i class="dripicons-cross ibtnDel text-danger btn"></i> </td>';
    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
    cols += '<input type="hidden" class="product_price" />';
    cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
    cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
    cols += '<input type="hidden" class="discount-value" name="discount[]" />';
    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
    cols += '<input type="hidden" class="tax-value" name="tax[]" />';
    cols += '<input type="hidden" class="tax-name" value="'+data[4]+'" />';
    cols += '<input type="hidden" class="tax-method" value="'+data[5]+'" />';
    cols += '<input type="hidden" class="sale-unit-operator" value="'+data[7]+'" />';
    cols += '<input type="hidden" class="sale-unit-operation-value" value="'+data[8]+'" />';
    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';
    cols += '<input type="hidden" class="imei-number" name="imei_number[]" />';
   
    newRow.append(cols);
    if(keyboard_active==1) {
        $("table.order-list tbody").prepend(newRow).find('.qty').keyboard({usePreview: false, layout: 'custom', display: { 'accept'  : '&#10004;', 'cancel'  : '&#10006;' }, customLayout : {
          'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']}, restrictInput : true, preventPaste : true, autoAccept : true, css: { container: 'center-block dropdown-menu', buttonDefault: 'btn btn-default', buttonHover: 'btn-primary',buttonAction: 'active', buttonDisabled: 'disabled'},});
    }
    else
        $("table.order-list tbody").prepend(newRow);

    rowindex = newRow.index();

    if(!data[11] && product_warehouse_price[pos]) {
       
        product_price.splice(rowindex, 0, parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
    }
    else {
        // alert(parseFloat(customer_group_rate)); //customer_group_rate is null so that product price is showing NaN value
        // alert(parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate));
        // alert("aaa");
        product_price.splice(rowindex, 0, parseFloat(data[2] * currency['exchange_rate']) + parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate));
    }
    product_discount.splice(rowindex, 0, '0.00');
    tax_rate.splice(rowindex, 0, parseFloat(data[3]));
    tax_name.splice(rowindex, 0, data[4]);
    tax_method.splice(rowindex, 0, data[5]);
    unit_name.splice(rowindex, 0, data[6]);
    unit_operator.splice(rowindex, 0, data[7]);
    unit_operation_value.splice(rowindex, 0, data[8]);
    is_imei.splice(rowindex, 0, data[13]);
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(1);
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product_price').val(product_price[rowindex]);
    localStorageQty.splice(rowindex, 0, 1);
    localStorageProductId.splice(rowindex, 0, data[9]);
    localStorageProductCode.splice(rowindex, 0, data[1]);
    localStorageSaleUnit.splice(rowindex, 0, temp_unit_name[0]);
    localStorageProductDiscount.splice(rowindex, 0, product_discount[rowindex]);
    localStorageTaxRate.splice(rowindex, 0, tax_rate[rowindex].toFixed(2));
    localStorageTaxName.splice(rowindex, 0, data[4]);
    localStorageTaxMethod.splice(rowindex, 0, data[5]);
    localStorageTempUnitName.splice(rowindex, 0, data[6]);
    localStorageSaleUnitOperator.splice(rowindex, 0, data[7]);
    localStorageSaleUnitOperationValue.splice(rowindex, 0, data[8]);
    //put some dummy value
    localStorageNetUnitPrice.splice(rowindex, 0, '0.00');
    localStorageTaxValue.splice(rowindex, 0, '0.00');
    localStorageSubTotalUnit.splice(rowindex, 0, '0.00');
    localStorageSubTotal.splice(rowindex, 0, '0.00');

    localStorage.setItem("localStorageProductId", localStorageProductId);
    localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
    localStorage.setItem("localStorageProductCode", localStorageProductCode);
    localStorage.setItem("localStorageTaxName", localStorageTaxName);
    localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
    localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
    localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
    localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue); 
    checkQuantity(1, true);
    localStorage.setItem("tbody-id", $("table.order-list tbody").html());
    if(data[13]) {
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.edit-product').click();
    }
}

function edit(){
    $(".imei-section").remove();
    if(is_imei[rowindex]) {
        var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();

        htmlText = '<div class="col-md-12 form-group imei-section"><label>IMEI or Serial Numbers</label><input type="text" name="imei_numbers" value="'+imeiNumbers+'" class="form-control imei_number" placeholder="Type imei or serial numbers and separate them by comma. Example:1001,2001" step="any"></div>';
        $("#editModal .modal-element").append(htmlText);
    }

    var row_product_name_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
    $('#modal_header').text(row_product_name_code);

    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
    $('input[name="edit_qty"]').val(qty);

    $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed(2));

    var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
    pos = tax_name_all.indexOf(tax_name[rowindex]);
    $('select[name="edit_tax_rate"]').val(pos);

    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
    pos = product_code.indexOf(row_product_code);
    if(product_type[pos] == 'standard'){
        unitConversion();
        temp_unit_name = (unit_name[rowindex]).split(',');
        temp_unit_name.pop();
        temp_unit_operator = (unit_operator[rowindex]).split(',');
        temp_unit_operator.pop();
        temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
        temp_unit_operation_value.pop();
        $('select[name="edit_unit"]').empty();
        $.each(temp_unit_name, function(key, value) {
            $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
        });
        $("#edit_unit").show();
    }
    else{
        row_product_price = product_price[rowindex];
        $("#edit_unit").hide();
    }
    $('input[name="edit_unit_price"]').val(row_product_price.toFixed(2));
    $('.selectpicker').selectpicker('refresh');
}

function couponDiscount() {
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        // Alert('warning', "Please insert product to order table!") //commended
    }
    else if($("#coupon-code").val() != ''){
        valid = 0;
        $.each(coupon_list, function(key, value) {
            if($("#coupon-code").val() == value['code']){
                valid = 1;
                todyDate = <?php echo json_encode(date('Y-m-d'))?>;
                if(parseFloat(value['quantity']) <= parseFloat(value['used']))
                    Alert('warning', 'This Coupon is no longer available');
                else if(todyDate > value['expired_date'])
                    Alert('warning', 'This Coupon has expired!');
                else if(value['type'] == 'fixed'){
                    if(parseFloat($('input[name="grand_total"]').val()) >= value['minimum_amount']) {
                        $('input[name="grand_total"]').val($('input[name="grand_total"]').val() - value['amount']);
                        $('#grand-total').text(parseFloat($('input[name="grand_total"]').val()).toFixed(2));
                        if(!$('input[name="coupon_active"]').val())
                            alert('Congratulation! You got '+value['amount']+' '+currency+' discount');
                        // $(".coupon-check").prop("disabled",true);
                        // $("#coupon-code").prop("disabled",true);
                        $('input[name="coupon_active"]').val(1);
                        $("#coupon-modal").modal('hide');
                        $('input[name="coupon_id"]').val(value['id']);
                        $('input[name="coupon_discount"]').val(value['amount']);
                        $('#coupon-text').text(parseFloat(value['amount']).toFixed(2));
                    }
                    else
                        Alert('warning', 'Grand Total is not sufficient for discount! Required '+value['minimum_amount']+' '+currency);
                }
                else{
                    var grand_total = $('input[name="grand_total"]').val();
                    var coupon_discount = grand_total * (value['amount'] / 100);
                    grand_total = grand_total - coupon_discount;
                    $('input[name="grand_total"]').val(grand_total);
                    $('#grand-total').text(parseFloat(grand_total).toFixed(2));
                    if(!$('input[name="coupon_active"]').val())
                    Alert('success','Congratulation! You got '+value['amount']+'% discount');
                    // $(".coupon-check").prop("disabled",true);
                    // $("#coupon-code").prop("disabled",true);
                    $('input[name="coupon_active"]').val(1);
                    $("#coupon-modal").modal('hide');
                    $('input[name="coupon_id"]').val(value['id']);
                    $('input[name="coupon_discount"]').val(coupon_discount);
                    $('#coupon-text').text(parseFloat(coupon_discount).toFixed(2));
                }
            }
        });
        if(!valid)
            Alert('warning', 'Invalid coupon code!');
    }
}

function checkQuantity(sale_qty, flag) {

    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
    pos = product_code.indexOf(row_product_code);
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text(product_qty[pos]);
    if(product_qty[pos] <= 0){
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.stock-count').addClass('badge badge-danger');
    } else {
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.stock-count').addClass('badge badge-success');
    }
    var actualQty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text();
    var currentQty = sale_qty -1;
    // console.log($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text());
    // console.log("product-price",$('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-price').text());
    if(parseFloat(currentQty) >= parseFloat(actualQty)){
        // $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(currentQty);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(actualQty);
        Alert('warning', `Product out of stock`);
        // console.log("actualQty",actualQty);
        // console.log("actualQty",actualQty);
        calculateRowProductData(actualQty);
        return false;
    }
    localStorageQty[rowindex] = sale_qty;
    localStorage.setItem("localStorageQty", localStorageQty);
    if(product_type[pos] == 'standard') {
        var operator = unit_operator[rowindex].split(',');
        var operation_value = unit_operation_value[rowindex].split(',');
        if(operator[0] == '*')
            total_qty = sale_qty * operation_value[0];
        else if(operator[0] == '/')
            total_qty = sale_qty / operation_value[0];
        if (total_qty > parseFloat(product_qty[pos])) {
            Alert( 'warning','Quantity exceeds stock quantity!');
            if (flag) {
                sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                localStorageQty[rowindex] = sale_qty;
                localStorage.setItem("localStorageQty", localStorageQty);
                checkQuantity(sale_qty, true);
            } else {
                localStorageQty[rowindex] = sale_qty;
                localStorage.setItem("localStorageQty", localStorageQty);
                edit();
                return;
            }
        }
    }
    else if(product_type[pos] == 'combo'){
        child_id = product_list[pos].split(',');
        child_qty = qty_list[pos].split(',');
        $(child_id).each(function(index) {
            var position = product_id.indexOf(parseInt(child_id[index]));
            if( parseFloat(sale_qty * child_qty[index]) > product_qty[position] ) {
                Alert( 'warning','Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                }
                else {
                    edit();
                    flag = true;
                    return false;
                }
            }
        });
    }

    if(!flag){
        $('#editModal').modal('hide');
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
    }
  
    calculateRowProductData(sale_qty);

}

function unitConversion() {
    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        row_product_price = product_price[rowindex] * row_unit_operation_value;
    } else {
        row_product_price = product_price[rowindex] / row_unit_operation_value;
    }  
}

function calculateRowProductData(quantity) {
    if(product_type[pos] == 'standard')
        unitConversion();
    else
        row_product_price = product_price[rowindex];

    if (tax_method[rowindex] == 1) {
        var net_unit_price = row_product_price - product_discount[rowindex];      
        var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
        var sub_total = (net_unit_price * quantity) + tax;

        if(parseFloat(quantity))
            var sub_total_unit = sub_total / quantity;
        else
            var sub_total_unit = sub_total;
    }
    else {
        var sub_total_unit = row_product_price - product_discount[rowindex];
        var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
        var tax = (sub_total_unit - net_unit_price) * quantity;
        var sub_total = sub_total_unit * quantity;
    }
   
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-price').text(sub_total_unit.toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sub-total').text(sub_total.toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));

    localStorageProductDiscount.splice(rowindex, 1, (product_discount[rowindex] * quantity).toFixed(2));
    localStorageTaxRate.splice(rowindex, 1, tax_rate[rowindex].toFixed(2));
    localStorageNetUnitPrice.splice(rowindex, 1, net_unit_price.toFixed(2));
    localStorageTaxValue.splice(rowindex, 1, tax.toFixed(2));
    localStorageSubTotalUnit.splice(rowindex, 1, sub_total_unit.toFixed(2));
    localStorageSubTotal.splice(rowindex, 1, sub_total.toFixed(2));
    localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
    localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
    localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
    localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
    localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
    localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

    calculateTotal();
}

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $("table.order-list tbody .qty").each(function(index) {
        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $('input[name="total_qty"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;
    $("table.order-list tbody .discount-value").each(function() {
        total_discount += parseFloat($(this).val());
    });

    $('input[name="total_discount"]').val(total_discount.toFixed(2));

    //Sum of tax
    var total_tax = 0;
    $(".tax-value").each(function() {
        total_tax += parseFloat($(this).val());
    });

    $('input[name="total_tax"]').val(total_tax.toFixed(2));

    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseFloat($(this).text());
    });
    $('input[name="total_price"]').val(total.toFixed(2));

    calculateGrandTotal();
}

function calculateGrandTotal() {
    var item = $('table.order-list tbody tr:last').index();
    var total_qty = parseFloat($('input[name="total_qty"]').val());
    var subtotal = parseFloat($('input[name="total_price"]').val());
    var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
    //Alert( 'warning',order_tax);
    localStorage.setItem("order-tax-rate-select", order_tax); //////////// commended this order tax
    var order_discount = parseFloat($('input[name="order_discount"]').val());
    var order_discount_method = ($('input[name="order_discount_method"]:checked').val());
    if (!order_discount)
        order_discount = 0.00;
    $("#discount").text(order_discount.toFixed(2));

    var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    // alert((subtotal + order_tax + shipping_cost))
    if(order_discount_method == 'discount')
    {
        var grand_total1 = (((subtotal + order_tax + shipping_cost) * order_discount)/100);
        var grand_total = (subtotal + order_tax + shipping_cost) - grand_total1;
        $("#order_total_discount").val(order_discount);
        // alert(grand_total);
    }
    else{
        var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
        $("#order_total_discount").val('');
    }
    $('input[name="grand_total"]').val(grand_total.toFixed(2));

    couponDiscount();
    var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
    if (!coupon_discount)
        coupon_discount = 0.00;
    grand_total -= coupon_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#tax').text(order_tax.toFixed(2));
    $('input[name="order_tax"]').val(order_tax.toFixed(2));
    $('#shipping-cost').text(shipping_cost.toFixed(2));
    $('#grand-total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
}

function hide() {
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function giftCard() {
    $(".gift-card").show();
    $.ajax({
        url: 'sales/get_gift_card',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#add-payment select[name="gift_card_id_select"]').empty();
            $.each(data, function(index) {
                gift_card_amount[data[index]['id']] = data[index]['amount'];
                gift_card_expense[data[index]['id']] = data[index]['expense'];
                $('#add-payment select[name="gift_card_id_select"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
            });
            $('.selectpicker').selectpicker('refresh');
            $('.selectpicker').selectpicker();
        }
    });
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function cheque() {
    $(".cheque").show();
    $('input[name="cheque_no"]').attr('required', true);
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".gift-card").hide();
}

function creditCard() {
    $.getScript( "public/vendor/stripe/checkout.js" );
    $(".card-element").show();
    $(".card-errors").show();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function deposits() {
    if($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]){
        Alert( 'warning','Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
    $('input[name="cheque_no"]').attr('required', false);
    $('#add-payment select[name="gift_card_id_select"]').attr('required', false);
}

function pointCalculation() {
    paid_amount = $('input[name=paid_amount]').val();
    required_point = Math.ceil(paid_amount / reward_point_setting['per_point_amount']);
    if(required_point > points[$('#customer_id').val()]) {
      Alert( 'warning','Customer does not have sufficient points. Available points: '+points[$('#customer_id').val()]);
    }
    else {
      $("input[name=used_points]").val(required_point);
    }
}

function cancel(rownumber) {
    while(rownumber >= 0) {
        product_price.pop();
        product_discount.pop();
        tax_rate.pop();
        tax_name.pop();
        tax_method.pop();
        unit_name.pop();
        unit_operator.pop();
        unit_operation_value.pop();
        $('table.order-list tbody tr:last').remove();
        rownumber--;
    }
    $('input[name="shipping_cost"]').val('');
    $('input[name="order_discount"]').val('');
    $('select[name="order_tax_rate_select"]').val(0);
    calculateTotal();
}

function confirmCancel() {
    var audio = $("#mysoundclip2")[0];
    audio.play();
    // if (confirm("Are you sure want to cancel?")) {
    //     cancel($('table.order-list tbody tr:last').index());
    // }
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
            $("#customer_id").selectpicker('val', '');
            $("#holdbillnum").val('');
            localStorage.clear();
            localStorage.removeItem("holdbillnum");
            // cancel($('table.order-list tbody tr:last').index());
            clearTableData();
            localStorageClear();
            $('#coupon-code').val('');
            $('#grand-total').text('0.00');
            location.reload();
        } 
    })
    return false;
}

$(document).on('submit', '.payment-form', function(e) {
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        Alert( 'warning',"Please insert product to order table!")
        e.preventDefault();
    }
    else if( parseFloat( $('input[name="paying_amount"]').val() ) < parseFloat( $('input[name="paid_amount"]').val() ) ){
        Alert( 'warning','Paying amount cannot be bigger than recieved amount');
        e.preventDefault();
    }
    $('input[name="paid_by_id"]').val($('select[name="paid_by_id_select"]').val());
    $('input[name="order_tax_rate"]').val($('select[name="order_tax_rate_select"]').val());

});

$(document).on('click', '#paypal-btn', function(){
    $("#add-payment").modal('hide');
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        Alert( 'warning',"Please insert product to order table!")
       return false;
    }
    $("#add-payment").modal('show');
});

$(document).on('click', '#credit-card-btn', function(){
    $("#add-payment").modal('hide');
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        Alert( 'warning',"Please insert product to order table!")
        return false;
    }
    $("#add-payment").modal('show');
});

$(document).on('click', '#cash-btn', function(){
    $("#add-payment").modal('hide');
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        Alert( 'warning',"Please insert product to order table!")
        return false;
    }
    $("#add-payment").modal('show');
});

$('#product-table').DataTable( {
    "order": [],
    'pageLength': product_row_number,
     'language': {
        'paginate': {
            'previous': '<i class="fa fa-angle-left"></i>',
            'next': '<i class="fa fa-angle-right"></i>'
        }
    },
    dom: 'tp'
});
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.addEventListener('keydown', function (e) {
           
           if(`${e.key}` == "F4")
           {
            if( $("#tbody-id").html() && $("#customer_id").val())
                {
                    if($('#holdbillnum').val())
                    {
                        // alert("edit");
                        var holdbill = [];
                        var holdbillSum = '' ;
                        $('.sub-total').each(function(){
                            holdbillSum+=($(this).text()+",");  
                        });
                        holdbillSum= holdbillSum.slice(0, -1);
                        holdbillSum = holdbillSum.split(",");

                        holdbill[0] = $("#customer_id").val();
                        holdbill[1] =  $('#customer_id').find(":selected").text();
                        holdbill[2] =  $("table.order-list tbody").html();

                        holdbill[3]  = getSavedValue("localStorageProductCode").split(",");
                        holdbill[4]  = getSavedValue("localStorageQty").split(",");
                        holdbill[5]  = getSavedValue("localStorageProductDiscount").split(",");
                        holdbill[6]  = getSavedValue("localStorageTaxRate").split(",");
                        holdbill[7]  = getSavedValue("localStorageNetUnitPrice").split(",");
                        holdbill[8]  = getSavedValue("localStorageTaxValue").split(",");
                        holdbill[9]  = getSavedValue("localStorageTaxName").split(",");
                        holdbill[10]  = getSavedValue("localStorageTaxMethod").split(",");
                        holdbill[11]  = getSavedValue("localStorageSubTotalUnit").split(",");
                        holdbill[12]  = holdbillSum;
                        holdbill[13]  = getSavedValue("localStorageProductId").split(",");
                        holdbill[14] = getSavedValue("localStorageSaleUnit").split(",");
                        holdbill[15]  = getSavedValue("localStorageTempUnitName").split(",,");
                        holdbill[16]  = getSavedValue("localStorageSaleUnitOperator").split(",,");
                        holdbill[17]  = getSavedValue("localStorageSaleUnitOperationValue").split(",,");

                        holdbill[18]  = $("#shipping-cost-val").val();
                        holdbill[19]  = $("#order-discount").val();
                        holdbill[20]  = $('#order-tax-rate-select').val();
                        holdbill[21] = $("#subtotal").html();
                        holdbill[22] = $('input[name="order_discount_method"]:checked').val();
                        holdbill[23] = $('#holdbillnum').val();
                        holdbill[24] = $('#coupon-code').val();
                        holdbill[25] = $('input[name="salesPersonCode"]').val();

                    }else{
                        // alert("add");
                        // alert($('input[name="salesPersonCode"]').val());
                        
                        var holdbill = [];
// alert($('#coupon-code').val());
// return false;
                        holdbill[0] = $("#customer_id").val();
                        holdbill[1] =  $('#customer_id').find(":selected").text();
                        holdbill[2] =  $("table.order-list tbody").html();
                        holdbill[3]  = getSavedValue("localStorageProductCode").split(",");
                        holdbill[4]  = getSavedValue("localStorageQty").split(",");
                        holdbill[5]  = getSavedValue("localStorageProductDiscount").split(",");
                        holdbill[6]  = getSavedValue("localStorageTaxRate").split(",");
                        holdbill[7]  = getSavedValue("localStorageNetUnitPrice").split(",");
                        holdbill[8]  = getSavedValue("localStorageTaxValue").split(",");
                        holdbill[9]  = getSavedValue("localStorageTaxName").split(",");
                        holdbill[10]  = getSavedValue("localStorageTaxMethod").split(",");
                        holdbill[11]  = getSavedValue("localStorageSubTotalUnit").split(",");
                        holdbill[12]  = getSavedValue("localStorageSubTotal").split(",");
                        holdbill[13]  = getSavedValue("localStorageProductId").split(",");
                        holdbill[14] = getSavedValue("localStorageSaleUnit").split(",");
                        holdbill[15]  = getSavedValue("localStorageTempUnitName").split(",,");
                        holdbill[16]  = getSavedValue("localStorageSaleUnitOperator").split(",,");
                        holdbill[17]  = getSavedValue("localStorageSaleUnitOperationValue").split(",,");
                        holdbill[18]  = $("#shipping-cost-val").val();
                        holdbill[19]  = $("#order-discount").val();
                        holdbill[20]  = $('#order-tax-rate-select').val();
                        holdbill[21] = $("#subtotal").html();
                        holdbill[22] = $('input[name="order_discount_method"]:checked').val();
                        holdbill[23] = $('#holdbillnum').val();
                        holdbill[24] = $('#coupon-code').val();
                        holdbill[25] = $('input[name="salesPersonCode"]').val();

                    }
                   
                    $.ajax({
                            type: 'POST',
                            url: 'hold_bill',
                            data: {
                                data: holdbill,
                            },
                            success: function(data) {
                            // alert(data)
                            if(data == "2")
                            {
                                Alert('warning', "Hold Bill limit exceeded!")
                                return false; 
                            }
                            clearTableData();
                            localStorageClear();
                            $('#coupon-code').val('');
                            $('#grand-total').text('0.00');
                            // location.reload();
                            }
                            });
                }
           }
        }); 
        function clearTableData(){
            $("table.order-list tbody").html('');
            $("#customer_id").selectpicker('val','');
            $("#customer_id").val('');
            $('#order-discount').val('');
            $('#coupon-text').html('0.00');
            $('input[name="salesPersonCode"]').val('');
            $('select[name="order_tax_rate_select"]').val(0);
            $('#shipping-cost-val').val('');
            $('#coupon-code').val('');
            $('#tax').text('0.00');
            $('#grand-total').text('0.00');

            calculateTotal();
        }
        function holldbillModal(){
            $('#modalHoldBill').html('');
          $('#holdbillModal').modal('show');
          $.ajax({
                type: 'GET',
                url: 'hold_bill_data',
               
                success: function(data) {
                // alert((data.length))
                // $('#modalHoldBill').html('');
                // return false;
                if(data.length == 0)
                {
                    $('#modalHoldBill').append('<h1 style="text-align: center;">No Bill</h1>');
                    return false;
                }
                for(var i=0;i<data.length;i++)
                {
                    $('#modalHoldBill').append('<tr><td class="holdbilldata holdbilldata1 sound-btn" data-id="'+ data[i].id +'"  title="product"><span id="product1_product_name">Bill '+ data[i].hold_bill_no +'</span></td><td><span id="product1_product_code">'+ data[i].customer_name +'</span></td><td><div  id="product1_product_total">'+ data[i].localStorageSubTotal +'</div></td><td class="text-right"><i class="dripicons-cross text-danger btn"  onclick="deletehodlbill('+data[i].id+')"></i></td></tr>');
                }
                
                }
            });
        }  
      function deletehodlbill(ids){
        // alert(ids)
        // return false;
        $.ajax({
                type: 'GET',
                url: 'hold_bill_delete/'+ids,
                // data : {id:ids}
               
                success: function(data) {
                // alert(JSON.stringify(data.message))
                $('#holdbillModal').modal('hide');
                Alert('warning', data.message);
                // window.location.reload();
                clearTableData();
                localStorageClear();
                // localStorage.clear();
                }
            });

                
        }
      $(document).on('click', '.holdbilldata', function() {
        $('#holdbillModal').modal('hide');
        clearTableData();
        localStorageClear();
        localStorage.setItem("holdbillnum",$(this).data('id'));
        var holdBillId = $(this).data('id');
        $.ajax({
                type: 'GET',
                url: 'hold-bill-get/'+holdBillId,
            //    url: 'get-attribute-image/' + typeId,
                success: function(data) {
                    var ddd= JSON.parse(data.localStorageQty);
                // alert((ddd.length));
                // console.log(ddd);
              
                // localStorageClear();

                localStorageStoreData(data);
               var cust_id = data.customer_id;
               
                $("#tbody-id").html(data.tbody_id);
                // edit();
                // alert(JSON.parse(data.localStorageQty).length)
                for(var i = 0; i < JSON.parse(data.localStorageQty).length; i++) {
                    // alert(i);
                    // alert(JSON.parse(data.localStorageSubTotalUnit)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ') .qty').val(JSON.parse(data.localStorageQty)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.discount-value').val(JSON.parse(data.localStorageProductDiscount)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val(JSON.parse(data.localStorageTaxRate)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.net_unit_price').val(JSON.parse(data.localStorageNetUnitPrice)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-value').val(JSON.parse(data.localStorageTaxValue)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val(JSON.parse(data.localStorageTaxName)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val(JSON.parse(data.localStorageTaxMethod)[i]);
                    // alert(JSON.parse(data.localStorageSubTotalUnit)[i]);
                    // alert(JSON.parse(data.localStorageSubTotal)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-price').text(JSON.parse(data.localStorageSubTotalUnit)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sub-total').text(JSON.parse(data.localStorageSubTotal)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.subtotal-value').val(JSON.parse(data.localStorageSubTotal)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-id').val(JSON.parse(data.localStorageProductId)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-code').val(JSON.parse(data.localStorageProductCode)[i]);
                    $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(JSON.parse(data.localStorageSaleUnit)[i]);
                        if(i==0) {
                            JSON.parse(data.localStorageTempUnitName)[i] += ',';
                            JSON.parse(data.localStorageSaleUnitOperator)[i] += ',';
                            JSON.parse(data.localStorageSaleUnitOperationValue)[i] += ',';
                        }
                        $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val( JSON.parse(data.localStorageSaleUnitOperator)[i]);
                        $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val(JSON.parse(data.localStorageSaleUnitOperationValue)[i]);
                        product_price.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product_price').val()));
                        var quantity = parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
                        product_discount.push(parseFloat( JSON.parse(data.localStorageProductDiscount)[i] /  JSON.parse(data.localStorageQty)[i]).toFixed(2));
                        tax_rate.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val()));
                        tax_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val());
                        tax_method.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val());
                        temp_unit_name = $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val();
                        unit_name.push( JSON.parse(data.localStorageTempUnitName)[i]);
                        unit_operator.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val());
                        unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val());
                        $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(temp_unit_name);
                        // alert("AA");
                        
                        calculateTotal();
                    }
                    rowindex = $(this).closest('tr').index();
                    
                    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
                    var actualQty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text();
                    var cust_id = localStorage.getItem('customer_id');
                    $("#customer_id").selectpicker('val', localStorage.getItem('customer_id'));
                    var cust_id =  $("#customer_id").val();
                    var cust_id = localStorage.getItem('customer_id');
                    $("#customer_id").trigger('change'); 
                    $.get('sales/getcustomergroup/' + cust_id, function(datagroup) {
                            // alert(datagroup/100)
                            console.log( 'set group', cust_id);
                            customer_group_rate = (datagroup / 100);
                            console.log( 'se customer_group_rate ', customer_group_rate);

                        }); 


                        var order_discount_method = localStorage.getItem('order_discount_method');
                        // alert(order_discount_method)
                        $("#holdbillnum").val(localStorage.getItem('holdbillnum'));
                        $('#shipping-cost-val').val(localStorage.getItem('shipping-cost-val'));
                        $("#order-discount").val(localStorage.getItem('order-discount'));
                        $('#order-discount').val( localStorage.getItem('order-discount'));
                        // $("#order-tax-rate-select").select('val', localStorage.getItem('order-tax-rate-select'));
                        // $('select[name="order_tax_rate_select"]').val(localStorage.getItem('order-tax-rate-select'));
                        if(order_discount_method)
                        {
                            $(`input[name=order_discount_method][value=${order_discount_method}]`).prop("checked",true);
                        }
                        if(localStorage.getItem('coupon-code'))
                        {
                        $("#coupon-code").val(localStorage.getItem('coupon-code'));
                        }
                        
                        $('input[name="salesPersonCode"]').val(localStorage.getItem('sales-person-code'));


                location.reload();   
                calculateTotal();         
                // return false;
                }
            });

      });
      function localStorageStoreData(data)
      {
            // alert(data.coupon_code)
            localStorage.setItem("tbody-id", data.tbody_id);
            localStorage.setItem("order-tax-rate-select", data.order_tax_rate_select );
            // localStorage.setItem("localStorageQty", JSON.parse(data.localStorageQty));
            localStorage.setItem("localStorageProductId", JSON.parse(data.localStorageProductId));
            localStorage.setItem("localStorageQty", JSON.parse(data.localStorageQty));
            localStorage.setItem("localStorageSaleUnit", JSON.parse(data.localStorageSaleUnit));
            localStorage.setItem("localStorageProductCode", JSON.parse(data.localStorageProductCode));
            localStorage.setItem("localStorageProductDiscount", JSON.parse(data.localStorageProductDiscount));
            localStorage.setItem("localStorageTaxRate", JSON.parse(data.localStorageTaxRate));
            localStorage.setItem("localStorageTaxName", JSON.parse(data.localStorageTaxName));
            localStorage.setItem("localStorageTaxMethod", JSON.parse(data.localStorageTaxMethod));
            localStorage.setItem("localStorageTempUnitName", JSON.parse(data.localStorageTempUnitName));
            localStorage.setItem("localStorageSaleUnitOperator", JSON.parse(data.localStorageSaleUnitOperator));
            localStorage.setItem("localStorageSaleUnitOperationValue", JSON.parse(data.localStorageSaleUnitOperationValue));
            localStorage.setItem("localStorageNetUnitPrice", JSON.parse(data.localStorageNetUnitPrice));
            localStorage.setItem("localStorageTaxValue", JSON.parse(data.localStorageTaxValue));
            localStorage.setItem("localStorageSubTotalUnit", JSON.parse(data.localStorageSubTotalUnit));
            localStorage.setItem("localStorageSubTotal", JSON.parse(data.localStorageSubTotal));
            
            localStorage.setItem("order_discount_method",data.discount_method);
            localStorage.setItem("holdbillnum",data.id);
            localStorage.setItem("customer_id", data.customer_id);
           var order_tax_rate =  $("#order-tax-rate-select").val();

        //    alert(order_tax_rate)
        //    alert(data.order_tax_rate_select)
            if(data.sales_person_code)
            {
                localStorage.setItem("sales-person-code", data.sales_person_code);
            }
            else{
                localStorage.setItem("sales-person-code",'');
            }
            if( data.order_tax_rate_select != 0)
            {
                localStorage.setItem("order-tax-rate-select",data.order_tax_rate_select);
                $('#order-tax-rate-select').val(data.order_tax_rate_select);
                
            }
            if(data.coupon_code)
            {
                localStorage.setItem("coupon-code",data.coupon_code);
                // $('#coupon-code').val(data.coupon_code);
            }
            else{
                localStorage.setItem("coupon-code",'');
                $('#coupon-code').val('');
            }
            if(data.order_discount)
            {
                localStorage.setItem("order-discount",data.order_discount);
            }
            else{
                localStorage.setItem("order-discount",'');
            }
            if(data.shipping_cost_val)
            {
                localStorage.setItem("shipping-cost-val", data.shipping_cost_val);
            }
            else{
                localStorage.setItem("shipping-cost-val",'');
            }
           
            
           
            
            
      }
      function localStorageClear()
        {
            localStorage.removeItem("localStorageProductCode"); 
            localStorage.removeItem("localStorageQty"); 
            localStorage.removeItem("localStorageProductDiscount"); 
            localStorage.removeItem("localStorageTaxRate"); 
            localStorage.removeItem("localStorageNetUnitPrice"); 
            localStorage.removeItem("localStorageTaxValue"); 
            localStorage.removeItem("localStorageTaxName"); 
            localStorage.removeItem("localStorageTaxMethod");
            localStorage.removeItem("localStorageSubTotalUnit"); 
            localStorage.removeItem("localStorageSubTotal"); 
            localStorage.removeItem("localStorageProductId");
            localStorage.removeItem("localStorageSaleUnit"); 
            localStorage.removeItem("localStorageTempUnitName"); 
            localStorage.removeItem("localStorageSaleUnitOperator"); 
            localStorage.removeItem("localStorageSaleUnitOperationValue"); 
            localStorage.removeItem("order-tax-rate-select"); 
            localStorage.removeItem("customer_id"); 
            localStorage.removeItem("tbody-id");
            localStorage.removeItem("order-discount");
            localStorage.removeItem("order_discount_method");
            // localStorage.removeItem("holdBillId");
            localStorage.removeItem("holdbillnum");
            localStorage.removeItem("shipping-cost-val");
            localStorage.removeItem("order-tax-rate-select");
            localStorage.removeItem("coupon-code");
            localStorage.removeItem("sales-person-code");
             calculateTotal();
            // localStorage.clear();
        }
</script>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function(){
        // $('select[name="order_tax_rate_select"]').val(0);
    $("#customer_id").selectpicker('val', localStorage.getItem('customer_id'));
    $("#customer_id").val(localStorage.getItem('customer_id'));
    var order_discount_method = localStorage.getItem('order_discount_method');
    // alert(order_discount_method)
    $("#holdbillnum").val(localStorage.getItem('holdbillnum'));
    $('#shipping-cost-val').val(localStorage.getItem('shipping-cost-val'));
    $("#order-discount").val(localStorage.getItem('order-discount'));
    $('#order-discount').val( localStorage.getItem('order-discount'));
    // $("#order-tax-rate-select").select('val', localStorage.getItem('order-tax-rate-select'));
    // $('select[name="order_tax_rate_select"]').val(localStorage.getItem('order-tax-rate-select'));
    if(order_discount_method)
    {
        $(`input[name=order_discount_method][value=${order_discount_method}]`).prop("checked",true);
    }
    if(localStorage.getItem('coupon-code'))
    {
    $("#coupon-code").val(localStorage.getItem('coupon-code'));
    }
    
    $('input[name="salesPersonCode"]').val(localStorage.getItem('sales-person-code'));
    // alert(localStorage.getItem('order_discount_method'))
    // $("input[name=background][value='some value']").prop("checked",true);
    
    var cust_id =  $("#customer_id").val();
    var cust_id = localStorage.getItem('customer_id');
    $.get('sales/getcustomergroup/' + cust_id, function(datagroup) {
            console.log( 'set group', cust_id);
            customer_group_rate = (datagroup / 100);
            console.log( 'se customer_group_rate ', customer_group_rate);

        }); 
    calculateTotal();

    
});
$(document).ready(function(){
    $("#customer_id").selectpicker('val', localStorage.getItem('customer_id'));
    var docEl = doc.documentElement;
    var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
    requestFullScreen.call(docEl);
});
   
</script>
<script>
	function toggleFullScreen() {
	  var doc = window.document;
	  var docEl = doc.documentElement;

	  var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
	  var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

	  if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
		requestFullScreen.call(docEl);
	  }
	  else {
		cancelFullScreen.call(doc);
	  }
	}
</script>
@endpush
