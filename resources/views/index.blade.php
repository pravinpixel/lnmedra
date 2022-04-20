@extends('layout.main')
@section('content')
  <style>.drag-icon{cursor: move} table.dataTable{margin: 0 !important} #simple-dragula .card{ min-height: 300px;  margin: 20px 0 !important} .dataTables_wrapper{padding: 0 !important; margin: 0 !important}#simple-dragula .card .card-header h4{font-weight: bold !important; } #simple-dragula .card .card-header{justify-content: start !important} .bg-dragula{background-color:var(--ct-dragula-bg)}.gu-mirror{position:fixed!important;margin:0!important;z-index:9999!important;opacity:.8}.gu-hide{display:none!important}.gu-unselectable{-webkit-user-select:none!important;-moz-user-select:none!important;-ms-user-select:none!important;user-select:none!important}.gu-transit{opacity:.2}.dragula-handle{position:relative;width:36px;height:36px;font-size:24px;text-align:center;cursor:move}.dragula-handle:before{content:"\f01db";font-family:"Material Design Icons";position:absolute}</style>
  <style>
    .ui-state-default {
      border: none !important;
      background: none !important 
    }
    .row {
      display: in !important
    }
    .count-number {
      font-weight: bold !important;
      color: white;
      text-shadow: 0px 2px 3px #032617 !important;
      letter-spacing: 1px;
    }
    .count-title {
      background:linear-gradient(#0095FF, #0095FF) !important;
      color : #032617 !important;
      border: 2px  solid white !important;
      text-shadow: 0 2px 5px white !important;
      box-shadow: 0 5px 10px #9b9b9b !important
    }
    .icon i{
      font-size: 2rem !important
    }
    #transactionChart {
        height: 250px !important;
        width: auto !important;
        margin: 0px auto;
    }
    .table th, .table td {
      padding: 4px 10px !important
    }
  </style>
  <div class="row ">
    <div class="container-fluid  my-4 ">
      <div class="col-md-12 d-flex align-items-center justify-content-between">
        <div class="brand-text float-left">
            <h3 class="m-0">Dashboard</h3>
        </div>
        <div class="filter-toggle btn-group shadow border rounded-pill m-0" style="overflow: hidden">
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
  <br>
  <div class="row m-0">
    <!-- Count item widget-->
    <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-graph-bar" ></i></div>
        <div class="name"><strong >Sales</strong></div>
        <div class="count-number revenue-data">00.00</div>
      </div>
    </div>
     <!-- Count item widget-->
     <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-media-loop" ></i></div>
        <div class="name"><strong >Purchase</strong></div>
        <div class="count-number purchase-data">00.00</div>
      </div>
    </div>

    <!-- Count item widget-->
    <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-media-loop" ></i></div>
        <div class="name"><strong >Expense</strong></div>
        <div class="count-number expense-data">00.00</div>
      </div>
    </div>
    
    <!-- Count item widget-->
    <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-return" ></i></div>
        <div class="name"><strong >Sale Return</strong></div>
        <div class="count-number return-data">00.00</div>
      </div>
    </div>
    <!-- Count item widget-->
    <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-media-loop" ></i></div>
        <div class="name"><strong >Purchase Return</strong></div>
        <div class="count-number purchase_return-data">00.00</div>
      </div>
    </div>

   
    <!-- Count item widget-->
    <div class="col">
      <div class="wrapper count-title text-center shadow-sm">
        <div class="icon"><i class="dripicons-trophy"></i></div>
        <div class="name"><strong>Profit</strong></div>
        <div class="count-number profit-data">00.00</div>
      </div>
    </div>
  </div>
  <br>
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
  
  <ul id="sortable" class="p-0 m-0 row">
    @foreach($dashboardOrderables as $key => $sortableOrder)
    {{-- <div class="row" id="simple-dragula" data-plugin="dragula"> --}}
      @if($sortableOrder == "sortable-1")
      <li id="sortable-1" class="list-group-item ui-state-default col-6  {{ $columOrderables[$key] }}">
        <div >
          <div class="card line-chart-example shadow">
            <div class="custom-card-header">
              <h4>
                <i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>{{trans('file.Cash Flow')}}
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-1')" ></i>
              </h4>
            </div>
            <div class="card-body p-3">
              <canvas id="cashFlow" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-recieved = "{{json_encode($payment_recieved)}}" data-sent = "{{json_encode($payment_sent)}}" data-month = "{{json_encode($month)}}" data-label1="{{trans('file.Payment Recieved')}}" data-label2="{{trans('file.Payment Sent')}}"></canvas>
            </div>
          </div>
        </div>
      </li>
      @elseif($sortableOrder == "sortable-2")
      <li id="sortable-2" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              <h4>
                <i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>{{trans('file.yearly report')}}
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-2')" ></i>
              </h4>
            </div>
            <div class="card-body p-3">
              <canvas id="saleChart" data-sale_chart_value = "{{json_encode($yearly_sale_amount)}}" data-purchase_chart_value = "{{json_encode($yearly_purchase_amount)}}" data-label1="{{trans('file.Purchased Amount')}}" data-label2="{{trans('file.Sold Amount')}}"></canvas>
            </div>
          </div>
        </div>
      </li>
      @elseif($sortableOrder == "sortable-3")
      <li id="sortable-3" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              
              <h4><i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>{{trans('file.Best Seller').' '.date('Y'). '('.trans('file.qty').')'}}
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-3')" ></i>
              </h4>
              <div class="right-column"></div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table m-0 table-bordered" id="best-seller-table">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>{{trans('file.Product Details')}}</th>
                      <th>{{trans('file.qty')}}</th>
                      <th>{{ trans('file.amount') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($yearly_best_selling_qty as $key => $sale)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$sale->product->name}}<br>[{{$sale->product->code}}]</td>
                        <td>{{$sale->sold_qty}}</td>
                        <td>{{$sale->sold_qty * $sale->product->price}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
      </li>
      @elseif($sortableOrder == "sortable-4")
      <li id="sortable-4" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              
              <h4><i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>{{trans('file.Recent Transaction')}}
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-4')" ></i>
              </h4>
              <div class="right-column"></div>
            </div>
            <div class="card-body p-3 pt-3">
              <ul class="nav nav-tabs bg-light border rounded mb-2" role="tablist">
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
              <div class="tab-content p-0">
                <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                    <div class="table-responsive border-right border-info border-left">
                      <table class="table m-0 table-bordered">
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
                    <div class="table-responsive border-right border-info border-left">
                      <table class="table m-0 table-bordered">
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
                    <div class="table-responsive border-right border-info border-left">
                      <table class="table m-0 table-bordered">
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
                    <div class="table-responsive border-right border-info border-left">
                      <table class="table m-0 table-bordered">
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
        </div>
      </li>
      @elseif($sortableOrder == "sortable-5")
      <li id="sortable-5" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              <h4><i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>{{date('F')}} {{date('Y')}}
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-5')" ></i></h4>
            </div>
            <div class="card-body p-3">
              <div class="pie-chart">
                <canvas id="transactionChart" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-revenue={{$revenue}} data-purchase={{$purchase}} data-expense={{$expense}} data-label1="{{trans('file.Purchase')}}" data-label2="{{trans('file.revenue')}}" data-label3="{{trans('file.Expense')}}" width="100" height="95"> </canvas>
              </div>
            </div>
          </div>
        </div>
      </li>
      @elseif($sortableOrder == "sortable-6")
      <li id="sortable-6" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              <h4><i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>Cash flow Distribution
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-6')" ></i></h4>  
            </div>
            <div class="card-body p-3">
              <div class="table-responsive border-right border-info border-left">
                <table class="table m-0 table-bordered">
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
                      <td class="revenue-data" > 0.00</td>
                      @foreach($accountData as $key=>$val)
                      <td class="<?php echo(str_replace([' ','&'], '', $val['accounts_date_name']))?>" >0.00</td>
                      @endforeach
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </li> 
      @elseif($sortableOrder == "sortable-7")
      <li id="sortable-7" class="list-group-item ui-state-default col-6 {{ $columOrderables[$key] }}">
        <div >
          <div class="card shadow mb-0">
            <div class="custom-card-header">
              
              <h4><i class="fa fa-bars drag-icon mx-2" aria-hidden="true" ></i>Recent  Customers
                <i class="fa fa-th drag-icon mx-2 float-right" onclick="change_view_length('sortable-7')" ></i></h4>
              <div class="right-column"></div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive border-right border-info border-left">
                <table class="table m-0 table-bordered">
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
                        <td> {{$customer->sales->sum('item')}} </td>
                        <td> {{$customer->payments->count()}} </td>
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
      </li>
      @endif
    @endforeach
    {{-- </div> --}}
  </ul>
{{-- 
  <section class="dashboard-counts">
    <div class="container-fluid">
      <div class="row m-0">
        <div class="col-md-12 p-0 mb-4">
          <div class="row m-0">
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-graph-bar" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #14AB69">Sales</strong></div>
                <div class="count-number revenue-data">00.00</div>
              </div>
            </div>
             <!-- Count item widget-->
             <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #14AB69"></i></div>
                <div class="name"><strong style="color: #0095ff">Purchase</strong></div>
                <div class="count-number purchase-data">00.00</div>
              </div>
            </div>

            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #14AB69">Expense</strong></div>
                <div class="count-number expense-data">00.00</div>
              </div>
            </div>
            
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-return" style="color: #14AB69"></i></div>
                <div class="name"><strong style="color: #0095ff">Sale Return</strong></div>
                <div class="count-number return-data">00.00</div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                <div class="name"><strong style="color: #14AB69">Purchase Return</strong></div>
                <div class="count-number purchase_return-data">00.00</div>
              </div>
            </div>

           
            <!-- Count item widget-->
            <div class="col">
              <div class="wrapper count-title text-center">
                <div class="icon"><i class="dripicons-trophy" style="color: #14AB69"></i></div>
                <div class="name"><strong style="color: #0095ff">Profit</strong></div>
                <div class="count-number profit-data">00.00</div>
              </div>
            </div>
          </div>
        </div>
        <div >
          <div class="card line-chart-example">
            <div class="card-header">
              <h4>{{trans('file.Cash Flow')}}</h4>
            </div>
            <div class="card-body p-3">
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
            <div class="card-header">
              <h4>{{trans('file.yearly report')}}</h4>
            </div>
            <div class="card-body p-3">
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
      <div class="row mb-3">
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
      </div>
      <div class="row">
        
        <div >
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Cash flow Distribution</h4>  
            </div>
            <div class="table-responsive border-right border-info border-left">
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
                      <td class="revenue-data" > 0.00</td>
                      @foreach($accountData as $key=>$val)
                      <td class="<?php echo(str_replace([' ','&'], '', $val['accounts_date_name']))?>" >0.00</td>
                      @endforeach
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div >
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
                  <div class="table-responsive border-right border-info border-left">
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
                  <div class="table-responsive border-right border-info border-left">
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
                  <div class="table-responsive border-right border-info border-left">
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
                  <div class="table-responsive border-right border-info border-left">
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
        <div >
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Recent  Customers</h4>
              <div class="right-column">
                
              </div>
            </div>
            <div class="table-responsive border-right border-info border-left">
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
                        <td> {{$customer->sales->sum('item')}} </td>
                        <td> {{$customer->payments->count()}} </td>
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
  </section> --}}
 
@endsection

@push('scripts')
<script src="https://coderthemes.com/hyper/saas/assets/js/vendor/dragula.min.js"></script>
<script src="https://coderthemes.com/hyper/saas/assets/js/ui/component.dragula.js"></script>
<script>
  $( function() {
    $("#sortable").sortable({
      update: function(event, ui) {

        let $lis = $(this).children('li');

        let sortableOrder = [];
        let columnClass = [];

        $lis.each(function() {
          var $li = $(this).attr('id');
          var $class = ($(this).hasClass('col-12')) ? "col-12" : "col-6";
          sortableOrder.push($li);
          columnClass.push($class)
        });
        
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post('{{route('dashboard-sortable-order')}}',{data: [sortableOrder, columnClass]})
        // $.ajax({
        //   url: ,
        //   method: "POST",
        //   data: ,
        //   success: function(res){}
        // });
      }
    });
  });
  function change_view_length(prams) {
    $(`#${prams}`).toggleClass("col-12")
  }
</script>
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
        // console.log( key + ": " + value + "===");
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
