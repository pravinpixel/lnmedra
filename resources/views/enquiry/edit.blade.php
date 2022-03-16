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
                            <div class="card-header d-flex align-items-center">
                                <h4><strong>{{trans('file.edit_enquiry')}}</strong></h4>
                            </div>
                            <div class="card-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                {!! Form::open(['route' => ['enquiry.update',$lims_enquiry_data->id],'name'=>'enquiryForm','id'=>'enquiryForm', 'method' => 'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.name')}} *</strong> </label>
                                            <input type="text" name="name" value="{{$lims_enquiry_data->name}}" required class="form-control">
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Email')}} *</label>
                                            <input type="email" name="email" placeholder="example@example.com" value="{{$lims_enquiry_data->email}}" required class="form-control">
                                            @if($errors->has('email'))
                                        <span>
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Mobile')}} *</label>
                                            <input type="number" name="mobile" value="{{$lims_enquiry_data->mobile}}" required class="form-control">
                                            @if($errors->has('mobile'))
                                            
                                                <span>
                                                    <strong style="color: red;" >{{ $errors->first('mobile') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.requirement')}}</strong> </label>
                                            <div class="input-group">
                                                <select name="requirement" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('requirement')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins"  required>
                                                    <option value="1" <?php echo "$lims_enquiry_data->requirement" == "1" ?   "selected" : '' ;?> >Landscape Design</option>
                                                    <option value="2" <?php echo "$lims_enquiry_data->requirement" == "2" ?   "selected" : '' ;?> >Execution</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                  
                                
                                    <div class="col-md-12">
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
        $("#enquiryForm").validate({
                    
                    rules: {
                    
                        'mobile': {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 10
                        },
                        
                        'email': {
                            required: true,
                            email: true
                        },
                        'name': {
                            required: true,
                            maxlength: 200
                        },
                    
                    },
                    // messages: {

                    //     'phone_number': {
                    //         required: "Please enter Mobile Number",
                    //     },
                    //     'email': {
                    //         required: "Please enter email",
                    //     },
                    //     'company_name': {
                    //         required: "Please enter valid Date",
                    //     },
                    
                    // },  
                }); 
     });
     $("#enquiry_management").siblings('a').attr('aria-expanded','true');
    $("#enquiry_management").addClass("show");
    $("#enquiry-list-menu").addClass("active");
</script>
@endpush
