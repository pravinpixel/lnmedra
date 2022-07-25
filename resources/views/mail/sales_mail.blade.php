@component('mail::message')
<h1>Sale Details</h1>
<p><strong>Reference: </strong>{{ $details['reference_no']}}</p>
<p>
	<strong>Sale Status: </strong>
	@if($details['sale_status']==1){{'Completed'}}
	@elseif($details['sale_status']==2){{'Pending'}}
	@endif
</p>
<p>
	<strong>Payment Status: </strong>
	@if($details['payment_status']==1){{'Pending'}}
	@elseif($details['payment_status']==2){{'Due'}}
	@elseif($details['payment_status']==3){{'Partial'}}
	@else{{'Paid'}}@endif
</p>

<table style="border-collapse: collapse; width: 100%;">
	<tbody>
		<tr>
			<td style="width:70%"><b>From:</b></td>
			<td><b>To:</b></td>
		</tr>
		<tr>
			<td style=" padding: 5px">{{$details['from_biller_name']}}</td>
			<td style="padding: 5px">{{$details['customer_name']}}</td>
		</tr>
		<tr>
			<td style=" padding: 5px">{{$details['from_biller_email']}}</td>
			<td style=" padding: 5px">{{$details['customer_email']}}</td>
		</tr>
		<tr>
			<td style=" padding: 5px">{{$details['from_phone_number']}}</td>
			<td style=" padding: 5px">{{$details['customer_phone_number']}}</td>
		</tr>
		<tr>
			<td style=" padding: 5px">{{$details['from_address']}}</td>
			<td style=" padding: 5px">{{$details['customer_address']}}</td>
		</tr>
		<tr>
			<td style=" padding: 5px">{{$details['from_city']}}</td>
			<td style=" padding: 5px">{{$details['customer_city']}}</td>
		</tr>
	</tbody>
</table>
<h3>Order Table</h3>
<table style="border-collapse: collapse; width: 100%;">
	<thead>
		<th style="border: 1px solid #000; padding: 5px">#</th>
		<th style="border: 1px solid #000; padding: 5px">Product</th>
		<th style="border: 1px solid #000; padding: 5px">Download Link</th>
		<th style="border: 1px solid #000; padding: 5px">Qty</th>
		<th style="border: 1px solid #000; padding: 5px">Unit Price</th>
		<th style="border: 1px solid #000; padding: 5px">SubTotal</th>
	</thead>
	<tbody>
		@foreach($details['products'] as $key=>$product)
		<tr>
			<td style="border: 1px solid #000; padding: 5px">{{$key+1}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{$product}}</td>
			@if($details['file'][$key])
				<td style="border: 1px solid #000; padding: 5px"><a href="{{ $details['file'][$key] }}">Download</a></td>
			@else
				<td style="border: 1px solid #000; padding: 5px">N/A</td>
			@endif
			<td style="border: 1px solid #000; padding: 5px">{{ $details['qty'][$key].' '. $details['unit'][$key]}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{number_format((float)( $details['total'][$key] /  $details['qty'][$key]), 2, '.', '')}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{ $details['total'][$key]}}</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="3" style="border: 1px solid #000; padding: 5px"><strong>Total </strong></td>
			<td style="border: 1px solid #000; padding: 5px">{{$details['total_qty']}}</td>
			<td style="border: 1px solid #000; padding: 5px"></td>
			<td style="border: 1px solid #000; padding: 5px">{{$details['total_price']}}</td>
		</tr>
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Order Tax </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">{{$details['order_tax'].'('.$details['order_tax_rate'].'%)'}}</td>
		</tr>
		@if($details['order_discount_method'])
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Order Method </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($details['order_discount_method'])
				{{$details['order_discount_method']}}
				@endif
			</td>
		</tr>
		@endif
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Order discount </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($details['order_discount']){{$details['order_discount']}}
				@else 0 @endif
			</td>
		</tr>
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Shipping Cost</strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($details['shipping_cost']){{$details['shipping_cost']}}
				@else 0 @endif
			</td>
		</tr>
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Grand Total</strong></td>
			<td style="border: 1px solid #000; padding: 5px">{{$details['grand_total']}}</td>
		</tr>
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Paid Amount</strong></td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($details['paid_amount']){{$details['paid_amount']}}
				@else 0 @endif
			</td>
		</tr>
		<tr>
			<td colspan="5" style="border: 1px solid #000; padding: 5px"><strong>Due</strong></td>
			<td style="border: 1px solid #000; padding: 5px">{{number_format((float)($details['grand_total'] - $details['paid_amount']), 2, '.', '')}}</td>
		</tr>
	</tbody>
</table>
<p>Thank You</p>
@endcomponent