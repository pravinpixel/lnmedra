@extends('layout.main')
@section('content')
 

  <div class="row ">
    <div class="container-fluid  my-3">
      <div class="col-md-12 d-flex align-items-center justify-content-between">
        <div class="brand-text float-left">
            <h3 class="m-0">Dashboard</h3>
        </div>
        <div class="filter-toggle btn-group shadow border rounded-pill m-0">
          <button class="btn btn-light  date-btn" data-start_date="{{date('Y-m-d')}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.Today')}}</button>
          <button class="btn btn-light  date-btn" data-start_date="{{date('Y-m-d', strtotime(' -7 day'))}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.Last 7 Days')}}</button>
          <button class="btn btn-light  date-btn active" data-start_date="{{date('Y').'-'.date('m').'-'.'01'}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.This Month')}}</button>
          <button class="btn btn-light  date-btn" data-start_date="{{date('Y').'-01'.'-01'}}" data-end_date="{{date('Y').'-12'.'-31'}}">{{trans('file.This Year')}}</button>
          <input type="hidden" id="this-month-start-date" name="this-month-start-date" value="{{date('Y').'-'.date('m').'-'.'01'}}">
          <input type="hidden" id="this-month-end-date" name="this-month-end-date" value="{{date('Y-m-d')}}">
        </div>
      </div>
    </div>
  </div> 
  
  <section class="dashboard-counts">
    <div class="container-fluid">
      <div class="row m-0">
        <div class="col-md-12 p-0 mb-4">
          <div class="row m-0">
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-graph-bar" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Sales</strong></div>
                <div class="count-number revenue-data">00.00</div>
              </div>
            </div>
             <!-- Count item widget-->
             <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Purchase</strong></div>
                <div class="count-number purchase-data">00.00</div>
              </div>
            </div>

            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Expense</strong></div>
                <div class="count-number expense-data">00.00</div>
              </div>
            </div>
            
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-return" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Sale Return</strong></div>
                <div class="count-number return-data">00.00</div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Purchase Return</strong></div>
                <div class="count-number purchase_return-data">00.00</div>
              </div>
            </div>

           
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-trophy" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #0095ff">Profit</strong></div>
                <div class="count-number profit-data">00.00</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card line-chart-example">
            <div class="card-header d-flex align-items-center">
              <h4>{{trans('file.Cash Flow')}}</h4>
            </div>
            <div class="card-body">
              @php
                if($general_setting->theme == 'default.css'){
                  $color = '#0095ff';
                  $color_rgba = 'rgba(34, 83, 62)';
                }
                elseif($general_setting->theme == 'green.css'){
                    $color = '#2ecc71';
                    $color_rgba = 'rgba(46, 204, 113, 0.8)';
                }
                elseif($general_setting->theme == 'blue.css'){
                    $color = '#3498db';
                    $color_rgba = 'rgba(52, 152, 219, 0.8)';
                }
                elseif($general_setting->theme == 'dark.css'){
                    $color = '#34495e';
                    $color_rgba = 'rgba(52, 73, 94, 0.8)';
                }
              @endphp
              <canvas id="cashFlow" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-recieved = "{{json_encode($payment_recieved)}}" data-sent = "{{json_encode($payment_sent)}}" data-month = "{{json_encode($month)}}" data-label1="{{trans('file.Payment Recieved')}}" data-label2="{{trans('file.Payment Sent')}}"></canvas>
            </div>
          </div>
        </div>
        @include('best-seller');
        <div class="col-md-8 ">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>{{trans('file.yearly report')}}</h4>
            </div>
            <div class="card-body">
              <canvas id="saleChart" data-sale_chart_value = "{{json_encode($yearly_sale_amount)}}" data-purchase_chart_value = "{{json_encode($yearly_purchase_amount)}}" data-label1="{{trans('file.Purchased Amount')}}" data-label2="{{trans('file.Sold Amount')}}"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>{{date('F')}} {{date('Y')}}</h4>
            </div>
            <div class="pie-chart mb-2">
                <canvas id="transactionChart" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-revenue={{$revenue}} data-purchase={{$purchase}} data-expense={{$expense}} data-label1="{{trans('file.Purchase')}}" data-label2="{{trans('file.revenue')}}" data-label3="{{trans('file.Expense')}}" width="100" height="95"> </canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      {{-- <div class="row mb-3">
        @for ($i=0;$i<5;$i++)
          <div class="col  ">
            <table class="table bg-white shadow border w-100">
              <tr>
                <td class="text-center" colspan="2">                      
                  <strong>
                    @if ($i == 0)Purchase @endif
                    @if ($i == 1)Sales @endif
                    @if ($i == 2)Returns @endif
                    @if ($i == 3)Expenses @endif
                    @if ($i == 4)Profit / Loss @endif
                  </strong>
                </td>
              </tr>
                <tr>
                  <th>Particulars</th>
                  <th>Amount</th>
                </tr>
                <tr>
                  <td>Purchase</td> 
                  <td>0.00 </td> 
                </tr>
                <tr>
                  <td>Paid</td> 
                  <td>0.00 </td> 
                </tr>
                <tr>
                  <td>Discount</td> 
                  <td>0.00 </td> 
                </tr> 
            </table>
          </div>
        @endfor
      </div> --}}
      <div class="row">
        
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Cash flow Distribution</h4>  
            </div>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th> Heads</th>
                        <th> Total Sales</th>
                        @foreach($accountData as $key=>$val)
                        <th> {{ $val['accounts_date_name'] }}</th>
                        @endforeach
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                      <td> Allocated %</td>
                      <td class="revenue-data" > 10000</td>
                      @foreach($accountData as $key=>$val)
                      <td class="<?php echo(str_replace([' ','&'], '', $val['accounts_date_name']))?>" >0.00</td>
                      @endforeach
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>{{trans('file.Recent Transaction')}}</h4>
              <div class="right-column">
                  
              </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#purchase-latest" role="tab" data-toggle="tab">{{trans('file.Purchase')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#quotation-latest" role="tab" data-toggle="tab">{{trans('file.Quotation')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#payment-latest" role="tab" data-toggle="tab">{{trans('file.Payment')}}</a>
              </li>
            </ul>

            <div class="tab-content p-3">
              <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.customer')}}</th>
                          <th>{{trans('file.status')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_sale as $sale)
                        <?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                        <tr>
                          <td>{{ date($general_setting->date_format, strtotime($sale->created_at->toDateString())) }}</td>
                          <td>{{$sale->reference_no}}</td>
                          <td>{{$customer->name}}</td>
                          @if($sale->sale_status == 1)
                          <td><div class="badge badge-success">{{trans('file.Completed')}}</div></td>
                          @elseif($sale->sale_status == 2)
                          <td><div class="badge badge-danger">{{trans('file.Pending')}}</div></td>
                          @else
                          <td><div class="badge badge-warning">{{trans('file.Draft')}}</div></td>
                          @endif
                          <td>{{$sale->grand_total}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.Supplier')}}</th>
                          <th>{{trans('file.status')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_purchase as $purchase)
                        <?php $supplier = DB::table('suppliers')->find($purchase->supplier_id); ?>
                        <tr>
                          <td>{{date($general_setting->date_format, strtotime($purchase->created_at->toDateString())) }}</td>
                          <td>{{$purchase->reference_no}}</td>
                          @if($supplier)
                            <td>{{$supplier->name}}</td>
                          @else
                            <td>N/A</td>
                          @endif
                          @if($purchase->status == 1)
                          <td><div class="badge badge-success">Recieved</div></td>
                          @elseif($purchase->status == 2)
                          <td><div class="badge badge-success">Partial</div></td>
                          @elseif($purchase->status == 3)
                          <td><div class="badge badge-danger">Pending</div></td>
                          @else
                          <td><div class="badge badge-danger">Ordered</div></td>
                          @endif
                          <td>{{$purchase->grand_total}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.customer')}}</th>
                          <th>{{trans('file.status')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_quotation as $quotation)
                        <?php $customer = DB::table('customers')->find($quotation->customer_id); ?>
                        <tr>
                          <td>{{date($general_setting->date_format, strtotime($quotation->created_at->toDateString())) }}</td>
                          <td>{{$quotation->reference_no}}</td>
                          <td>{{$customer->name}}</td>
                          @if($quotation->quotation_status == 1)
                          <td><div class="badge badge-danger">Pending</div></td>
                          @else
                          <td><div class="badge badge-success">Sent</div></td>
                          @endif
                          <td>{{$quotation->grand_total}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="payment-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.Amount')}}</th>
                          <th>{{trans('file.Paid By')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_payment as $payment)
                        <tr>
                          <td>{{date($general_setting->date_format, strtotime($payment->created_at->toDateString())) }}</td>
                          <td>{{$payment->payment_reference}}</td>
                          <td>{{$payment->amount}}</td>
                          <td>{{$payment->paying_method}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Recent  Customers</h4>
              <div class="right-column">
                
              </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Customer Mobile</th>
                      <th>No. of Orders</th>
                      <th>Transaction</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($customers as $key => $customer)
                      <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td> </td>
                        <td> </td>
                      </tr>
                    @empty
                      <p> No data found</p>
                    @endforelse
                  </tbody>
                </table>
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
        let bestSeller = $("#best-seller-table").DataTable({searching: false, paging: false, info: false});
    });
  $(document).ready(function(){
    $.get('dashboard-filter/' + $("#this-month-start-date").val() + '/' + $("#this-month-end-date").val(), function(data) {
            dashboardFilter(data);
      });
  });
    // Show and hide color-switcher
    $(".color-switcher .switcher-button").on('click', function() {
        $(".color-switcher").toggleClass("show-color-switcher", "hide-color-switcher", 300);
    });

    // Color Skins
    $('a.color').on('click', function() {
        /*var title = $(this).attr('title');
        $('#style-colors').attr('href', 'css/skin-' + title + '.css');
        return false;*/
        $.get('setting/general_setting/change-theme/' + $(this).data('color'), function(data) {
        });
        var style_link= $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color') );
        $('#custom-style').attr('href', style_link);
    });

    $(".date-btn").on("click", function() {
        $(".date-btn").removeClass("active");
        $(this).addClass("active");
        var start_date = $(this).data('start_date');
        var end_date = $(this).data('end_date');
        $.get('dashboard-filter/' + start_date + '/' + end_date, function(data) {
            dashboardFilter(data);
        });
    });

    function dashboardFilter(data){
      console.log(data.percentagecal);
      $.each( data.percentagecal, function( key, value ) {
        console.log( key + ": " + value + "===");
        $('.'+key).html(parseFloat(value).toFixed(2));
      });
        $('.revenue-data').hide();
        $('.revenue-data').html(parseFloat(data[0]).toFixed(2));
        $('.revenue-data').show(500);

        $('.return-data').hide();
        $('.return-data').html(parseFloat(data[1]).toFixed(2));
        $('.return-data').show(500);

        $('.profit-data').hide();
        $('.profit-data').html(parseFloat(data[2]).toFixed(2));
        $('.profit-data').show(500);

        $('.purchase_return-data').hide();
        $('.purchase_return-data').html(parseFloat(data[3]).toFixed(2));
        $('.purchase_return-data').show(500);

        $('.purchase-data').hide();
        $('.purchase-data').html(parseFloat(data['purchase']).toFixed(2));
        $('.purchase-data').show(500);

        $('.expense-data').hide();
        $('.expense-data').html(parseFloat(data['expense']).toFixed(2));
        $('.expense-data').show(500);
    }
</script>
@endpush
