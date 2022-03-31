@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif 
 

@if(session()->has('create_message'))
    <div class="alert alert-dismissible text-center">
        <div class="alert-icon text-success">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="alert-text">
            {!! session()->get('create_message') !!}
        </div>
        <div class="alert-cancel">
            <i class="fa fa-times" data-dismiss="alert" aria-label="Close"></i>
        </div>
    </div>
@endif

@if(session()->has('message'))
    <div class="alert alert-dismissible text-center">
        <div class="alert-icon text-success">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="alert-text">
            {!! session()->get('message') !!}
        </div>
        <div class="alert-cancel">
            <i class="fa fa-times" data-dismiss="alert" aria-label="Close"></i>
        </div>
    </div>
@endif

@if(session()->has('edit_message'))
    <div class="alert alert-dismissible text-center">
        <div class="alert-icon text-success">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="alert-text">
            {!! session()->get('edit_message') !!}
        </div>
        <div class="alert-cancel">
            <i class="fa fa-times" data-dismiss="alert" aria-label="Close"></i>
        </div>
    </div>
@endif

 

@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('import_message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif


{{-- 

@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
@endif
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif --}}

@if($errors->has('coupon_no'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('coupon_no') }}</div>
@endif
@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if($errors->has('image'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('image') }}</div>
@endif
@if($errors->has('email'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('email') }}</div>
@endif
@if($errors->has('card_no'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('card_no') }}</div>
@endif

@if(session()->has('message1'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message1') }}</div>
@endif
@if(session()->has('message2'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message2') }}</div>
@endif
@if(session()->has('message3'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message3') }}</div>
@endif
 
@if($errors->has('phone_number'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('phone_number') }}</div>
@endif
 