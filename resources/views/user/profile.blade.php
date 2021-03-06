@extends('layout.main')
@section('content')

 
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Update User Profile')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['user.profileUpdate', Auth::id()], 'method' => 'put']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('file.UserName')}} *</strong> </label>
                                    <input type="text" name="name" value="{{$lims_user_data['name']}}" required class="form-control" />
                                    @if($errors->has('name'))
                                    <span>
                                       <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Email')}} *</strong> </label>
                                    <input type="email" name="email" value="{{$lims_user_data['email']}}" required class="form-control">
                                    @if($errors->has('email'))
                                    <span>
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Phone Number')}} *</strong> </label>
                                    <input type="text" name="phone" value="{{$lims_user_data['phone']}}" required class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Company Name')}}</strong> </label>
                                    <input type="text" name="company_name" value="{{$lims_user_data['company_name']}}" class="form-control" />
                                </div>
                                @if(isset($lims_user_data['vendor_id']))
                                <div class="form-group">
                                    <label>{{ trans('file.nursery_code') }}*</label>
                                    <input type="text" name="nursery_code"
                                        value="{{$lims_user_data['nursery_code']}}" maxlength="3" onkeydown="return /[a-z]/i.test(event.key)"  style="text-transform:uppercase" required class="form-control">
                                </div>
                                @endif
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Change Password')}}</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['user.password', Auth::id()], 'method' => 'put']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('file.Current Password')}} *</strong> </label>
                                    <input type="password" name="current_pass" required class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.New Password')}} *</strong> </label>
                                    <input type="password" name="new_pass" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Confirm Password')}} *</strong> </label>
                                    <input type="password" name="confirm_pass" id="confirm_pass" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #user-menu").addClass("active");



    $('#confirm_pass').on('input', function(){

        if($('input[name="new_pass"]').val() != $('input[name="confirm_pass"]').val())
            $("#divCheckPasswordMatch").html("Password doesn't match!");
        else
            $("#divCheckPasswordMatch").html("Password matches!");

    });
</script>
@endpush
