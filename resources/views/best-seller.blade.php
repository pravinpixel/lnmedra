<div class="col-md-6">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4>{{trans('file.Best Seller').' '.date('Y'). '('.trans('file.qty').')'}}</h4>
        <div class="right-column">
          
        </div>
      </div>
      <div class="table-responsive">
          <table class="table" id="best-seller-table">
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