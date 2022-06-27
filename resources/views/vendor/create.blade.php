<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $general_setting->site_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.css') ?>" type="text/css">


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
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Outfit:400,500,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css?family=Outfit:400,500,700" rel="stylesheet"></noscript>
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
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        .error{
            color: red;
        }
        .option_parent .text{
            font-weight: bold !important;
            text-transform: capitalize;
            font-size: 15px;
            
        }
        .option_sub .text{
        
            text-transform: capitalize;
            font-size: 15px;
            
        }

    </style>
  </head>


        @if (Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
            <!-- RTL css -->
            <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-rtl.min.css'); ?>" type="text/css">
            <link rel="stylesheet" href="<?php echo asset('css/custom-rtl.css'); ?>" type="text/css" id="custom-style">
        @endif
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            } 
            .error {
                color: red;
            
            } 
            .bootstrap-select.btn-group.show-tick .dropdown-menu a.selected span.dropdown-item-inner span.check-mark {
                left: 0 !important;
                margin: 6px;
                top: 3px;
            }
        </style>
    </head>

<body
    style="min-height: 100vh;background:linear-gradient(30deg,#efe9d4af,#EFE9D4) , url('{{ asset('public/images/leaf-bg.jpg') }}');background-size:cover ">

    {{-- <header class="header">
        <nav class="navbar" style="background: #00000062">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <a id="toggle-btn" href="#" class="menu-btn p-2 bg-white">
                 
              </a>
              <span class="brand-big">
                @if ($general_setting->site_logo)
                <a href="{{url('/')}}"><img src="{{url('public/logo', $general_setting->site_logo)}}" width="115"></a>
                @else
                  <a href="{{url('/')}}"><h1 class="d-inline">{{$general_setting->site_title}}</h1></a>
                @endif
              </span>

              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
              
             
                <li class="nav-item">
                  <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i> </i>
                  </a>
                  <ul class="right-sidebar">
                      <li>
                        <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
                      </li>

                      <li>
                        <a href="{{route('setting.general')}}"><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
                      </li>
                    
                      <!--<li>
                        <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>
                      </li>-->
                     
                     
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
    </header> --}}
    {{-- =========================== --}}
    <div class="row m-0">
        <div class="col-md-5 bg-primary p-0 d-md-block d-none" style="height: 100vh;">
            <img src="{{ asset('public/logo/login_cover.png') }}" style="height: 100%;width:100%;object-fit:cover">
        </div>
        <div class="col-md-7" style="height: 100vh; background: #EFE9D3">
            <img src="{{ asset('public/logo/logo_two.png') }}" width="60px" class="m-3 position-absolute"
                style="filter: drop-shadow(1px 1px 4px #eee);"> <br><br>
            <div class="d-flex justify-content-center align-items-center w-100">
                <div class="w-100">
                    <div class="text-center">
                        <img src="{{ asset('public/logo/logo_one.png') }}" width="130px">
                        <h4 style="text-transform:uppercase;font-weight: bold !important;font-family: 'Outfit', sans-serif;font-size:1.5rem"
                            class="my-4">
                            {{ trans('file.Vendor Register') }}
                        </h4>
                    </div>
                    <div class="card-body " style="max-height: 70vh;overflow:auto">
                        <div class="px-3">
                            <p class="italic">
                                <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>
                            {!! Form::open(['route' => 'vendor.vendor-register-form', 'name' => 'vendorForm', 'id' => 'vendorForm', 'method' => 'post', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.name')}} *</strong> </label>
                                            <input type="text" name="name" value="{{old('name')}}" required class="form-control">
                                            @if($errors->has('name'))
                                            <label  class="error" for="name">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{trans('file.category')}}</strong> </label>
                                                <div class="input-group">
                                                <select name="category[]" class="selectpicker form-control @error('type') is-invalid @enderror"  title="Select Category..." value="{{old('category')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins" multiple>
                                                  
                                                    @foreach($categories as $parentCategory => $category)
                                                        <option  class="option_parent" disabled>{{$parentCategory}}</option>
                                                        @if(isset($category)  &&  count($category) > 0 ) 
                                                            @foreach($category as $key => $item)
                                                                <option  class="option_sub" value="{{$item->id}}" {{old ('category') == $item->id ? 'selected' : ''}}> &nbsp; &nbsp;&nbsp; &nbsp;  {{$item->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach 
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Mobile')}} *</label>
                                            <input type="number" name="phone_number" min="0" value="{{old('phone_number')}}" required class="form-control noscroll"/>
                                            @if($errors->has('phone_number'))
                                            
                                            <label  class="error" for="phone_number">{{ $errors->first('phone_number') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Email')}} *</label>
                                            <input type="text" name="email" id="email" placeholder="example@example.com" onkeyup="ValidateEmail();" value="{{old('email')}}" required class="form-control">
                                            @if($errors->has('email'))
                                            <label  class="error" for="email">{{ $errors->first('email') }}</label>
                                            @endif
                                            <span id="lblError" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Password')}} *</label>
                                            <input type="password" name="password" value="{{old('password')}}" required class="form-control">
                                            @if($errors->has('password'))
                                            
                                            <label  class="error" for="password">{{ $errors->first('password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.Address') }} *</label>
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.City') }} *</label>
                                            <input type="text" name="city" value="{{ old('city') }}"
                                                required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.State') }}</label>
                                            <input type="text" name="state" value="{{ old('state') }}"
                                                class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.Country') }}</label>
                                            <input type="text" name="country" value="{{ old('country') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.Postal Code') }}</label>
                                            <input type="text" name="postal_code"
                                                value="{{ old('postal_code') }}" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-12 py-3">
                                        <h4><strong>{{ trans('file.Company Info') }}</strong></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Company Name')}} *</label>
                                            <input type="text" name="company_name" value="{{old('company_name')}}"  required class="form-control">
                                            @if($errors->has('company_name'))
                                            <label  class="error" for="company_name">{{ $errors->first('company_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.gst')}}*</label>
                                            <input type="text" name="gst" value="{{old('gst')}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.contact_person') }}</label>
                                            <input type="text" name="contact_person"
                                                value="{{ old('contact_person') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.pan_no')}} *</label>
                                            <input type="text" name="entity_name" value="{{old('entity_name')}}" class="form-control">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12 py-3">
                                        <h4><strong>{{ trans('file.Bank Info') }}</strong></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Bank Name')}} *</label>
                                            <input type="text" name="bank_name" value="{{old('bank_name')}}" required class="form-control">
                                            @if($errors->has('bank_name'))
                                                <label  class="error" for="bank_name">{{ $errors->first('bank_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.Account No') }}</label>
                                            <input type="text" name="account_no"
                                                value="{{ old('account_no') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.IFS Code') }}</label>
                                            <input type="text" name="ifs_code"
                                                value="{{ old('ifs_code') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('file.Branch') }}</label>
                                            <input type="text" name="branch" value="{{ old('branch') }}"
                                                class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <input type="submit" value="{{ trans('file.submit') }}"
                                                class="btn btn-primary">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- <section class="forms mx-auto">
            <div class="container align-items-center d-flex justify-content-center " style="min-height: 90vh">
                <div class="row m-0 bg-white align-items-center ">
                    <div class="col-md-4 border-right text-center">
                        <img src="{{ url('public/logo/logo_two.png') }}" width="250px" class="mx-auto">
                    </div>
                    <div class="col-md-8 p p-0 py-4">
                        <div class="cardx">
                            <div class="card-header d-flex text-center  align-items-center">
                                <h1 class="text-center"><strong
                                        class="text-center">{{ trans('file.Vendor Register') }}</strong></h1>
                            </div>
                            <div class="card-body " style="max-height: 70vh;overflow:auto">
                                <div class="px-3">
                                    <p class="italic">
                                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                    </p>
                                    {!! Form::open(['route' => 'vendor.vendor-register-form', 'name' => 'vendorForm', 'id' => 'vendorForm', 'method' => 'post', 'files' => true]) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.name') }} *</strong> </label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        required class="form-control">
                                                    @if ($errors->has('name'))
                                                        <span id="lblError">
                                                            <strong
                                                                style="color: red;">{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.category') }}</strong> </label>
                                                    <div class="input-group">
                                                        <select name="category"
                                                            class="selectpicker form-control @error('type') is-invalid @enderror"
                                                            title="Select Category..." value="{{ old('category') }}"
                                                            autocomplete="type" data-live-search="true"
                                                            data-live-search-style="begins">

                                                            @foreach ($category as $key => $val)
                                                                <option value="{{ $val['id'] }}"
                                                                    {{ old('category') == $val['id'] ? 'selected' : '' }}>
                                                                    {{ $val['name'] }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Mobile') }} *</label>
                                                    <input type="number" name="phone_number" min="0"
                                                        value="{{ old('phone_number') }}" required
                                                        class="form-control noscroll" />
                                                    @if ($errors->has('phone_number'))
                                                        <span>
                                                            <strong
                                                                style="color: red;">{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Email') }} *</label>
                                                    <input type="text" name="email" id="email"
                                                        placeholder="example@example.com" onkeyup="ValidateEmail();"
                                                        value="{{ old('email') }}" required class="form-control">
                                                    @if ($errors->has('email'))
                                                        <span id="lblError">
                                                            <strong
                                                                style="color: red;">{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                    <span id="lblError" style="color: red"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Password') }} *</label>
                                                    <input type="password" name="password"
                                                        value="{{ old('password') }}" required class="form-control">
                                                    @if ($errors->has('password'))
                                                        <span>
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Address') }} *</label>
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.City') }} *</label>
                                                    <input type="text" name="city" value="{{ old('city') }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.State') }}</label>
                                                    <input type="text" name="state" value="{{ old('state') }}"
                                                        class="form-control">
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Country') }}</label>
                                                    <input type="text" name="country" value="{{ old('country') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Postal Code') }}</label>
                                                    <input type="text" name="postal_code"
                                                        value="{{ old('postal_code') }}" class="form-control">
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="card-header d-flex align-items-center">
                                                    <h4><strong>{{ trans('file.Company Info') }}</strong></h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Company Name') }} *</label>
                                                    <input type="text" name="company_name"
                                                        value="{{ old('company_name') }}" required
                                                        class="form-control">
                                                    @if ($errors->has('company_name'))
                                                        <span>
                                                            <strong
                                                                style="color: red;">{{ $errors->first('company_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.gst') }}</label>
                                                    <input type="text" name="gst" value="{{ old('gst') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.contact_person') }}</label>
                                                    <input type="text" name="contact_person"
                                                        value="{{ old('contact_person') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.entity_name') }} *</label>
                                                    <input type="text" name="entity_name"
                                                        value="{{ old('entity_name') }}" required class="form-control">
                                                    @if ($errors->has('entity_name'))
                                                        <span>
                                                            <strong>{{ $errors->first('entity_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-header d-flex align-items-center">
                                                    <h4><strong>{{ trans('file.Bank Info') }}</strong></h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Bank Name') }} *</label>
                                                    <input type="text" name="bank_name"
                                                        value="{{ old('bank_name') }}" required class="form-control">
                                                    @if ($errors->has('bank_name'))
                                                        <span>
                                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Account No') }}</label>
                                                    <input type="text" name="account_no"
                                                        value="{{ old('account_no') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.IFS Code') }}</label>
                                                    <input type="text" name="ifs_code"
                                                        value="{{ old('ifs_code') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Branch') }}</label>
                                                    <input type="text" name="branch" value="{{ old('branch') }}"
                                                        class="form-control">
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="form-group mt-4">
                                                    <input type="submit" value="{{ trans('file.submit') }}"
                                                        class="btn btn-primary">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


        <div style="display:none" id="content" class="animate-bottom">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <p>&copy; {{ $general_setting->site_title }} | {{ trans('file.Developed') }}
                            {{ trans('file.By') }} <span
                                class="external text-white">{{ $general_setting->developed_by }}</span></p>
                    </div>
                </div>
            </div>
        </footer>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/charts-custom.js'); ?>"></script>

    <script type="text/javascript">
        function ValidateEmail() {
            var email = document.getElementById("email").value;
            // alert(email)
            var lblError = document.getElementById("lblError");
            lblError.innerHTML = "";
            var expr =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!expr.test(email)) {
                lblError.innerHTML = "Invalid email address.";
            }
        }
    </script>
    <script>
        
     $(document).ready(function(){
       
        $("div.alert").delay(3000).slideUp(750);
        $("#vendorForm").validate({
                    
                    rules: {
                    
                        'phone_number': {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 10
                        },
                        'password': {
                            required: true,
                            minlength: 8
                        },
                        
                       
                        'company_name': {
                            required: true,
                            maxlength: 200
                        },

                        'entity_name': {
                            minlength: 10
                        }
                    
                    },


                    'company_name': {
                        required: true,
                        maxlength: 200
                    }, 
                }, 

            });


        });
    </script>
</body>

</html>
