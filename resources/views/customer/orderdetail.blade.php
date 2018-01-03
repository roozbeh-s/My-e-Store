@extends('main')

@section('title', '| Orders') 

@section('content')

<div class="container order-detail-container">


	@include('partials/_accsidebar')


<div class="col-sm-9 order-detail-wrapper">
		<div class="col-sm-12 order-detail-header">
			<div class="col-sm-4 order-no">
				Order# {{ $order->id}}
			</div>
			<div class="col-sm-4 order-created-at">
				Placed on {{ Carbon\Carbon::parse($order->created_at)->addHours(8)->format('d/m/Y')}}
			</div>
			<div class="col-sm-4 order-price">
				Total: {{ 'RM '.$order->total}}
			</div>
		</div>
		

		<div class="col-sm-12 order-detail-info">
			<table class="order-table">	
					
						@foreach ($order->items as $item)
							<tr>
							<td class="order-detail-info-image">
							@if($item->thumbnailPath)
							    <img src={{ URL::asset("$item->thumbnailPath") }}> 
							@endif 
							</td>

							<td class="order-detail-info-product-name">
								    {{ $item->product_name }} 
							</td>

							<td class="order-detail-info-product-price">
								    {{'RM '.$item->product_price }} 
							</td>

							<td class="order-detail-info-product-qty">
								 	{{'X '.$item->qty }} 
							</td>

							<td class="order-detail-info-product-review">
								 	<a href={{ route('rateproduct',['product_id' => $item->product_id, 'order_id' => $order->id])}}>WRITE REVIEW</a>
							</td>
							</tr>
						@endforeach 
					
			</table>
		</div>

		<div class="col-sm-4 order-delivery-address">
			<div class="order-delivery-address-title">
				Delivery Address
			</div>	
			<div class="order-delivery-address-info">
				
				<div class="order-receiver-name">{{ $order->address->receiver }}</div>
				<div class="order-shipping-address">{{ $order->address->addr_first_line.', '.$order->address->addr_second_line.', '.$order->address->city.', '.$order->address->province->name.', '.$order->address->nation->name.', '.$order->address->postcode }}</div>
			</div>	
		</div>

		<div class="col-sm-2 order-middle-col">
		</div>

		<div class="col-sm-6 order-payment-details">
			<div class="order-payment-details-title">
				Total Summary
			</div>
			
			<div class="order-payment-details-info">
				
					<div class="order-payment-details-subtotal-title">Subtotal</div>
					<div class="order-payment-details-subtotal-price">{{ 'RM '.$order->subtotal }}</div>

					<div class="order-payment-details-shipping-fee-title">Shipping Fees</div>
					<div class="order-payment-details-shipping-fee-price">{{ 'RM '.$order->shipping_fee }}</div>

					<div class="order-payment-details-promotion-title">Promotion</div>
					<div class="order-payment-details-promotion-price">RM 0.00</div>

					<div class="order-payment-details-total-title">Total (GST applied where applicable)</div>
					<div class="order-payment-details-total-price">{{'RM '.$order->total }}</div>
	
			</div>	
		
		</div>				
</div>

</div>	
	

@endsection