@extends('main')

@section('title', '| Review') 

@section('content')

<div class="container review-container">

@include('partials/_accsidebar')

<div class="prodct-review-wrapper col-sm-8">

	@foreach($orders as $order)
	
		<table class=product-review-item-table>
			<thead>
				<tr>
					<th>item</th>
					<th></th>
					<th>Your Product Rating</th>
					<th>Your Product Review</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><img src={{ URL::asset("$order->thumbnailPath") }}></td>
					<td>{{ $order->product_name}}</td>
					
					<td>
						@for ($i = 0; $i < $order->rating; $i++)
						 <a href={{ route('rateproduct',['product_id' => $order->product_id, 'order_id' => $order->order_id]) }}><i class='fa fa-star stars-active' style="font-size: 25px;"></i></a>
						@endfor

						@for ($i = $order->rating; $i < 5 ; $i++)
						 <a href={{ route('rateproduct',['product_id' => $order->product_id, 'order_id' => $order->order_id])}}><i class='fa fa-star-o stars-not-active' style="font-size: 25px;"></i></a>
						@endfor

					</td>
					<td>{{ $order->title}}</td>	
				</tr>	
			</tbody>
		</table>

	@endforeach	
</div>	

</div>


@endsection