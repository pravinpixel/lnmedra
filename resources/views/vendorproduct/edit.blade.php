@extends('layout.main')

@section('content')

<section class="forms">
    <div class="container-fluid">
        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
         
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>{{trans('file.Update Product')}}</h4>
            </div>
            <div class="card-body">
                <form id="product-form">
                    <input type="hidden" name="id" value="{{$lims_product_data->id}}" >
                    <input type="hidden" name="dashboardView" value="{{$lims_product_data->dashboardView}}" >
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                    <input type="hidden" name="vendoruserid" id="vendoruserid" value="{{ Auth::id() }}">
                                <label>{{trans('file.Product Type')}} *</strong> </label>
                                <div class="input-group">
                                <select name="type" required class="form-control selectpicker"  data-live-search="true" data-live-search-style="begins" id="productType">
                                    <option value="">--Select--</option>
                                        @foreach($productType as $product)
                                        <option value="{{ $product->id }}" >{{ $product->name }}</option>
                                        @endforeach
                                        <!-- <option value="standard">Standard</option>
                                        <option value="combo">Combo</option>
                                        <option value="digital">Digital</option>
                                        <option value="service">Service</option> -->
                                    </select>
                                    <input type="hidden" name="type_hidden" value="{{$lims_product_data->type}}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="attributeInput" value="{{$lims_product_data->attribute}}"  id="attributeInput" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Name')}} *</strong> </label>
                                <input type="text" name="name" value="{{$lims_product_data->name}}" required class="form-control">
                                <span class="validation-msg" id="name-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Product Code')}} *</strong> </label>
                                <div class="input-group">
                                    <input type="text" name="code" id="code" value="{{$lims_product_data->code}}" class="form-control" required>
                                    <div class="input-group-append">
                                        <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <span class="validation-msg" id="code-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4" id="attribute_div">
                            <div class="form-group">
                                <label>{{trans('file.Attribute')}} *</strong> </label>
                                
                                <div id="attribute_img" >
                                    
                                </div> 
                            </div>
                        </div>
                        <div id="digital" class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('file.Attach File')}}</strong> </label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <span class="validation-msg"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('file.Brand')}}</strong> </label>
                                <div class="input-group">
                                    <input type="hidden" name="brand" value="{{ $lims_product_data->brand_id}}">
                                    <select name="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                    @foreach($lims_brand_list as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="category" value="{{$lims_product_data->category_id}}">
                                <label>{{trans('file.category')}} *</strong> </label>
                                <div class="input-group">
                                    <select name="category_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                    
                                    @foreach($lims_category_list as $category)
                                        @if($category->parent_id == '' || null)
                                            <option value="{{$category->id}}" class="option_parent">{{$category->name}}</option>
                                            @foreach($lims_category_list as $subcategory)
                                            @if($category->id == $subcategory->parent_id)
                                            <option value="{{$subcategory->id}}" class="option_sub">&nbsp - {{$subcategory->name}}</option>    
                                            @endif    
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div id="alert-qty" class="col-md-2">
                            <div class="form-group">
                                <label>{{trans('file.Quantity')}}</strong> </label>
                                <input type="number" name="qty" value="{{ $lims_product_data->qty }}" class="form-control" step="any">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('file.Product Price')}} *</strong> </label>
                                <input type="number" name="price" value="{{$lims_product_data->price}}" required class="form-control" step="any">
                                <span class="validation-msg"></span>
                            </div>
                            
                        </div>
                        
                        
                        
                        
                        <div class="col-md-12">
                            <div class="form-groups">
                                <label>{{trans('file.Product Image')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                                <div id="imageUpload" class="dropzone"></div>
                                <span class="validation-msg" id="image-error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><button type="button" class="btn btn-sm"><i class="fa fa-list"></i></button></th>
                                            <th>Image</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $images = explode(",", $lims_product_data->image)?>
                                        @foreach($images as $key => $image)
                                        <tr>
                                            <td class="text-center"><button type="button" class="btn btn-sm"><i class="fa fa-list"></i></button></i></td>
                                            <td class="text-center">
                                                <img src="{{url('public/images/product', $image)}}" height="60" width="60">
                                                <input type="hidden" name="prev_img[]" value="{{$image}}">
                                            </td>
                                            <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-img">X</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('file.Product Details')}}</label>
                                <textarea name="product_details" class="form-control" rows="5">{{str_replace('@', '"', $lims_product_data->product_details)}}</textarea>
                            </div>
                        </div>
                        

                        <div class="col-md-12">
                            <div class="text-right mt-3">
                                <input type="button" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

$('#productType').trigger('change');

});
    // $("ul#vendorproduct").siblings('a').attr('aria-expanded','true');
    // $("ul#vendorproduct").addClass("show");
    var product_id = <?php echo json_encode($lims_product_data->id) ?>;
    var is_batch = <?php echo json_encode($lims_product_data->is_batch) ?>;
    var is_variant = <?php echo json_encode($lims_product_data->is_variant) ?>;
    var baseUrl = $('#baseUrl').val();
    $('[data-toggle="tooltip"]').tooltip();

    $(".remove-img").on("click", function () {
        $(this).closest("tr").remove();
    });



    
    $("#digital").hide();
    $("#combo").hide();
    $("select[name='type']").val($("input[name='type_hidden']").val());
    variantShowHide();
    diffPriceShowHide();
    if(is_batch)
        $("#variant-option").hide();
    if(is_variant) {
        $("#batch-option").hide();
    }


    $('#productType').on('change', function() {
        
        // alert($('#type_id').val());
         var typeId = $(this).val();
         
         $.ajax({
              type: 'GET',
            //   url: 'get-attribute-image/' + typeId,
              url: baseUrl +'/vendorproducts/get-edit-attribute-image'+'/' + typeId,
             data:{
                 data:$('#attributeInput').val()
             },
              success: function(res) {
                  $('#attribute_img').html('');
                //   alert(res.data.length)
                  if(res.data.length){
              
                 for(var i=0;i<res.data.length;i++)
                 {
                  let att = res.data[i];
                  console.log(res.data[i].id);
                  $('#attribute_img').append(`
                  ${res.data[i].checkbox} 
                  ${res.data[i].image}     
                  `)
                 }  
                }
                else{
                    $('#attribute_div').hide();
                }
              }
          });
  });

    if($("input[name='type_hidden']").val() == "digital"){
        $("input[name='cost']").prop('required',false);
        $("select[name='unit_id']").prop('required',false);
        hide();
        $("#digital").show();
    }
    else if($("input[name='type_hidden']").val() == "service"){
        $("input[name='cost']").prop('required',false);
        $("select[name='unit_id']").prop('required',false);
        hide();
        $("#variant-section, #variant-option").hide();
    }
    else if($("input[name='type_hidden']").val() == "combo"){
        $("input[name='cost']").prop('required', false);
        $("input[name='price']").prop('disabled', true);
        $("select[name='unit_id']").prop('required', false);
        hide();
        $("#combo").show();
    }

    var promotion = $("input[name='promotion_hidden']").val();
    if(promotion){
        $("input[name='promotion']").prop('checked', true);
        $("#promotion_price").show(300);
        $("#start_date").show(300);
        $("#last_date").show(300);
    }
    else {
        $("#promotion_price").hide(300);
        $("#start_date").hide(300);
        $("#last_date").hide(300);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../gencode', function(data){
        $("input[name='code']").val(data);
      });
    });

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });

    tinymce.init({
      selector: 'textarea',
      height: 130,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
      branding:false
    });

    var barcode_symbology = $("input[name='barcode_symbology_hidden']").val();
    $('select[name=barcode_symbology]').val(barcode_symbology);

    var brand = $("input[name='brand']").val();
    $('select[name=brand_id]').val(brand);

    var cat = $("input[name='category']").val();
    $('select[name=category_id]').val(cat);

    if($("input[name='unit']").val()) {
        $('select[name=unit_id]').val($("input[name='unit']").val());
        populate_unit($("input[name='unit']").val());
    }

    var tax = $("input[name='tax']").val();
    if(tax)
        $('select[name=tax_id]').val(tax);

    var tax_method = $("input[name='tax_method_id']").val();
    $('select[name=tax_method]').val(tax_method);
    $('.selectpicker').selectpicker('refresh');




    $('select[name="type"]').on('change', function() {
        if($(this).val() == 'combo'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            hide();
            $("#digital").hide();
            $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
            $("#combo").show();
            $("input[name='price']").prop('disabled',true);
        }
        else if($(this).val() == 'digital'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            $("input[name='file']").prop('required',true);
            hide();
            $("#combo").hide();
            $("#digital").show();
            $("#variant-section, #variant-option, #diffPrice-option, #diffPrice-section").hide(300);
            $("input[name='price']").prop('disabled',false);
        }
        else if($(this).val() == 'service') {
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            $("input[name='file']").prop('required',true);
            hide();
            $("#combo").hide(300);
            $("#digital").hide(300);
            $("input[name='price']").prop('disabled',false);
            $("#is-variant").prop("checked", false);
            $("#variant-section, #variant-option").hide(300);
        }
        else if($(this).val() == 'standard'){
            $("input[name='cost']").prop('required',true);
            $("select[name='unit_id']").prop('required',true);
            $("input[name='file']").prop('required',false);
            $("#cost").show();
            $("#unit").show();
            $("#alert-qty").show();
            $("#variant-option").show(300);
            $("#diffPrice-option").show(300);
            $("#digital").hide();
            $("#combo").hide();
            $("input[name='price']").prop('disabled',false);
        }
    });

    $('select[name="unit_id"]').on('change', function() {
        unitID = $(this).val();
        if(unitID) {
            populate_unit_second(unitID);
        }else{
            $('select[name="sale_unit_id"]').empty();
            $('select[name="purchase_unit_id"]').empty();
        }
    });

    <?php $productArray = []; ?>


    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(lims_product_code, function(item) {
                return matcher.test(item);
            }));
        },
        select: function(event, ui) {
            var data = ui.item.value;
            $.ajax({
                type: 'GET',
                url: '../lims_product_search',
                data: {
                    data: data
                },
                success: function(data) {
                    //console.log(data);
                    var flag = 1;
                    $(".product-id").each(function() {
                        if ($(this).val() == data[8]) {
                            alert('Duplicate input is not allowed!')
                            flag = 0;
                        }
                    });
                    $("input[name='product_code_name']").val('');
                    if(flag){
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + data[0] +' [' + data[1] + ']</td>';
                        cols += '<td><input type="number" class="form-control qty" name="product_qty[]" value="1" step="any"/></td>';
                        cols += '<td><input type="number" class="form-control unit_price" name="unit_price[]" value="' + data[2] + '" step="any"/></td>';
                        cols += '<td><button type="button" class="ibtnDel btn btn-sm btn-danger">X</button></td>';
                        cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[8] + '"/>';
                        cols += '<input type="hidden" class="" name="variant_id[]" value="' + data[9] + '"/>';

                        newRow.append(cols);
                        $("table.order-list tbody").append(newRow);
                        calculate_price();
                    }
                }
            });
        }
    });

    //Change quantity or unit price
    $("#myTable").on('input', '.qty , .unit_price', function() {
        calculate_price();
    });

    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        calculate_price();
    });

    function calculate_price() {
        var price = 0;
        $(".qty").each(function() {
            rowindex = $(this).closest('tr').index();
            quantity =  $(this).val();
            unit_price = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .unit_price').val();
            price += quantity * unit_price;
        });
        $('input[name="price"]').val(price);
    }

    function hide() {
        $("#cost").hide();
        $("#unit").hide();
        $("#alert-qty").hide();
    }

    function populate_unit(unitID){
        $.ajax({
            url: '../saleunit/'+unitID,
            type: "GET",
            dataType: "json",

            success:function(data) {
                  $('select[name="sale_unit_id"]').empty();
                  $('select[name="purchase_unit_id"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="sale_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                      $('select[name="purchase_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('.selectpicker').selectpicker('refresh');
                  var sale_unit = $("input[name='sale_unit']").val();
                  var purchase_unit = $("input[name='purchase_unit']").val();
                $('#sale-unit').val(sale_unit);
                $('select[name=purchase_unit_id]').val(purchase_unit);
                $('.selectpicker').selectpicker('refresh');
            },
        });
    }

    function populate_unit_second(unitID){
        $.ajax({
            url: '../saleunit/'+unitID,
            type: "GET",
            dataType: "json",
            success:function(data) {
                  $('select[name="sale_unit_id"]').empty();
                  $('select[name="purchase_unit_id"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="sale_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                      $('select[name="purchase_unit_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });
                  $('.selectpicker').selectpicker('refresh');
            },
        });
    };

    $("input[name='is_batch']").on("change", function () {
        if ($(this).is(':checked')) {
            $("#variant-option").hide(300);
        }
        else
            $("#variant-option").show(300);
    });

    $("input[name='is_variant']").on("change", function () {
        variantShowHide();
    });

    $("input[name='is_diffPrice']").on("change", function () {
        diffPriceShowHide();
    });

    $("input[name='variant']").on("input", function () {
        if($("#code").val() == ''){
            $("input[name='variant']").val('');
            alert('Please fillup above information first.');
        }
        else if($(this).val().indexOf(',') > -1) {
            var variant_name = $(this).val().slice(0, -1);
            var item_code = variant_name+'-'+$("#code").val();
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td style="cursor:grab"><i class="dripicons-view-apps"></i><input type="hidden" name="product_variant_id[]" value="0"></td>';
            cols += '<td><input type="text" class="form-control" name="variant_name[]" value="' + variant_name + '" /></td>';
            cols += '<td><input type="text" class="form-control" name="item_code[]" value="'+item_code+'" /></td>';
            cols += '<td><input type="number" class="form-control" name="additional_price[]" value="" step="any" /></td>';
            cols += '<td><button type="button" class="vbtnDel btn btn-sm btn-danger">X</button></td>';

            $("input[name='variant']").val('');
            newRow.append(cols);
            $("table.variant-list tbody").append(newRow);
        }
    });

    //Delete variant
    $("table#variant-table tbody").on("click", ".vbtnDel", function(event) {
        $(this).closest("tr").remove();
    });

    function variantShowHide() {
         if ($("#is-variant").is(':checked')) {
            $("#variant-section").show(300);
            $("#batch-option").hide(300);
        }
        else {
            $("#variant-section").hide(300);
            $("#batch-option").show(300);
        }
    };

    function diffPriceShowHide() {
         if ($("#is-diffPrice").is(':checked')) {
            $("#diffPrice-section").show(300);
        }
        else {
            $("#diffPrice-section").hide(300);
        }
    };

    $( "#promotion" ).on( "change", function() {
        if ($(this).is(':checked')) {
            $("#promotion_price").show();
            $("#start_date").show();
            $("#last_date").show();
        }
        else {
            $("#promotion_price").hide();
            $("#start_date").hide();
            $("#last_date").hide();
        }
    });

    var starting_date = $('#starting_date');
    starting_date.datepicker({
     format: "dd-mm-yyyy",
     startDate: "<?php echo date('d-m-Y'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    var ending_date = $('#ending_date');
    ending_date.datepicker({
     format: "dd-mm-yyyy",
     startDate: "<?php echo date('d-m-Y'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    //dropzone portion
    Dropzone.autoDiscover = false;

    jQuery.validator.setDefaults({
        errorPlacement: function (error, element) {
            if(error.html() == 'Select Category...')
                error.html('This field is required.');
            $(element).closest('div.form-group').find('.validation-msg').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('div.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('div.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('div.form-group').find('.validation-msg').html('');
        }
    });

    function validate() {
        var product_code = $("input[name='code']").val();
        var barcode_symbology = $('select[name="barcode_symbology"]').val();
        var exp = /^\d+$/;

        if(!(product_code.match(exp)) && (barcode_symbology == 'UPCA' || barcode_symbology == 'UPCE' || barcode_symbology == 'EAN8' || barcode_symbology == 'EAN13') ) {
            alert('Product code must be numeric.');
            return false;
        }
        else if(product_code.match(exp)) {
            if(barcode_symbology == 'UPCA' && product_code.length > 11){
                alert('Product code length must be less than 12');
                return false;
            }
            else if(barcode_symbology == 'EAN8' && product_code.length > 7){
                alert('Product code length must be less than 8');
                return false;
            }
            else if(barcode_symbology == 'EAN13' && product_code.length > 12){
                alert('Product code length must be less than 13');
                return false;
            }
        }

        if( $("#type").val() == 'combo' ) {
            var rownumber = $('table.order-list tbody tr:last').index();
            if (rownumber < 0) {
                alert("Please insert product to table!")
                return false;
            }
        }
        $("input[name='price']").prop('disabled',false);
        return true;
    }

    $("table#variant-table tbody").sortable({
        items: 'tr',
        cursor: 'grab',
        opacity: 0.5,
    });

    $(".dropzone").sortable({
        items:'.dz-preview',
        cursor: 'grab',
        opacity: 0.5,
        containment: '.dropzone',
        distance: 20,
        tolerance: 'pointer',
        stop: function () {
          var queue = myDropzone.getAcceptedFiles();
          newQueue = [];
          $('#imageUpload .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {
                var name = el.innerHTML;
                queue.forEach(function(file) {
                    if (file.name === name) {
                        newQueue.push(file);
                    }
                });
          });
          myDropzone.files = newQueue;
        }
    });

    myDropzone = new Dropzone('div#imageUpload', {
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFilesize: 12,
        paramName: 'image',
        clickable: true,
        method: 'POST',
        url:'../update',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            var myDropzone = this;
            $('#submit-btn').on("click", function (e) {
                e.preventDefault();
                if ( $("#product-form").valid() && validate() ) {
                    tinyMCE.triggerSave();
                    if(myDropzone.getAcceptedFiles().length) {
                        myDropzone.processQueue();
                    }
                    else {
                        $.ajax({
                            type:'POST',
                            url:'../update',
                            data: $("#product-form").serialize(),
                            success:function(response){

                                var data = response.data.dashboardView;
                       
                                if(data == 1){
                           
                                    location.href = '{{ route('vendor-dashboard') }}';
                                   
                                }else if(data == null){
                                    location.href = '{{ route('vendorproducts.index') }}';
                                    
                                }
                               
                            },
                            error:function(response) {
                                //console.log(response);
                              if(response.responseJSON.errors.name) {
                                  $("#name-error").text(response.responseJSON.errors.name);
                              }
                              else if(response.responseJSON.errors.code) {
                                  $("#code-error").text(response.responseJSON.errors.code);
                              }
                            },
                        });
                    }
                }
            });

            this.on('sending', function (file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $("#product-form").serializeArray();
                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });
            });
        },
        error: function (file, response) {
            console.log(response);
            /*if(response.errors.name) {
              $("#name-error").text(response.errors.name);
              this.removeAllFiles(true);
            }
            else if(response.errors.code) {
              $("#code-error").text(response.errors.code);
              this.removeAllFiles(true);
            }
            else {
              try {
                  var res = JSON.parse(response);
                  if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
                      $("#success-icon").attr("class", "fas fa-thumbs-down");
                      $("#success-text").html(res.message);
                      $modal.modal("show");
                  } else {
                      if ($.type(response) === "string")
                          var message = response; //dropzone sends it's own error messages in string
                      else
                          var message = response.message;
                      file.previewElement.classList.add("dz-error");
                      _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                      _results = [];
                      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                          node = _ref[_i];
                          _results.push(node.textContent = message);
                      }
                      return _results;
                  }
              } catch (error) {
                  console.log(error);
              }
            }*/
        },
        successmultiple: function (file, response) {
            location.href = '../';
            //console.log('sss: '+ response);
        },
        completemultiple: function (file, response) {
            console.log(file, response, "completemultiple");
        },
        reset: function () {
            console.log("resetFiles");
            this.removeAllFiles(true);
        }
    });

</script>
@endpush
