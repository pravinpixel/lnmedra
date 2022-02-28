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
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Supplier</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Password Reset</button>
  </li>
  
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <section class="forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4><strong>{{trans('file.Add Supplier')}}</strong></h4>
                            </div>
                            <div class="card-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                {!! Form::open(['route' => ['supplier.update',$lims_supplier_data->id],'name'=>'vendorForm','id'=>'vendorForm', 'method' => 'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.name')}} *</strong> </label>
                                            <input type="text" name="name" value="{{$lims_supplier_data->name}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                            
                                            <div class="form-group">
                                                <label>{{trans('file.category')}}</strong> </label>
                                                <div class="input-group">
                                                <select name="category" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('category')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins" title="Select Category..." required>
                                                    @foreach($category as $key=>$val)
                                                        <option value="{{$val['id']}}" <?php echo "{{$lims_supplier_data->category}}" == "{{$val['id']}}" ?   "selected" : '' ;?> >{{$val['name']}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            </div>
                                        </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Mobile')}} *</label>
                                            <input type="number" name="phone_number" value="{{$lims_supplier_data->phone_number}}" required class="form-control">
                                            @if($errors->has('phone_number'))
                                            
                                                <span>
                                                    <strong style="color: red;" >{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Email')}} *</label>
                                            <input type="email" name="email" placeholder="example@example.com" value="{{$lims_supplier_data->email}}" required class="form-control">
                                            @if($errors->has('email'))
                                        <span>
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Password')}} *</label>
                                            <input type="password" name="password"value="{{$lims_supplier_data->password}}" required class="form-control">
                                            @if($errors->has('password'))
                                        <span>
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Address')}} *</label>
                                            <input type="text" name="address" value="{{$lims_supplier_data->address}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.City')}} *</label>
                                            <input type="text" name="city"value="{{$lims_supplier_data->city}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.State')}}</label>
                                            <input type="text" name="state" value="{{$lims_supplier_data->state}}"  class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Country')}}</label>
                                            <input type="text" name="country"  value="{{$lims_supplier_data->country}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Postal Code')}}</label>
                                            <input type="text" name="postal_code" value="{{$lims_supplier_data->postal_code}}"  class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div  class="col-md-12">
                                    <div class="card-header d-flex align-items-center">
                                        <h4><strong>{{trans('file.Company Info')}}</strong></h4>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Company Name')}} *</label>
                                            <input type="text" name="company_name"  value="{{$lims_supplier_data->company_name}}"  required class="form-control">
                                            @if($errors->has('company_name'))
                                        <span>
                                            <strong style="color: red;">{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.gst')}}</label>
                                            <input type="number" name="gst" value="{{$lims_supplier_data->gst}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.contact_person')}}</label>
                                            <input type="text" name="contact_person"  value="{{$lims_supplier_data->contact_person}}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.entity_name')}} *</label>
                                            <input type="text" name="entity_name" value="{{$lims_supplier_data->entity_name}}" required class="form-control">
                                            @if($errors->has('entity_name'))
                                        <span>
                                            <strong>{{ $errors->first('entity_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="col-md-12">
                                    <div class="card-header d-flex align-items-center">
                                        <h4><strong>{{trans('file.Bank Info')}}</strong></h4>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Bank Name')}} *</label>
                                            <input type="text" name="bank_name"  value="{{$lims_supplier_data->bank_name}}" required class="form-control">
                                            @if($errors->has('bank_name'))
                                        <span>
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Account No')}}</label>
                                            <input type="text" name="account_no"  value="{{$lims_supplier_data->account_no}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.IFS Code')}}</label>
                                            <input type="text" name="ifs_code"  value="{{$lims_supplier_data->ifs_code}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Branch')}}</label>
                                            <input type="text" name="branch"  value="{{$lims_supplier_data->branch}}" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.VAT Number')}}</label>
                                            <input type="text" name="vat_number" class="form-control">
                                        </div>
                                    </div> -->
                                
                                
                                
                                    <div class="col-md-6">
                                        <div class="form-group mt-4">
                                            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group mt-4">
                                        <a href=" {{ route('supplier.vendor-password', $lims_supplier_data->id) }}" class="forgot-pass">{{trans('file.Vendor Reset Password?')}}</a>
                                        </div>
                                    </div> -->
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  </div>
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <section class="forms">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4><strong>{{trans('file.Password Reset')}}</strong></h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                        {!! Form::open(['route' => ['supplier.vendor-reset-password',$lims_supplier_data->id],'name'=>'vendorPasswordForm','id'=>'vendorPasswordForm', 'method' => 'put', 'files' => true]) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{trans('file.New Password')}} *</strong> </label>
                                                    <input type="password" name="new_password" value="" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{trans('file.Confirm Password')}} *</strong> </label>
                                                    <input type="password" name="confirm_password" value="" required class="form-control">
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
</div>
 
</div>




@endsection

@push('scripts')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

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
                        'phone_number': {
                            required: true,
                            number: true,
                            minlength: 10,
                            maxlength: 10
                        },
                        
                        'email': {
                            required: true,
                            email: true
                        },
                        'company_name': {
                            required: true,
                            maxlength: 200
                        },
                        
                    
                    },
                   
                }); 

                $("#vendorPasswordForm").validate({
                    
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
