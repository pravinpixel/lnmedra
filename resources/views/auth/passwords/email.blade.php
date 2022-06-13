  
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
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Outfit:400,500,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css?family=Outfit:400,500,700" rel="stylesheet"></noscript>
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css">
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <style>img {user-select: none !important; pointer-events: none}</style>
    <style>@import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@500;600;900&display=swap');</style>
  </head>
  <body> 
    @if(session()->has('not_permitted'))
      <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if(session()->has('message'))
      <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
    @endif
    <div class="row m-0">
      <div class="col-md-5 bg-primary p-0 d-md-block d-none" style="height: 100vh;">
        <img src="{{ asset('public/logo/login_cover.png') }}" style="height: 100%;width:100%;object-fit:cover">
      </div>
      <div class="col-md-7" style="height: 100vh; background: #EFE9D3">
        <img src="{{ asset('public/logo/logo_one.png') }}" width="80px" class="m-3" style="filter: drop-shadow(1px 1px 4px #eee);">
        <div class="d-flex justify-content-center align-items-center">
          <div class="w-100">
            <div class="text-center">
              <img src="{{ asset('public/logo/logo_two.png') }}" width="180px">
              <h3 class="my-4">{{ __('Reset Password') }}</h3>
            </div>
            <form   method="POST" action="{{ route('password.email') }}" id="login-form" class="text-center col-lg-6  mx-auto">
            
              @csrf
              @if(session()->has('error'))
                <small style="left: 10px;margin-top:6px" class="text-danger">{{ session()->get('error') }}</small>
              @endif
              <div class="form-group-material">
                <input id="login-username" type="text" name="email" required class="pl-3 input-material rounded-pill"  value="{{ old('email') }}" required>
                <label for="login-username" class="label-material text-dark" style="left: 15px;">{{ __('E-Mail Address') }}</label>
              </div> 
                @if ($errors->any())
                    @foreach ($errors  as $err)
                        <span class="invalid-feedback">
                            <strong>{{ $err }}</strong>
                        </span>
                    @endforeach 
                @endif
              <button type="submit" class="btn rounded-pill lead btn-danger btn-block">
                <b class="fw-bold">{{ __('Send Password Reset Link') }}</b>
              </button> 
            </form>
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
  $("div.alert").delay(3000).slideUp(750);
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