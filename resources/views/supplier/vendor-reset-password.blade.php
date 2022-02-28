@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
<style>
     .error{
            color: red;
        }
</style>
<section class="forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4><strong>{{trans('file.PAsswor Reset')}}</strong></h4>
                            </div>
                            <div class="card-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                {!! Form::open(['route' => ['supplier.vendor-reset-password',$userId],'name'=>'vendorForm','id'=>'vendorForm', 'method' => 'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.New Password')}} *</strong> </label>
                                            <input type="text" name="new_password" value="" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Confirm Password')}} *</strong> </label>
                                            <input type="text" name="confirm_password" value="" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-4">
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
  $(document).ready(function(){
   
        $("#vendorForm").validate({
                    
                    rules: {
                    
                        'new_password': {
                            required: true,
                            minlength: 8,
                        },
                        'confirm_password': {
                            required: true,
                            minlength: 8,
                    
                    },
                    
                    },
                   
                }); 
     });
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
</script>
@endpush
