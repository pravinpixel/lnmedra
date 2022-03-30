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
                                <h4><strong>{{trans('file.Add Customer')}}</strong></h4>
                            </div>
                            <div class="card-header d-flex align-items-center">
                                <h4>{{trans('file.Basic Information')}}</h4>
                            </div>
                            <div class="card-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                {!! Form::open(['route' => 'customer.store','id'=>'basicData', 'method' => 'post', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Customer Group')}} *</strong> </label>
                                            <select required class="form-control selectpicker" id="customer-group-id" name="customer_group_id" onchange='saveValue(this);'>
                                                @foreach($lims_customer_group_all as $customer_group)
                                                    <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.name')}} *</strong> </label>
                                            <input type="text" id="name" name="customer_name" required class="form-control" onkeyup='saveValue(this);'>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Company Name')}}</label>
                                            <input type="text" name="company_name" class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Email')}}</label>
                                            <input type="email" name="email" placeholder="example@example.com" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Phone Number')}} *</label>
                                            <input type="number" name="phone_number" required class="form-control">
                                            @if($errors->has('phone_number'))
                                        <span>
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.requirement')}}</strong> </label>
                                            <div class="input-group">
                                                <select name="requirement" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('requirement')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins" required>
                                                    <option value="1" {{old ('requirement') == 1 ? 'selected' : ''}}>Landscape Design</option>
                                                    <option value="2" {{old ('requirement') == 2 ? 'selected' : ''}}>Execution</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Tax Number')}}</label>
                                            <input type="text" name="tax_no" class="form-control">
                                        </div>
                                    </div>  --}}
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Address')}}</label>
                                            <input type="text" name="address"  class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.City')}} </label>
                                            <input type="text" name="city" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.State')}}</label>
                                            <input type="text" name="state" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Postal Code')}}</label>
                                            <input type="text" name="postal_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Country')}}</label>
                                            <input type="text" name="country" class="form-control">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label>{{trans('file.Add User')}}</label>&nbsp;
                                            <input type="checkbox" name="user" value="1" />
                                        </div>
                                    </div> --}}
                                    
                                    {{-- <div class="col-md-6 user-input">
                                        <div class="form-group">
                                            <label>{{trans('file.UserName')}} *</label>
                                            <input type="text" name="name" class="form-control">
                                            @if($errors->has('name'))
                                        <span>
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 user-input">
                                        <div class="form-group">
                                            <label>{{trans('file.Password')}} *</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="card-header d-flex align-items-center">
                                            <h4>{{trans('file.Additional Information')}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label>{{trans('file.Your Birth Day Date')}} *</strong> </label> -->
                                            <p class="italic"><small>{{trans('file.Your Birth Day Date')}}.</small></p>
                                            <input type="date" id="customer_dob" name="customer_dob" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label>{{trans('file.Your Marriage Date')}}</label> -->
                                            <p class="italic"><small>{{trans('file.Your Marriage Date')}}.</small></p>
                                            <input type="date" name="marriage_date" id="marriage_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="pos" value="0">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
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
                $("#basicData").validate({
                    
                    rules: {
                    
                        'customer_group_id': {
                            required: true,
                        },
                        'customer_name': {
                            required: true,
                        },
                        
                        
                        'phone_number': {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 10
                            
                        },
                        'address': {
                      
                          
                        }, 
                        'city': {
                         
                           
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

</script>
<script type="text/javascript">

   
        
    $("ul#customer_management").siblings('a').attr('aria-expanded','true');
    $("ul#customer_management").addClass("show");
    $("ul#customer_management #customer-create-menu").addClass("active");

    $(".user-input").hide();

    $('input[name="user"]').on('change', function() {
        if ($(this).is(':checked')) {
            $('.user-input').show(300);
            $('input[name="name"]').prop('required',true);
            $('input[name="password"]').prop('required',true);
        }
        else{
            $('.user-input').hide(300);
            $('input[name="name"]').prop('required',false);
            $('input[name="password"]').prop('required',false);
        }
    });

    //$("#name").val(getSavedValue("name"));
    //$("#customer-group-id").val(getSavedValue("customer-group-id"));

    function saveValue(e) {
        var id = e.id;  // get the sender's id to save it.
        var val = e.value; // get the value.
        localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override.
    }
    //get the saved value function - return the value of "v" from localStorage.
    function getSavedValue  (v){
        if (!localStorage.getItem(v)) {
            return "";// You can change this to your defualt value.
        }
        return localStorage.getItem(v);
    }
</script>
@endpush
