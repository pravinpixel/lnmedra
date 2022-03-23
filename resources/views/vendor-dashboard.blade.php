@extends('layout.main') @section('content')
@section('content') 
@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
@endif
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
    <div class="container-fluid">
        <div class="col-md-8 mb-3 my-4 mx-auto">
            <div class="row align-items-center">
            <div class="col text-end">Choose the date period</div>
            <div class="col d-flex p-0">
                <input type="date" name="fromDate" id="fromDate" class="form-control mx-1">
                <input type="date" name="toDate" id="toDate" class="form-control mx-1">
                <input type="submit" name=""  value="Submit" id="dateValidate" class="btn btn-primary">
            </div>
            </div>
        </div>
        <div class="row m-0 ">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Sales</strong></span>
                        <div class="float-right laed h1">{{ $saleTotal }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Paid</strong></span>
                        <div class="float-right laed h1">{{ $paymentReceived }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>To Be Paid</strong></span>
                        <div class="float-right laed h1">{{ $toBePaid }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Products</strong></span>
                        <div class="float-right laed h1">{{ $project }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Approved</strong></span>
                        <div class="float-right laed h1">{{ $approved }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Pending</strong></span>
                        <div class="float-right laed h1">{{ $pending }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Rejected</strong></span>
                        <div class="float-right laed h1">{{ $rejected }}</div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row m-0 card">
            <div class="d-flex justify-content-between align-items-center p-3 ">
                <h3 class="m-0">Product Listing</h3>
                <div class="float-end">
                    <a href="{{route('vendorproducts.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</a>
                </div>
            </div>
            <table id="product-data-table" class="table custom table-hover bg-white p-0 m-0">
                <thead>
                    <tr>
                        <th> Sl. No </th>
                        <!-- <th> Image </th> -->
                        <th> Product Name </th>
                        <th> Product Type </th>
                        <th> Brand </th>
                        <th> Category </th>
                        <th> Quantity </th>
                        <th> Unit Price </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <!-- <tbody>
                    @for ($key=0;$key<10;$key++)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center">product {{ $key+1 }}</td> 
                            <td class="text-center">Type {{ $key+1 }}</td> 
                            <td class="text-center">Brand {{ $key+1 }}</td> 
                            <td class="text-center">Category {{ $key+1 }}</td> 
                            <td class="text-center">240</td> 
                            <td class="text-center">{{ $key+1 }}000</td> 
                            <td class="text-center">
                                @if ($key == 3 || $key == 6)
                                    <span class="badge badge-warning">Inactive </span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </td> 
                            <td class="text-center">
                                <i class="fa fa-pencil text-info me-1 mr-2 btn btn-light"></i>
                                <i class="fa fa-trash text-danger btn btn-light"></i>
                            </td> 
                        </tr>
                    @endfor
                </tbody> -->
            </table>
        </div>
        
    </div>
  
@endsection

@push('scripts')
<script>

    $("ul#vendorDashboard-menu").siblings('a').attr('aria-expanded','true');
    $("ul#vendorDashboard-menu").addClass("show");
    $("#vendorDashboard-menu").addClass("active");

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

    $(document).on("click", "tr.product-link td:not(:first-child, :last-child)", function() {
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
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    function productDetails(product, imagedata) {
        product[1] = product[1].replace(/@/g, '"');
        htmltext = slidertext = '';

        htmltext = '<p><strong>{{trans("file.Type")}}: </strong>'+product[0]+'</p><p><strong>{{trans("file.name")}}: </strong>'+product[1]+'</p><p><strong>{{trans("file.Code")}}: </strong>'+product[2]+ '</p><p><strong>{{trans("file.Brand")}}: </strong>'+product[3]+'</p><p><strong>{{trans("file.category")}}: </strong>'+product[4]+'</p><p><strong>{{trans("file.Price")}}: </strong>'+product[5]+'</p><p><strong>{{trans("file.Product Details")}}: </strong></p>'+product[6];
        if(product[10]) {
            var product_image = product[10].split(",");
            if(product_image.length > 1) {
                slidertext = '<div id="product-img-slider" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
                for (var i = 0; i < product_image.length; i++) {
                    if(!i)
                        slidertext += '<div class="carousel-item active"><img src="public/images/vendorproduct/'+product_image[i]+'" height="300" width="100%"></div>';
                    else
                        slidertext += '<div class="carousel-item"><img src="public/images/vendorproduct/'+product_image[i]+'" height="300" width="100%"></div>';
                }
                slidertext += '</div><a class="carousel-control-prev" href="#product-img-slider" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#product-img-slider" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
            }
            else {
                slidertext = '<img src="public/images/vendorproduct/'+product[10]+'" height="300" width="100%">';
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
                $.get('vendorproducts/getdata/' + product_list[i] + '/' + variant_list[i], function(data) {
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
            responsive: true,
            fixedHeader: {
                header: true,
                footer: true
            },
            "processing": true,
            "serverSide": true,
            "ajax":{
                url:"vendor-dashboard-data",
                data: function(d) {
                    d.all_permission = all_permission;
                    d.fromdate =  $('#fromDate').val();
                    d.todate =  $('#toDate').val();
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
                {"data": "i"},
                // {"data":"image"}, 
                {"data": "name"},
                {"data": "type"},
                {"data": "brand"},
                {"data": "category"},
                {"data": "qty"},
                {"data": "price"},
                {"data": "is_active"},
                // {"data": "user_name"},
                // {"data": "code"},
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
                    "orderable": false
                    //'targets': [0, 1, 9, 10, 11]
                },
                
            ],
            'select': { style: 'multi', selector: 'td:first-child'},
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
            // dom: '<"row"lfB>rtip',
            // buttons: [
            //     {
            //         extend: 'pdf',
            //         text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
            //         exportOptions: {
            //             columns: ':visible:not(.not-exported)',
            //             rows: ':visible',
            //             stripHtml: false
            //         },
            //         customize: function(doc) {
            //             for (var i = 1; i < doc.content[1].table.body.length; i++) {
            //                 if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
            //                     var imagehtml = doc.content[1].table.body[i][0].text;
            //                     var regex = /<img.*?src=['"](.*?)['"]/;
            //                     var src = regex.exec(imagehtml)[1];
            //                     var tempImage = new Image();
            //                     tempImage.src = src;
            //                     var canvas = document.createElement("canvas");
            //                     canvas.width = tempImage.width;
            //                     canvas.height = tempImage.height;
            //                     var ctx = canvas.getContext("2d");
            //                     ctx.drawImage(tempImage, 0, 0);
            //                     var imagedata = canvas.toDataURL("image/png");
            //                     delete doc.content[1].table.body[i][0].text;
            //                     doc.content[1].table.body[i][0].image = imagedata;
            //                     doc.content[1].table.body[i][0].fit = [30, 30];
            //                 }
            //             }
            //         },
            //     },
            //     {
            //         extend: 'csv',
            //         text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
            //         exportOptions: {
            //             columns: ':visible:not(.not-exported)',
            //             rows: ':visible',
            //             format: {
            //                 body: function ( data, row, column, node ) {
            //                     if (column === 0 && (data.indexOf('<img src=') !== -1)) {
            //                         var regex = /<img.*?src=['"](.*?)['"]/;
            //                         data = regex.exec(data)[1];
            //                     }
            //                     return data;
            //                 }
            //             }
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         text: '<i title="print" class="fa fa-print"></i>',
            //         exportOptions: {
            //             columns: ':visible:not(.not-exported)',
            //             rows: ':visible',
            //             stripHtml: false
            //         }
            //     },
            //     {
            //         text: '<i title="delete" class="dripicons-cross"></i>',
            //         className: 'buttons-delete',
            //         action: function ( e, dt, node, config ) {
            //             if(user_verified == '1') {
            //                 product_id.length = 0;
            //                 $(':checkbox:checked').each(function(i){
            //                     if(i){
            //                         var product_data = $(this).closest('tr').data('product');
            //                         product_id[i-1] = product_data[7];
            //                     }
            //                 });
            //                 if(product_id.length && confirmDelete()) {
            //                     alert()
            //                     $.ajax({
            //                         type:'DELETE',
            //                         url:'vendorproducts.deletebyVendorDashboard/',
            //                         data:{
            //                             productIdArray: product_id
            //                         },
            //                         success:function(data){
            //                             //dt.rows({ page: 'current', selected: true }).deselect();
            //                             dt.rows({ page: 'current', selected: true }).remove().draw(false);
            //                         }
            //                     });
            //                 }
            //                 else if(!product_id.length)
            //                     alert('No product is selected!');
            //             }
            //             else
            //                 alert('This feature is disable for demo!');
            //         }
            //     },
            //     {
            //         extend: 'colvis',
            //         text: '<i title="column visibility" class="fa fa-eye"></i>',
            //         columns: ':gt(0)'
            //     },
            // ],
        } );

        $('#dateValidate').click(function(){
            console.log($('#fromDate').val());
            table.clear().draw()
        });


       

    } );
    function vendorProductId(e) {
        $.ajax({
            type: "POST",
            url:'vendorproducts/vendor-dashboard-status',
    data: {
        id:e
    },                         
        }).then(function (response) {
             
            // alert(response.status);
            $('#product-data-table').DataTable().clear().draw();
                
        }, function (error) {
            console.log(error);
            Message('warning',response.data.msg);
            console.log('Unable to delete');
        });

    
    // $('#estimate-datatable').DataTable().clear().draw();


    };
    if(all_permission.indexOf("vendorproducts-delete") == -1)
        $('.buttons-delete').addClass('d-none');

    $('select').selectpicker();

</script>
@endpush
