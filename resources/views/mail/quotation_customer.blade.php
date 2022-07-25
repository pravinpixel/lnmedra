

<h1>Quotation Details</h1><br>
<p>Dear <strong>{{$customer_name}},</strong> </p>
<p>Thanks for visiting <strong>{{$from_biller_name}} </strong>. Please find the product information below.</p><br>
{{-- <p><strong>Reference: </strong>{{$reference_no}}</p><br> --}}


<strong>{{trans("file.Date")}}: </strong>
{{$from_date->format('Y-m-d')}}
<br>
<strong>{{trans("file.reference")}}: </strong>
{{$reference_no}}<br>
<br>

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


<h3>Order Table</h3><br>

<table style="border-collapse: collapse; width: 100%;">
	<thead>
		<th style="border: 1px solid #000; padding: 5px">#</th>
		<th style="border: 1px solid #000; padding: 5px">Product</th>
		<th style="border: 1px solid #000; padding: 5px">Qty</th>
		<th style="border: 1px solid #000; padding: 5px">Unit Price</th>
		<th style="border: 1px solid #000; padding: 5px">SubTotal</th>
	</thead>
	<tbody>
		@foreach($products as $key=>$product)
		<tr>
			<td style="border: 1px solid #000; padding: 5px">{{$key+1}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{$product}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{$qty[$key].' '.$unit[$key]}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{number_format((float)($total[$key] / $qty[$key]), 2, '.', '')}}</td>
			<td style="border: 1px solid #000; padding: 5px">{{$total[$key]}}</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="2" style="border: 1px solid #000; padding: 5px"><strong>Total </strong></td>
			<td style="border: 1px solid #000; padding: 5px">{{$total_qty}}</td>
			<td style="border: 1px solid #000; padding: 5px"></td>
			<td style="border: 1px solid #000; padding: 5px">{{$total_price}}</td>
		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Order Tax </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">{{$order_tax.'('.$order_tax_rate.'%)'}}</td>
		</tr>
		@if($order_discount_method)
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Order Method </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($order_discount_method)
				{{$order_discount_method}}
				@endif
			</td>
		</tr>
		@endif
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Order discount </strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($order_discount){{$order_discount}}
				@else 0 @endif
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Shipping Cost</strong> </td>
			<td style="border: 1px solid #000; padding: 5px">
				@if($order_discount){{$shipping_cost}}
				@else 0 @endif
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Grand Total</strong></td>
			<td style="border: 1px solid #000; padding: 5px">{{$grand_total}}</td>
		</tr>
	</tbody>
</table>
<br>
<p><strong>{{trans("file.Note")}}:</strong> {{ $note }}</p>
<p>Thank You</p>