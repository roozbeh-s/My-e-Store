<!DOCTYPE html>
<html lang="en">

@include('partials/_head')
@include('partials/_javascript')

<body>
	<header id="header">
		<div class="header_top">
			<div class="header-middle">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo pull-left">
								<a href="{{ route('home') }}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="content">
		<div class="container checkout-container">

			<div class="right-col"><!-- right col-->
				<div class="shippingto-container">
					<h4 class="shippingto-title">
					Shipping and Billing address
					</h4>
					<div class="shipping-to-address">
						<div class='receiver-name'>{{$receivername}}</div>
						<div class='current-shipping-address'>{{$addr_first_line.', '.$addr_second_line.', '.$city.', '.$state_name->name.', '.$country_name->name }}
						</div>
					</div>
				</div>


				<div class="table-responsive checkout-info">
				<table class="table table-condensed">
				<tr><div class="checkout-title"> Order Summary</div> </tr>
					<thead>
						<tr class="checkout-menu">
							<td class="description">PRODUCT</td>
							<td class="quantity">QUANTITY</td>
							<td class="total">PRICE</td>
							
						</tr>
					</thead>
					<tbody>
					@foreach($cartItems as $cartItem)
						<tr>

							<td class="checkout-description">
							<p>{{ $cartItem->name }}</p>
							</td>
							<td class="checkout-quantity">
							<p>{{ $cartItem->qty }}</p>
							</td>
							<td class="checkout-price">
							<p>{{ 'RM '.number_format(($cartItem->price),2) }}</p>
							</td>
						</tr>
					@endforeach	
						<tr>
							<td>Subtotal</td>
							<td></td>
							<td>{{ 'RM '.Cart::subtotal() }}</td>
						</tr>
						<tr>
							<td>Shipping charges</td>
							<td></td>
							<td>Free</td>
						</tr>
						<tr>
							<td class="checkout-total-title">Total</td>
							<td></td>
							<td class="checkout-total-value"><p>{{'RM '.Cart::total()}}</p></td>
						</tr>
					</tbody>
					</table>	
				</div>	
			</div> <!-- end of right col-->



		<div class="payment-info col-sm-6">
			{!! Form::open(['method' => 'POST','route' => 'createorder' ,'data-parsley-validate' => '','id'=>'ccform']) !!}
			<div class="payment-info-title">
				<h3> Choose Payment Option </h3>
			</div>

			<div class="payment-options">
				<ul>
				<li>
					<div class='payment-options-tab'>
						<span>Cash On Delivery</span>
						<div class="cash-on-delivery"></div>
						<div class='radio-wrap'>		
							<input type="radio" name="radio-payment-options"  value="cod" checked />
						</div>
					</div>
				</li>

				<li>
					<div class='payment-options-tab'>
						<span>Credit Card</span>
						<div class="credit-card"></div>
						<div class='radio-wrap'>		
							<input type="radio" name="radio-payment-options"  value="creditcard" />
						</div>
					</div>
				</li>
				</ul>
			</div>


			<div class="creditcard-form">
	
			

			
			<div class="creditcard-form-label">
			{{ Form::label('cardnumber', "Card Number") }}
			</div>
			<div class="field-cardnumber">
			{{ Form::text('cardnumber', null, ['required' => '']) }}
			</div>
			
			<div class="creditcard-form-label">
			{{ Form::label('name', "Name on Card") }}
			</div>

			<div class="field-cardname">
			{{ Form::text('name', null, ['required' => '']) }}
			</div>

			<div class="creditcard-form-label">
			{{ Form::label('expiry_date', "Expiry Date") }}
			</div>

			<div class="field-expiry-date" id="error-container">
			{{ Form::text('expiry_month', null, ['data-parsley-errors-container' => '#error-container' , 'size'=>2, 'maxlength'=>2, 'required' => '']) }}
			{{ Form::text('expiry_year', null, ['data-parsley-errors-container' => '#error-container', 'size'=>2,'maxlength'=>2, 'required' => '']) }}
			</div>

			<div class="creditcard-form-label">			
			{{ Form::label('cvv', "CVV") }}
			</div>

			<div class="field-expiry-cvv">			
			{{ Form::text('cvv', null, ['size'=>12, 'maxlength'=>4, 'required' => '']) }}
			</div>


			</div> <!-- end of form-->

			<div class="place-order-button">
			{{ Form::button('<i class="fa fa-lock"></i> PLACE YOUR ORDER', ['class' => 'place-order', 'type' => 'submit']) }}
			{!! Form::close() !!}
			</div>

	
		</div>	<!-- end of payment info-->
		
		</div>	
	</section>

<script type="text/javascript">

	$(document).ready(function() {
    $("input[value$='cod']").click(function() {
        $(".creditcard-form").hide();
        $("#ccform :input").prop('required', false);
    });

    $("input[value$='creditcard']").click(function() {
        $(".creditcard-form").show();
        $("#ccform :input").prop('required', true);
    });
});
</script>



@include('partials/_footer')