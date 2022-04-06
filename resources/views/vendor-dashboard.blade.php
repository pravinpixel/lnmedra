@extends('layout.main') @section('content')
@section('content') 

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
            <div class="col-12">
                <h3 class="mb-3">Sales</h3>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Sales</strong></span>
                        <div class="float-right laed h1">{{ $saleTotal }}</div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Paid</strong></span>
                        <div class="float-right laed h1">{{ $paymentReceived }}</div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>To Be Paid</strong></span>
                        <div class="float-right laed h1">{{ $toBePaid }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3 class="mb-3">Products</h3>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <span class="text-info h3 m-0"><strong>Products</strong></span>
                        <div class="float-right laed h1">{{ $product }}</div>
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
                        <th> Product Name </th>
                        <th> Code </th>
                        <th> Product Type </th>
                        <th> Brand </th>
                        <th> Category </th>
                        <th> Quantity </th>
                        <th> Unit Price </th>
                        <th> Status </th>
                        <th  class="not-exported"> Action </th>
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

    $(document).on("click", "tr.product-link td:not(:last-child)", function() {
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
        htmltext = '<p>{{trans("file.name")}}: </strong>'+product[1]+'</p><p><strong>{{trans("file.Code")}}: </strong>'+product[2]+ '</p><p><strong>{{trans("file.Brand")}}: </strong>'+product[3]+'</p><p><strong>{{trans("file.category")}}: </strong>'+product[4];
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
        console.log(slidertext)
        $("#combo-header").text('');
        $("table.item-list thead").remove();
        $("table.item-list tbody").remove();
        $("table.product-warehouse-list thead").remove();
        $("table.product-warehouse-list tbody").remove();
        $(".product-variant-warehouse-list thead").remove();
        $(".product-variant-warehouse-list tbody").remove();
        $("#product-warehouse-section").addClass('d-none');
        $("#product-variant-warehouse-section").addClass('d-none');
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
                type:"GET"
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass('product-link');
                $(row).attr('data-product', data['product']);
                $(row).attr('data-imagedata', data['imagedata']);
            },
            "columns": [
                {"data": "name"},
                {"data": "code"},
                {"data": "product_type_name"},
                {"data": "brand_name"},
                {"data": "category_name"},
                {"data": "vendor_qty"},
                {"data": "vendor_price"},
                {"data": "vendor_is_approve"},
                {"data": "action", "orderable": false, "searchable": false},
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
            dom: '<"row"lfB>rtip',
        rowId: 'ObjectID',
        buttons: [
            {
                extend: 'pdf',
                text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
           
            {
                extend: 'colvis',
                text: '<i title="column visibility" class="fa fa-eye"></i>',
                columns: ':gt(0)'
            },
        ]

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
