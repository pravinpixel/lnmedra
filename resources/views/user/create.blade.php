@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@elseif(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center bg-success text-white">
                        <h4>{{trans('file.Add User')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'user.store', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control">
                                        @if($errors->has('name'))
                                       <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Password')}} *</strong> </label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" required class="form-control">
                                            <div class="input-group-append">
                                                <button   id="togglePassword" type="button" class="btn btn-default"><i id="icon-eye" class="fa fa-eye-slash "></i></button>
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                            @if($errors->has('password'))
                                            <span>
                                               <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" pattern="{{ config('global.email_pattern') }}" name="email" placeholder="example@example.com" required class="form-control">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" onkeypress="return isNumber(event)" name="phone_number" required class="form-control">
                                        @if($errors->has('phone_number'))
                                            <span>
                                               <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Date Of Join')}} *</strong></label>
                                        <input type="date" name="join_date" required class="form-control">
                                        @if($errors->has('join_date'))
                                            <span>
                                               <strong>{{ $errors->first('join_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Id Proof')}}</strong></label>
                                        <input type="file" name="id_proof" class="form-control">
                                        @if($errors->has('id_proof'))
                                            <span>
                                               <strong>{{ $errors->first('id_proof') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Address Proof')}}</strong></label>
                                        <input type="file" name="address_proof" class="form-control">
                                        @if($errors->has('address_proof'))
                                            <span>
                                               <strong>{{ $errors->first('address_proof') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="customer-section">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Address')}} *</strong></label>
                                            <input type="text" name="address" class="form-control customer-input">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.State')}}</strong></label>
                                            <input type="text" name="state" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Country')}}</strong></label>
                                            <input type="text" name="country" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          @foreach($lims_role_list as $role)
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="customer-section">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Customer Group')}} *</strong></label>
                                            <select name="customer_group_id" class="selectpicker form-control customer-input" data-live-search="true" data-live-search-style="begins" title="Select customer_group...">
                                              @foreach($lims_customer_group_list as $customer_group)
                                                  <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.name')}} *</strong></label>
                                            <input type="text" name="customer_name" class="form-control customer-input">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Tax Number')}}</strong></label>
                                            <input type="text" name="tax_number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.City')}} *</strong></label>
                                            <input type="text" name="city" class="form-control customer-input">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Postal Code')}}</strong></label>
                                            <input type="text" name="postal_code" class="form-control">
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="form-group" id="biller-id">
                                        <label><strong>{{trans('file.Biller')}} *</strong></label>
                                        <select name="biller_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                          @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="form-group" id="warehouseId">
                                        <label><strong>{{trans('file.Outlet')}} *</strong></label>
                                        <select name="warehouse_id[]" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select outlet...">
                                          @foreach($lims_warehouse_list as $warehouse)
                                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                          @endforeach
                                        </select>
                                        <input type="checkbox" name="outlet">
                                    </div> -->
                                  
                                    <!-- <div class="field_wrapper" id="warehouseId">
                                        <label><strong>{{trans('file.Add Store Outlet')}} *</strong></label>
                                        <a  class="btn btn-primary add_button" title="Add field" >Add</a>
                                        <select name="warehouse_id[1]" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select outlet...">
                                          @foreach($lims_warehouse_list as $warehouse)
                                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                          @endforeach
                                        </select>
                                        <input type="radio" name="outlet"  value="1" required onclick="setValue('1')">
                                        <input type="hidden" name="outletIn[1]" id="outletIn_1" >
                                        <input type="hidden" name="selected_outlet" id="selected_outlet">
                                    </div> -->

                                    <ul class="list-group field_wrapper" id="warehouseId">
                                        <label><strong>{{trans('file.Add Store Outlet')}} *</strong></label>
                                        <li class="list-group-item border-0 p-0 mb-3">
                                            <a  class="btn btn-primary add_button" title="Add field" >Add</a>
                                        </li>
                                        <li class="list-group-item d-flex w-100 align-items-center rounded p-0 my-2">
                                            <select name="warehouse_id[1]"  class="selectpicker form-control border-0" data-live-search="true" data-live-search-style="begins" title="Select outlet..." required>
                                                @foreach($lims_warehouse_list as $warehouse)
                                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="btn btn-light border-0">
                                                <input type="radio" name="outlet"  value="1"  onclick="setValue('1')" required>
                                                <input type="hidden" name="outletIn[1]" id="outletIn_1" >
                                                <input type="hidden" name="selected_outlet" id="selected_outlet">
                                            </div>
                                        </li>
                                    </ul>
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


    const password = document.querySelector("#password");

    $(document).on('click', '#togglePassword', function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        if(type == 'password'){
            $('#icon-eye').addClass('fa-eye-slash')
            $('#icon-eye').removeClass('fa-eye')
        } else {
            $('#icon-eye').removeClass('fa-eye-slash')
            $('#icon-eye').addClass('fa-eye')
        }
 
    });


    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #user-menu").addClass("active");

    $('#warehouseId').hide();
    $('#biller-id').hide();
    $('.customer-section').hide();

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });

    $('#genbutton').on("click", function(){
      $.get('genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

    $('select[name="role_id"]').on('change', function() {
        // alert($(this).val())
        $("input[name='outlet']").trigger("click");
        $('.cloneOutlet').remove();
        if($(this).val() == 5) {
            $('#biller-id').hide(300);
            $('#warehouseId').hide(300);
            $('.customer-section').show(300);
            $('.customer-input').prop('required',true);
            // $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
        }
        else if($(this).val() == 1) {
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide();
            $('#warehouseId').hide();
            $('select[name="warehouse_id[1]"]').prop('required',false);
            // $('input[name="outlet"]').prop('required',false);
            $('.customer-section').hide(300);
            $('.customer-input').prop('required',false);
        }
        else if($(this).val() !=5 ){
            
            $('select[name="warehouse_id"]').prop('required',true);
            $('#warehouseId').show(300);
            
            if($(this).val() > 2 && $(this).val() != 5)
            {
                $('select[name="biller_id"]').prop('required',true);
                $('#biller-id').show(300);
                // $('#warehouseId').show(300);
                $('.customer-section').hide(300);
                $('.customer-input').prop('required',false);
            }
            else if($(this).val() == 2){
                // alert();
                $('select[name="biller_id"]').prop('required',false);
                $('#biller-id').hide();
                $('#warehouseId').hide();
                $('select[name="warehouse_id[1]"]').prop('required',false);
                // $('#warehouse_span').hide();
            
                $('.customer-section').hide(300);
                $('.customer-input').prop('required',false);
            }
        }
        
        else if($(this).val() > 2 && $(this).val() != 5) {
            // $('select[name="warehouse_id"]').prop('required',true);
            $('select[name="biller_id"]').prop('required',true);
            $('#biller-id').show(300);
            // $('#warehouseId').show(300);
            $('.customer-section').hide(300);
            $('.customer-input').prop('required',false);
        }
        else {
            // $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide(300);
            
            // $('#warehouseId').hide(300);
            $('.customer-section').hide(300);
            $('.customer-input').prop('required',false);
        }
    });


</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(`

            <li class="list-group-item d-flex w-100 align-items-center rounded p-0 my-2 field_wrapper cloneOutlet" id="warehouseId">
                    <select name="warehouse_id[${x}]" id="warehouse_id[${x}]" required class="selectpicker form-control border-0" data-live-search="true" data-live-search-style="begins" title="Select outlet...">
                        @foreach($lims_warehouse_list as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                    <div class="btn btn-light border-0">
                        <input type="radio" value="1" name="outlet" onclick="setValue('${x}')" required>
                        <input type="hidden" name="outletIn[${x}]" id="outletIn_${x}">
                    </div>
                    <button class="btn btn-danger remove_button" >X</button>
                </li>
            `); //Add field html
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('li').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function setValue(e){
// alert(e)
$('#outletIn_'+e).val(1);
$("#selected_outlet").val(e);
}

</script>
@endpush
