@extends('layout.main') @section('content')
 
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="d-flex align-items-center col">
                        <div class="mr-3">Type</div>
                        <select id="product_id" name="product_id" class="selectpicker form-control w-100" data-live-search="true" title="Select Product Type.." data-live-search-style="begins" >
                            @foreach($lims_productType_list as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center col">
                        <div class="mr-3">{{trans('file.category')}}</div>
                        <select id="category_id" name="category_id" class="selectpicker form-control w-100" data-live-search="true" title="Select Category.." data-live-search-style="begins" >
                            @foreach($lims_category_list as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center col">
                        <div class="mr-3">{{trans('file.Brand')}}</div>
                        <select id="brand_id" name="brand_id" class="selectpicker form-control w-100" data-live-search="true" title="Select Brand.." data-live-search-style="begins" >
                            @foreach($lims_brand_list as $brand)
                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1 p-0">
                        <button title="Search" class="btn btn-primary shadow-sm"  onclick="filter()" id="filter-btn" type="submit"><i class="fa fa-search"></i></button>
                        <button title="Reset " class="btn btn-light border text-secondary" onclick="filterReset()" id="filter-btn" type="submit"><i class="fa fa-undo"></i></button>
                    </div> 
                </div>
            </div>
        </div>

        <div class="my-4 text-right">
            @if(userHasAccess('products-add'))
                <a href="{{route('products.create')}}" class="btn btn-info "><i class="dripicons-plus"></i> {{__('file.add_product')}}</a>
            @endif
            @if(userHasAccess('product_import'))
                <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary  ml-auto"><i class="dripicons-copy"></i> {{__('file.import_product')}}</a>
            @endif 
        </div>
        <div class="card pb-3">
            <div class="table-responsive">
                <table id="product-data-table" class="table custom table-hover table-centered" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="not-exported"></th>
                            <th>{{trans('file.Image')}}</th>
                            <th>{{trans('file.name')}}</th>
                            <th>{{trans('file.Code')}}</th>
                            <th>{{trans('file.Brand')}}</th>
                            <th>{{trans('file.category')}}</th>
                            <th>{{trans('file.Quantity')}}</th>
                            <th>{{trans('file.Unit')}}</th>
                            <th>{{trans('file.Price')}}</th>
                            <th>{{trans('file.Cost')}}</th>
                            {{-- <th>Stock Worth</th> --}}
                            <th>{{trans('file.status')}}</th>
                            <th class="not-exported">{{trans('file.action')}}</th>
                        </tr>
                    </thead>
        
                </table>
            </div>
        </div>
    </div>
</section>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'product.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (image, name*, code*, type*, brand, category*, unit_code*, cost*, price*, product_details, variant_name, item_code, additional_price) {{trans('file.and you must follow this')}}.</p>
           <p>{{trans('file.To display Image it must be stored in')}} public/images/product {{trans('file.directory')}}. {{trans('file.Image name must be same as product name')}}</p>
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required', 'accept' =>'.csv'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="public/sample_file/sample_products.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
           </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('Product Details')}}</h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5" id="slider-content"></div>
                <div class="col-md-5 offset-1" id="product-content"></div>
                <div class="col-md-12 mt-2" id="product-warehouse-section">
                    <h5>{{trans('file.Warehouse Quantity')}}</h5>
                    <table class="table table-bordered table-hover product-warehouse-list">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 mt-2" id="product-variant-warehouse-section">
                    <h5>{{trans('file.Warehouse quantity of product variants')}}</h5>
                    <table class="table table-bordered table-hover product-variant-warehouse-list">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <h5 id="combo-header"></h5>
            <table class="table table-bordered table-hover item-list">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>



@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var baseUrl = $('#baseUrl').val();
    $("ul#product").siblings('a').attr('aria-expanded','true');
    $("ul#product").addClass("show");
    $("ul#product #product-list-menu").addClass("active");

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    var warehouse = [];
    var variant = [];
    var qty = [];
    var htmltext;
    var slidertext;
    var product_id = [];
    var all_permission = <?php echo json_encode($all_permission) ?>;
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#select_all" ).on( "change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']").prop('checked', true);
        }
        else {
            $("tbody input[type='checkbox']").prop('checked', false);
        }
    });

    $(document).on("click", "tr.product-link td:not(:first-child, :last-child,:nth-child(11))", function() {
        productDetails( $(this).parent().data('product'), $(this).parent().data('imagedata') );
    });

    $(document).on("click", ".view", function(){
        var product = $(this).parent().parent().parent().parent().parent().data('product');
        var imagedata = $(this).parent().parent().parent().parent().parent().data('imagedata');
        productDetails(product, imagedata);
    });

    $("#print-btn").on("click", function() {
          var divToPrint=document.getElementById('product-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    function productDetails(product, imagedata) {
        product[11] = product[11].replace(/@/g, '"');
        htmltext = slidertext = '';

        htmltext = '<p><strong>{{trans("file.Type")}}: </strong>'+product[0]+'</p><p><strong>{{trans("file.name")}}: </strong>'+product[1]+'</p><p><strong>{{trans("file.Code")}}: </strong>'+product[2]+ '</p><p><strong>{{trans("file.Brand")}}: </strong>'+product[3]+'</p><p><strong>{{trans("file.category")}}: </strong>'+product[4]+'</p><p><strong>{{trans("file.Quantity")}}: </strong>'+product[17]+'</p><p><strong>{{trans("file.Unit")}}: </strong>'+product[5]+'</p><p><strong>{{trans("file.Cost")}}: </strong>'+product[6]+'</p><p><strong>{{trans("file.Price")}}: </strong>'+product[7]+'</p><p><strong>{{trans("file.Tax")}}: </strong>'+product[8]+'</p><p><strong>{{trans("file.Tax Method")}} : </strong>'+product[9]+'</p><p><strong>{{trans("file.Alert Quantity")}} : </strong>'+product[10]+'</p><p><strong>{{trans("file.Product Details")}}: </strong></p>'+product[11];

        if(product[18]) {
            var product_image = product[18].split(",");
            if(product_image.length > 1) {
                slidertext = '<div id="product-img-slider" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
                for (var i = 0; i < product_image.length; i++) {
                    if(!i)
                        slidertext += '<div class="carousel-item active"><img src="public/images/product/'+product_image[i]+'" height="300" width="100%"></div>';
                    else
                        slidertext += '<div class="carousel-item"><img src="public/images/product/'+product_image[i]+'" height="300" width="100%"></div>';
                }
                slidertext += '</div><a class="carousel-control-prev" href="#product-img-slider" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#product-img-slider" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
            }
            else {
                slidertext = '<img src="public/images/product/'+product[18]+'" height="300" width="100%">';
            }
        }

        $("#combo-header").text('');
        $("table.item-list thead").remove();
        $("table.item-list tbody").remove();
        $("table.product-warehouse-list thead").remove();
        $("table.product-warehouse-list tbody").remove();
        $(".product-variant-warehouse-list thead").remove();
        $(".product-variant-warehouse-list tbody").remove();
        $("#product-warehouse-section").addClass('d-none');
        $("#product-variant-warehouse-section").addClass('d-none');
        if(product[0] == 'combo') {
            $("#combo-header").text('{{trans("file.Combo Products")}}');
            product_list = product[13].split(",");
            variant_list = product[14].split(",");
            qty_list = product[15].split(",");
            price_list = product[16].split(",");
            $(".item-list thead").remove();
            $(".item-list tbody").remove();
            var newHead = $("<thead>");
            var newBody = $("<tbody>");
            var newRow = $("<tr>");
            newRow.append('<th>{{trans("file.product")}}</th><th>{{trans("file.Quantity")}}</th><th>{{trans("file.Price")}}</th>');
            newHead.append(newRow);

            $(product_list).each(function(i) {
                if(!variant_list[i])
                    variant_list[i] = 0;
                $.get('products/getdata/' + product_list[i] + '/' + variant_list[i], function(data) {
                    var newRow = $("<tr>");
                    var cols = '';
                    cols += '<td>' + data['name'] +' [' + data['code'] + ']</td>';
                    cols += '<td>' + qty_list[i] + '</td>';
                    cols += '<td>' + price_list[i] + '</td>';

                    newRow.append(cols);
                    newBody.append(newRow);
                });
            });

            $("table.item-list").append(newHead);
            $("table.item-list").append(newBody);
        }
        else if(product[0] == 'standard') {
            $.get('products/product_warehouse/' + product[12], function(data) {
                if(data.product_warehouse[0].length != 0) {
                    warehouse = data.product_warehouse[0];
                    qty = data.product_warehouse[1];
                    batch = data.product_warehouse[2];
                    expired_date = data.product_warehouse[3];
                    imei_numbers = data.product_warehouse[4];
                    var newHead = $("<thead>");
                    var newBody = $("<tbody>");
                    var newRow = $("<tr>");
                    newRow.append('<th>{{trans("file.Warehouse")}}</th><th>{{trans("file.Batch No")}}</th><th>{{trans("file.Expired Date")}}</th><th>{{trans("file.Quantity")}}</th><th>{{trans("file.IMEI or Serial Numbers")}}</th>');
                    newHead.append(newRow);
                    $.each(warehouse, function(index) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + warehouse[index] + '</td>';
                        cols += '<td>' + batch[index] + '</td>';
                        cols += '<td>' + expired_date[index] + '</td>';
                        cols += '<td>' + qty[index] + '</td>';
                        cols += '<td>' + imei_numbers[index] + '</td>';

                        newRow.append(cols);
                        newBody.append(newRow);
                        $("table.product-warehouse-list").append(newHead);
                        $("table.product-warehouse-list").append(newBody);
                    });
                    $("#product-warehouse-section").removeClass('d-none');
                }
                if(data.product_variant_warehouse[0].length != 0) {
                    warehouse = data.product_variant_warehouse[0];
                    variant = data.product_variant_warehouse[1];
                    qty = data.product_variant_warehouse[2];
                    var newHead = $("<thead>");
                    var newBody = $("<tbody>");
                    var newRow = $("<tr>");
                    newRow.append('<th>{{trans("file.Warehouse")}}</th><th>{{trans("file.Variant")}}</th><th>{{trans("file.Quantity")}}</th>');
                    newHead.append(newRow);
                    $.each(warehouse, function(index){
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + warehouse[index] + '</td>';
                        cols += '<td>' + variant[index] + '</td>';
                        cols += '<td>' + qty[index] + '</td>';

                        newRow.append(cols);
                        newBody.append(newRow);
                        $("table.product-variant-warehouse-list").append(newHead);
                        $("table.product-variant-warehouse-list").append(newBody);
                    });
                    $("#product-variant-warehouse-section").removeClass('d-none');
                }
            });
        }

        $('#product-content').html(htmltext);
        $('#slider-content').html(slidertext);
        $('#product-details').modal('show');
        $('#product-img-slider').carousel(0);
    }

    $(document).ready(function() {
        var table = $('#product-data-table').DataTable( {
            "pageLength": 50,
            responsive: true,
            fixedHeader: {
                header: true,
                footer: true
            },
            "processing": true,
            "serverSide": true,
            "ajax":{
                // url:"products/product-data",
                url: baseUrl +'/products/product-data',
                data :  function(d) {
                    d.all_permission= all_permission,
                    d.product_id = $("#product_id").val(),
                    d.category_id = $("#category_id").val(),
                    d.brand_id = $("#brand_id").val()
                },
                dataType: "json",
                type:"post"
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass('product-link');
                $(row).attr('data-product', data['product']);
                $(row).attr('data-imagedata', data['imagedata']);
            },
            "columns": [
                {"data": "key"},
                {"data": "image"},
                {"data": "name"},
                {"data": "code"},
                {"data": "brand"},
                {"data": "category"},
                {"data": "qty"},
                {"data": "unit"},
                {"data": "price"},
                {"data": "cost"},
                // {"data": "stock_worth"},
                {"data": "status"},
                {"data": "options"},
            ],
            'language': {
                /*'searchPlaceholder': "{{trans('file.Type Product Name or Code...')}}",*/
                'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
                 "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
                "search":  '{{trans("file.Search")}}',
                'paginate': {
                        'previous': '<i class="dripicons-chevron-left"></i>',
                        'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            order:[['2', 'asc']],
            'columnDefs': [
                {
                    "orderable": false,
                    'targets': [0, 1, 9, 10, 11]
                },
                {
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                       return data;
                    },
                    'checkboxes': {
                       'selectRow': true,
                       'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            'select': { style: 'multi', selector: 'td:first-child'},
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: '<"row"lfB>rtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)',
                        rows: ':visible',
                        stripHtml: false
                    },
                    customize: function(doc) {
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                                var imagehtml = doc.content[1].table.body[i][0].text;
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                var src = regex.exec(imagehtml)[1];
                                var tempImage = new Image();
                                tempImage.src = src;
                                var canvas = document.createElement("canvas");
                                canvas.width = tempImage.width;
                                canvas.height = tempImage.height;
                                var ctx = canvas.getContext("2d");
                                ctx.drawImage(tempImage, 0, 0);
                                var imagedata = canvas.toDataURL("image/png");
                                delete doc.content[1].table.body[i][0].text;
                                doc.content[1].table.body[i][0].image = imagedata;
                                doc.content[1].table.body[i][0].fit = [30, 30];
                            }
                        }
                    },
                },
                {
                    extend: 'csv',
                    text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)',
                        rows: ':visible',
                        format: {
                            body: function ( data, row, column, node ) {
                                if (column === 0 && (data.indexOf('<img src=') !== -1)) {
                                    var regex = /<img.*?src=['"](.*?)['"]/;
                                    data = regex.exec(data)[1];
                                }
                                return data;
                            }
                        }
                    }
                },
                {
                    extend: 'print',
                    text: '<i title="print" class="fa fa-print"></i>',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)',
                        rows: ':visible',
                        stripHtml: false
                    }
                },
                {
                    text: '<i title="delete" class="dripicons-cross"></i>',
                    className: 'buttons-delete',
                    action: function ( e, dt, node, config ) {
                        if(user_verified == '1') {
                            product_id.length = 0;
                            $(':checkbox:checked').each(function(i){
                                if(i){
                                    var product_data = $(this).closest('tr').data('product');
                                    product_id[i-1] = product_data[12];
                                }
                            });
                            if(product_id.length && confirmDelete()) {
                                $.ajax({
                                    type:'POST',
                                    url:'products/deletebyselection',
                                    data:{
                                        productIdArray: product_id
                                    },
                                    success:function(data){
                                        //dt.rows({ page: 'current', selected: true }).deselect();
                                        dt.rows({ page: 'current', selected: true }).remove().draw(false);
                                    }
                                });
                            }
                            else if(!product_id.length)
                                
                                Alert("warning", "No product is selected!")
                        }
                        else
                             
                            Alert("warning", "This feature is disable for demo!")
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i title="column visibility" class="fa fa-eye"></i>',
                    columns: ':gt(0)'
                },
            ],
        } );

    } );


    function vendorProductId(e) {
        Swal.fire({
          title: 'Are you sure?',
          text: 'want to change this status!',
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#0095ff',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url:'products/vendor-product-status',
                data: {
                    id:e
                },                         
                }).then(function (response) {
                    $('#product-data-table').DataTable().clear().draw();
                    Alert('success',"Status to be Changed!");
                }, function (error) {
                    Alert('success',"Somthing wround Try Again Later");
                });

            } else {
                $('#product-data-table').DataTable().clear().draw();
            }
        }) 
    };

    if(all_permission.indexOf("products-delete") == -1)
        $('.buttons-delete').addClass('d-none');

    $('select').selectpicker();


    function filter(){
        $('#product-data-table').DataTable().draw();
    }
    function filterReset()
    {
        var product_Id = $("#product_id").val();
        var category_Id = $("#category_id").val();
        var brand_Id = $("#brand_id").val();
        if(product_Id || category_Id || brand_Id)
        {
            location.reload();
        }
        
    }

</script>
@endpush
