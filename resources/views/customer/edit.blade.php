@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
    <p  class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
        {!! Form::open(['route' => ['customer.update',$lims_customer_data->id], 'method' => 'put', 'files' => true]) !!}
            <div class="card shadow">
            <div class="custom-card-header">
                    <h4>{{trans('file.Basic Information')}}</h4>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="customer_group" value="{{$lims_customer_data->customer_group_id}}">
                                <label>{{trans('file.Customer Group')}} *</strong> </label>
                                <select required class="form-control selectpicker" name="customer_group_id">
                                    @foreach($lims_customer_group_all as $customer_group)
                                        <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.name')}} *</strong> </label>
                                <input type="text" name="customer_name" value="{{$lims_customer_data->name}}" required class="form-control capitalize">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Company Name')}} </label>
                                <input type="text" name="company_name" value="{{$lims_customer_data->company_name}}" class="form-control">
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Email')}}</label>
                                <input type="email" name="email" value="{{$lims_customer_data->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Phone Number')}} *</label>
                                <input type="text" name="phone_number" required value="{{$lims_customer_data->phone_number}}" class="form-control">
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
                                    <select name="requirement" class="selectpicker form-control @error('type') is-invalid @enderror" value="{{old('requirement')}}"  autocomplete="type" data-live-search="true" data-live-search-style="begins"  required>
                                        <option value="1" <?php echo "$lims_customer_data->requirement" == "1" ?   "selected" : '' ;?> >Landscape design</option>
                                        <option value="2" <?php echo "$lims_customer_data->requirement" == "2" ?   "selected" : '' ;?> >Landscape execution</option>
                                        <option value="3" <?php echo "$lims_customer_data->requirement" == "3" ?   "selected" : '' ;?> >Retail sale</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Tax Number')}}</label>
                                <input type="text" name="tax_no" class="form-control" value="{{$lims_customer_data->tax_no}}">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Address')}} </label>
                                <input type="text" name="address" value="{{$lims_customer_data->address}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.City')}} </label>
                                <input type="text" name="city"  value="{{$lims_customer_data->city}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.State')}}</label>
                                <input type="text" name="state" value="{{$lims_customer_data->state}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Postal Code')}}</label>
                                <input type="text" name="postal_code" value="{{$lims_customer_data->postal_code}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Country')}}</label>
                                <input type="text" name="country" value="{{$lims_customer_data->country}}" class="form-control">
                            </div>
                        </div>
                        {{-- @if(!$lims_customer_data->user_id)
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>{{trans('file.Add User')}}</label>&nbsp;
                                <input type="checkbox" name="user" value="1" />
                            </div>
                        </div>
                        @endif --}}
                    
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
                    </div> 
                </div>
            </div>
            <div class="card shadow">
                <div class="custom-card-header">
                    <h4>{{trans('file.Additional Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row m-0"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="italic"><small>{{trans('file.Your Birth Day Date')}}.</small></p>
                                <input type="date" value="{{$lims_customer_data->customer_dob}}" id="customer_dob" name="customer_dob" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="italic"><small>{{trans('file.Your Marriage Date')}}.</small></p>
                                <input type="date"  value="{{$lims_customer_data->customer_marry_date}}" name="marriage_date" id="marriage_date" class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('file.Remark')}}</label>
                                <textarea class="form-control" value="{{$lims_customer_data->remark}}" name="remark" id="remark" style="height: 100px;" >{{$lims_customer_data->remark}}</textarea>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
            <div class="text-right">
                <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
        {!! Form::close() !!}
    </div>
</section>


@endsection

@push('scripts')
<style>
   .capitalize{
  text-transform: capitalize;
 
}
</style>
<script type="text/javascript">

    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");

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

    var customer_group = $("input[name='customer_group']").val();
    $('select[name=customer_group_id]').val(customer_group);
</script>
@endpush
