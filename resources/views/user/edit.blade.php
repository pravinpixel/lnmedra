@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Update User')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control" value="{{$lims_user_data->name}}">
                                        @if($errors->has('name'))
                                       <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Change Password')}}</strong> </label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control">
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="{{$lims_user_data->email}}">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" name="phone" required class="form-control" value="{{$lims_user_data->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Date Of Join')}} *</strong></label>
                                        <input type="date" name="join_date" value="{{$lims_user_data->join_date}}" required class="form-control">
                                        @if($errors->has('join_date'))
                                            <span>
                                               <strong>{{ $errors->first('join_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Id Proof')}}</strong></label>
                                        <input type="file" name="id_proof" value="{{$lims_user_data->id_proof}}" class="form-control">
                                        <a href="{{ asset('public/user/id_proof/').'/'.$lims_user_data->id_proof }}" download>Id Proof</a>
                                        @if($errors->has('id_proof'))
                                            <span>
                                               <strong>{{ $errors->first('id_proof') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Address Proof')}}</strong></label>
                                        <input type="file" name="address_proof" class="form-control">
                                        <a href="{{ asset('public/user/address_proof/').'/'.$lims_user_data->address_proof }}" download>Address Proof</a>
                                        @if($errors->has('address_proof'))
                                            <span>
                                               <strong>{{ $errors->first('address_proof') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if($lims_user_data->is_active)
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        @else
                                        <input class="mt-2" type="checkbox" name="is_active" value="1">
                                        @endif
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control" value="{{$lims_user_data->company_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          @foreach($lims_role_list as $role)
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="biller-id">
                                        <label><strong>{{trans('file.Biller')}} *</strong></label>
                                        <input type="hidden" name="biller_id_hidden" value="{{$lims_user_data->biller_id}}">
                                        <select name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                          @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="form-group" id="warehouseId">
                                        <label><strong>{{trans('file.Outlet')}} *</strong></label>
                                        <input type="hidden" name="warehouse_id_hidden" value="{{$lims_user_data->warehouse_id}}">
                                        <select name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                          @foreach($lims_warehouse_list as $warehouse)
                                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                          @endforeach
                                        </select>
                                    </div> -->
                                    <div class="field_wrapper cloneOutlet" id="warehouseId">
                                        <label><strong>{{trans('file.Add Store Outlet')}} *</strong></label>
                                        <a  class="btn btn-primary add_button" title="Add field" >Add</a>
                                        @foreach($outlet_data  as $key=>$val)
                                        <!-- {{$val->outlet_id}} = {{$warehouse->id}} -->
                                        
                                            <div class="form-group" id="warehouseId">
                                            
                                                <input type="hidden" name="warehouse_id_hidden" value="{{$lims_user_data->warehouse_id}}">
                                                <select name="warehouse_id[{{ $key }}]" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                    <option value="{{$warehouse->id}}" <?php echo "{{$val->outlet_id}}" == "{{$warehouse->id}}" ?   "selected" : '' ;?>>{{$warehouse->name}}</option>
                                                @endforeach
                                                </select>

                                                @if($val->is_default == 1)
                                                <input type="radio" name="outlet" checked  value="1" required onclick="setValue('outletIn_{{ $key }}')">
                                                <input type="hidden" name="outletIn[{{ $key }}]" id="outletIn_{{ $key }}" value="0">
                                                @else
                                                <input type="radio" name="outlet"  value="1" required onclick="setValue('outletIn_{{ $key }}')">
                                                <input type="hidden" name="outletIn[{{ $key }}]" id="outletIn_{{ $key }}" value="0">
                                                @endif
                                                <button class="btn btn-danger remove_button" >X</button>
                                                <!-- @foreach($lims_warehouse_list as $key=>$warehouse)
                                                @if($val->outlet_id == $warehouse->id)
                                            
                                                <input type="radio" name="outlet"  checked  value="1" onclick="setValue('outletIn_')">
                                                <input type="hidden" name="outletIn[1]" id="outletIn_{{ $warehouse->id }}" value="0">
                                                <button class="btn btn-danger remove_button" >X</button>
                                                
                                                @endif
                                                @endforeach -->
                                            </div>
                                        
                                        @endforeach
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
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $('#biller-id').hide();
    $('#warehouseId').hide();



    $('select[name=role_id]').val($("input[name='role_id_hidden']").val());
    if($('select[name=role_id]').val()){
        $('#warehouseId').show();
        // $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
        $('#biller-id').show();
        $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
    }
    $('.selectpicker').selectpicker('refresh');

    $('select[name="role_id"]').on('change', function() {
        if($(this).val() > 2){
            $('select[name="warehouse_id"]').prop('required',true);
            $('select[name="biller_id"]').prop('required',true);
            $('#biller-id').show();
            $('#warehouseId').show();
        }
        else{
            $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide();
            $('#warehouseId').hide();
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

    
    

</script>
<script type="text/javascript">
$(document).ready(function(){
  var cnt = {{ $outlet_count }};
//   alert(cnt)
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
    var x = cnt; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            // $(wrapper).append(fieldHTML); //Add field html
            $(wrapper).append(`
            <div class="field_wrapper cloneOutlet" id="warehouseId">
          
            <br>
                    <select name="warehouse_id[${x}]" id="warehouse_id[${x}]" class="selectpicker form-control" data-live-search="true" required title="Select outlet...">
                        @foreach($lims_warehouse_list as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                    <input type="radio" value="1" name="outlet" onclick="setValue('outletIn_${x}')" required>
                    <input type="hidden" name="outletIn[${x}]" id="outletIn_${x}" value="0">
                    <button class="btn btn-danger remove_button" >X</button>
                    <br>
                    </div>
           
            `); //Add field html
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        // $('radio[name="outlet"]').val();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function setValue(e){

    $('#'+e).val(1);
    }

    $('input[name="outlet"]:checked').trigger('click');
</script>
@endpush
