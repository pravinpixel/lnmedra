@extends('layout.main') @section('content')
 
<section>
    <div class="container-fluid">
        @if(in_array("returns-add", $all_permission))
            <div class="text-right my-4">
                <a href="{{route('return-sale.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Return')}}</a>
            </div>
        @endif
        
    <div class="card">  
        <div class="card-body">
            {!! Form::open(['route' => 'return-sale.index', 'method' => 'get']) !!}
                <div class="row m-0">
                    
             
                    <div class="d-flex align-items-center col-5">
                        <div class="mr-3">{{trans('file.customer')}}</div>
                        <select id="customer_id" name="customer_id" class="selectpicker form-control w-100" data-live-search="true" data-live-search-style="begins" >
                            <option value="0">{{trans('file.customer')}}</option>
                            @foreach($lims_customer_list as $customer)
                     
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                           
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-2">
                        <button class="btn btn-primary w-100" onclick="filter()" id="filter-btn" type="submit">{{trans('file.search')}}</button>
                    </div>
                </div>
            {!! Form::close() !!}
          
        </div>
    </div>

        <div class="card pb-3 shadow">
            <div class="table-responsive">
                <table id="return-table" class="table return-list">
                    <thead>
                        <tr>
                            <th class="not-exported"></th>
                            <th>{{trans('file.Date')}}</th>
                            <th>{{trans('file.reference')}}</th>
                            <th>{{trans('file.Biller')}}</th>
                            <th>{{trans('file.customer')}}</th>
                            <th>{{trans('file.Warehouse')}}</th>
                            <th>{{trans('file.grand total')}}</th>
                            <th class="not-exported">{{trans('file.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lims_return_all as $key=>$return)
                        <tr class="return-link" data-return='["{{date($general_setting->date_format, strtotime($return->created_at->toDateString()))}}", "{{$return->reference_no}}", "{{$return->warehouse->name}}", "{{$return->biller->name}}", "{{$return->biller->company_name}}","{{$return->biller->email}}", "{{$return->biller->phone_number}}", "{{$return->biller->address}}", "{{$return->biller->city}}", "{{$return->customer->name}}", "{{$return->customer->phone_number}}", "{{$return->customer->address}}", "{{$return->customer->city}}", "{{$return->id}}", "{{$return->total_tax}}", "{{$return->total_discount}}", "{{$return->total_price}}", "{{$return->order_tax}}", "{{$return->order_tax_rate}}", "{{$return->grand_total}}", "{{$return->return_note}}", "{{$return->staff_note}}", "{{$return->user->name}}", "{{$return->user->email}}"]'>
                            <td>{{$key}}</td>
                            <td>{{ date($general_setting->date_format, strtotime($return->created_at->toDateString())) . ' '. $return->created_at->toTimeString() }}</td>
                            <td>{{ $return->reference_no }}</td>
                            <td>{{ $return->biller->name }}</td>
                            <td>{{ $return->customer->name }}</td>
                            <td>{{$return->warehouse->name}}</td>
                            <td class="grand-total">{{ $return->grand_total }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                        <li>
                                            <button type="button" class="btn btn-link view"><i class="fa fa-eye"></i> {{trans('file.View')}}</button>
                                        </li>
                                        @if(in_array("returns-edit", $all_permission))
                                        <li>
                                            <a href="{{ route('return-sale.edit', $return->id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a>
                                        </li>
                                        @endif
                                        <li class="divider"></li>
                                        @if(in_array("returns-delete", $all_permission))
                                        {{ Form::open(['route' => ['return-sale.destroy', $return->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDeleteAlert("warning", this);'] ) }}
                                        <li>
                                            <button type="submit" class="btn btn-link" ><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                        </li>
                                        {{ Form::close() }}
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="tfoot active">
                        <th></th>
                        <th>{{trans('file.Total')}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
        </div>


    </div>
    
    <div id="return-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="container mt-3 pb-2 border-bottom">
            <div class="row">
                <div class="col-md-6 d-print-none">
                    <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
                    {{ Form::open(['route' => 'return-sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
                        <input type="hidden" name="return_id">
                        <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> {{trans('file.Email')}}</button>
                    {{ Form::close() }}
                </div>
                <div class="col-md-6 d-print-none">
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="col-md-12">
                    <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">{{$general_setting->site_title}}</h3>
                </div>
                <div class="col-md-12 text-center">
                    <i style="font-size: 15px;">{{trans('file.Return Details')}}</i>
                </div>
            </div>
        </div>
                <div id="return-content" class="modal-body">
                </div>
                <br>
                <table class="table table-bordered product-return-list">
                    <thead>
                        <th>#</th>
                        <th>{{trans('file.product')}}</th>
                        <th>{{trans('file.Batch No')}}</th>
                        <th>{{trans('file.Qty')}}</th>
                        <th>{{trans('file.Unit Price')}}</th>
                        <th>{{trans('file.Tax')}}</th>
                        <th>{{trans('file.Discount')}}</th>
                        <th>{{trans('file.Subtotal')}}</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="return-footer" class="modal-body"></div>
          </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
    $("ul#return").siblings('a').attr('aria-expanded','true');
    $("ul#return").addClass("show");
    $("ul#return #sale-return-menu").addClass("active");

    var all_permission = <?php echo json_encode($all_permission) ?>;
    var return_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    $("tr.return-link td:not(:first-child, :last-child)").on("click", function(){
        var returns = $(this).parent().data('return');
        returnDetails(returns);
    });

    $(".view").on("click", function(){
        var returns = $(this).parent().parent().parent().parent().parent().data('return');
        returnDetails(returns);
    });

    $("#print-btn").on("click", function(){
        var divContents = document.getElementById("return-details").innerHTML;
        var a = window.open('');
        a.document.write('<html>');
        a.document.write('<head><style>body{font-family: sans-serif;line-height: 1.15;-webkit-text-size-adjust: 100%;}.d-print-none{display:none}.text-center{text-align:center}.row{width:100%;margin-right: -15px;margin-left: -15px;}.col-md-12{width:100%;display:block;padding: 5px 15px;}.col-md-6{width: 50%;float:left;padding: 5px 15px;}table{width:100%;margin-top:30px;}th{text-aligh:left}td{padding:10px}table,th,td{border: 1px solid black; border-collapse: collapse;}</style><style>@media print {.modal-dialog { max-width: 1000px;} }</style></head>');
        a.document.write('<body >');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        setTimeout(function(){a.close();},10);
        a.print();
    });

    $('#return-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 7]
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
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                text: '<i title="delete" class="dripicons-cross"></i>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        return_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                var returns = $(this).closest('tr').data('return');
                                return_id[i-1] = returns[13];
                            }
                        });
                        
                        if(return_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'return-sale/deletebyselection',
                                data:{
                                    returnIdArray: return_id
                                },
                                success:function(data){
                                    Alert("warning", data);
                                    dt.rows({ page: 'current', selected: true }).remove().draw(false);
                                }
                            });
                            //dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }

                        else if(!return_id.length)
                            Alert("warning", 'Nothing is selected!');
                    }
                    else
                        Alert("warning", 'This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<i title="column visibility" class="fa fa-eye"></i>',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

    function returnDetails(returns){
        $('input[name="return_id"]').val(returns[13]);
        var htmltext = '<strong>{{trans("file.Date")}}: </strong>'+returns[0]+'<br><strong>{{trans("file.reference")}}: </strong>'+returns[1]+'<br><strong>{{trans("file.Warehouse")}}: </strong>'+returns[2]+'<br><br><div class="row"><div class="col-md-6"><strong>{{trans("file.From")}}:</strong><br>'+returns[3]+'<br>'+returns[4]+'<br>'+returns[5]+'<br>'+returns[6]+'<br>'+returns[7]+'<br>'+returns[8]+'</div><div class="col-md-6"><div class="float-right"><strong>{{trans("file.To")}}:</strong><br>'+returns[9]+'<br>'+returns[10]+'<br>'+returns[11]+'<br>'+returns[12]+'</div></div></div>';
        $.get('return-sale/product_return/' + returns[13], function(data){
            $(".product-return-list tbody").remove();
            var name_code = data[0];
            var qty = data[1];
            var unit_code = data[2];
            var tax = data[3];
            var tax_rate = data[4];
            var discount = data[5];
            var subtotal = data[6];
            var batch_no = data[7];
            var newBody = $("<tbody>");
            $.each(name_code, function(index){
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><strong>' + (index+1) + '</strong></td>';
                cols += '<td>' + name_code[index] + '</td>';
                cols += '<td>' + batch_no[index] + '</td>';
                cols += '<td>' + qty[index] + ' ' + unit_code[index] + '</td>';
                cols += '<td>' + (subtotal[index] / qty[index]) + '</td>';
                cols += '<td>' + tax[index] + '(' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + discount[index] + '</td>';
                cols += '<td>' + subtotal[index] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            });

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=5><strong>{{trans("file.Total")}}:</strong></td>';
            cols += '<td>' + returns[14] + '</td>';
            cols += '<td>' + returns[15] + '</td>';
            cols += '<td>' + returns[16] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=7><strong>{{trans("file.Order Tax")}}:</strong></td>';
            cols += '<td>' + returns[17] + '(' + returns[18] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=7><strong>{{trans("file.grand total")}}:</strong></td>';
            cols += '<td>' + returns[19] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            $("table.product-return-list").append(newBody);
        });
        var htmlfooter = '<p><strong>{{trans("file.Return Note")}}:</strong> '+returns[20]+'</p><p><strong>{{trans("file.Staff Note")}}:</strong> '+returns[21]+'</p><strong>{{trans("file.Created By")}}:</strong><br>'+returns[22]+'<br>'+returns[23];
        $('#return-content').html(htmltext);
        $('#return-footer').html(htmlfooter);
        $('#return-details').modal('show');
    }

    if(all_permission.indexOf("returns-delete") == -1)
        $('.buttons-delete').addClass('d-none');

        $(".daterangepicker-field").daterangepicker({
        callback: function(startDate, endDate, period){
        var starting_date = startDate.format('YYYY-MM-DD');
        var ending_date = endDate.format('YYYY-MM-DD');
        var title = starting_date + ' To ' + ending_date;
        $('.daterangepicker-field').val(title);
        $('input[name="starting_date"]').val(starting_date);
        $('input[name="ending_date"]').val(ending_date);
        }
    });
    function filter(){
        $('#return-table').DataTable().draw();
    }
</script>
@endpush
