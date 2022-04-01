@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
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
                        <div class="card-header d-flex align-items-center bg-success text-white">
                            <h4><strong>{{trans('file.add_enquiry')}}</strong></h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            {!! Form::open(['route' => 'enquiry.store','name'=>'enquiryForm','id'=>'enquiryForm', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.name')}} *</strong> </label>
                                        <input type="text" name="name" value="{{old('name')}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Email')}} *</label>
                                        <input type="email" name="email" id="email" placeholder="example@example.com"  onkeyup="ValidateEmail();"  value="{{old('email')}}" class="form-control">
                                        <span id="lblError" style="color: red"></span>
                                        <!-- @if($errors->has('email'))
                                        <span>
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Mobile')}} *</label>
                                        <input type="number" name="mobile" value="{{old('mobile')}}" required class="form-control">
                                        @if($errors->has('mobile'))
                                            <span>
                                                <strong style="color: red;">{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.requirement')}}</strong> </label>
                                        <div class="input-group">
                                            <select name="requirement" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('requirement')}}"  title="Select Requirement..."  autocomplete="type" data-live-search="true" data-live-search-style="begins" required>
                                               
                                                    <option value="1" {{old ('requirement') == 1 ? 'selected' : ''}}>Landscape Design</option>
                                                    <option value="2" {{old ('requirement') == 2 ? 'selected' : ''}}>Execution</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Image')}}</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($errors->has('image'))
                                    <span>
                                        <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div> -->
                                
                                <div class="col-md-12">
                                    <div class="form-group mt-4 text-right ">
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
    
    function ValidateEmail() {
    
        var email = document.getElementById("email").value;
        // alert(email)
        var lblError = document.getElementById("lblError");
    lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
        lblError.innerHTML = "Invalid email address.";
    }
}
</script>
<script type="text/javascript">
     $(document).ready(function(){
        $("#enquiryForm").validate({
                    
                    rules: {
                    
                        'mobile': {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 10
                        },
                        
                        
                        'name': {
                            required: true,
                            maxlength: 200
                        },
                    
                    },
                  
                }); 
     });
    // $("ul#people").siblings('a').attr('aria-expanded','true');
    // $("ul#people").addClass("show");
    // $("ul#people #supplier-create-menu").addClass("active");
    $("#enquiry_management").siblings('a').attr('aria-expanded','true');
    $("#enquiry_management").addClass("show");
    $("#enquiry-create-menu").addClass("active");
</script>
@endpush
