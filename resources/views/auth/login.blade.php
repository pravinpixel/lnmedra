<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" rel="stylesheet"></noscript>
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css">

    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
  </head>
  <body>
    <div class="page login-page justify-content-center d-flex align-items-center " style="min-height: 100vh;background:linear-gradient(#000000c4,#00000070) , url('{{ asset('public/images/leaf-bg.jpg') }}');background-size:cover ">
      <div class="container h-100">
        <div class="row p-5 shadow-lg align-items-center" style="backdrop-filter: blur(2px);background:#ffffffe8;border-radius:25px">
          <div class="col-md-6 text-center">
             <img src="{{ asset('public/logo/logo.png') }}" style="width: 350px" alt="">
          </div>
          <div class="col-md-6">
            <h1 class="display-4 text-center mb-3">Login</h1>
            <form method="POST" action="{{ route('login') }}" id="login-form" class="m-0 w-100 text-center" style="max-width: 100% !important">
              @csrf
              <div class="form-group-material">
                <input id="login-username" type="text" name="name" required class="pl-3 input-material rounded-pill" value="">
                <label for="login-username" class="label-material" style="left: 15px;">{{trans('file.UserName')}}</label>
                  @if(session()->has('error'))
                    <div class="position-relative">
                      <small style="left: 10px;margin-top:6px" class="position-absolute text-danger">{{ session()->get('error') }}</small>
                    </div>
                  @endif
              </div>
              
              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required class="pl-3 input-material rounded-pill" value="">
                <label for="login-password" class="label-material" style="left: 15px;">{{trans('file.Password')}}</label>
                @if(session()->has('error'))
                  <div class="position-relative">
                    <small style="left: 10px;margin-top:6px" class="position-absolute text-danger">{{ session()->get('error') }}</small>
                  </div>
                @endif
              </div>
              <button type="submit" class="btn rounded-pill btn-primary btn-block">{{trans('file.LogIn')}}</button>
              <div class="mt-3">
                <a href="{{ route('password.request') }}" class="forgot-pass mt-2">{{trans('file.Forgot Password?')}}</a>
                <p>{{trans('file.Are You a Vendor')}} ? <a href="{{url('vendor/vendor-register')}}" class="signup">{{trans('file.Click Here to Register')}}</a></p>
                
              </div>
            </form>
          </div>
        </div>
        {{-- <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo">
                @if($general_setting->site_logo)
                  <img src="{{url('public/logo', $general_setting->site_logo)}}" width="110">
                @else
                  <span>{{$general_setting->site_title}}</span>
                @endif
            </div>
            @if(session()->has('delete_message'))
              <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div> 
            @endif
            <form method="POST" action="{{ route('login') }}" id="login-form">
              @csrf
              <div class="form-group-material">
                <input id="login-username" type="text" name="name" required class="input-material" value="">
                <label for="login-username" class="label-material">{{trans('file.UserName')}}</label>
                @if(session()->has('error'))
                    <p>
                        <strong>{{ session()->get('error') }}</strong>
                    </p>
                @endif
              </div>
              
              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required class="input-material" value="">
                <label for="login-password" class="label-material">{{trans('file.Password')}}</label>
                @if(session()->has('error'))
                    <p>
                        <strong>{{ session()->get('error') }}</strong>
                    </p>
                @endif
              </div>
              <button type="submit" class="btn btn-primary btn-block">{{trans('file.LogIn')}}</button>
            </form>
          
             <a href="{{ route('password.request') }}" class="forgot-pass">{{trans('file.Forgot Password?')}}</a>
            <p>{{trans('file.Are You a Vendor')}} ?</p><a href="{{url('vendor/vendor-register')}}" class="signup">{{trans('file.Click Here to Register')}}</a>
          </div> --}}
          <div class="copyrights text-center">
            <p>{{trans('file.Developed By')}} <span class="external text-white">{{$general_setting->developed_by}}</span></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
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
    $('.admin-btn').on('click', function(){
        $("input[name='name']").focus().val('admin');
        $("input[name='password']").focus().val('admin');
    });

  $('.staff-btn').on('click', function(){
      $("input[name='name']").focus().val('staff');
      $("input[name='password']").focus().val('staff');
  });

  $('.customer-btn').on('click', function(){
      $("input[name='name']").focus().val('shakalaka');
      $("input[name='password']").focus().val('shakalaka');
  });
  // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });
</script>