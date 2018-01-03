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

	<section id="checkout_items">
		<div class="container">
			<div class="table-responsive checkout_info">
				<table class="table table-condensed">
				<tr><div id="checkout_title"> Order Summary</div> </tr>
					<thead>
						<tr class="checkout_menu">
							<td class="description">PRODUCT</td>
							<td class="quantity">QUANTITY</td>
							<td class="total">PRICE</td>
							
						</tr>
					</thead>
					<tbody>
					@foreach($cartItems as $cartItem)
						<tr>

							<td class="checkout_description">
							<p>{{ $cartItem->name }}</p>
							</td>
							<td class="checkout_quantity">
							<p>{{ $cartItem->qty }}</p>
							</td>
							<td class="checkout_price">
							<p>{{ $cartItem->price }}</p>
							</td>
						</tr>
					@endforeach	
						<tr>
							<td>Subtotal</td>
							<td></td>
							<td>{{ Cart::subtotal() }}</td>
						</tr>
						<tr>
							<td>Shipping charges</td>
							<td></td>
							<td>Free</td>
						</tr>
						<tr>
							<td class="checkout-total-title">Total</td>
							<td></td>
							<td class="checkout-total-value"><p>{{Cart::total()}}</p></td>
						</tr>
					</tbody>
					</table>	
			</div>

			<div class="checkout_shipping_info col-sm-6">
				<div class="checkout_shipping_info_title"> Select a shipping address </div>
					<div class="checkout_shipping_info_content">
						<i id="tickmark"></i>
						<div class='receiver_name'>{{$receivername}}</div>
						<div class='current_shipping_address'>{{$address->addr_first_line.', '.$address->addr_second_line.', '.$address->city.', '.$state->name.', '.$country->name }}
						</div>
					</div>


					<div class="new_shipping_address">
						{!! Form::open(['method' => 'POST','route' => 'checkout' ,'data-parsley-validate' => '']) !!}	
						{{ Form::checkbox('checkbox_new_shipping_address', 0,null, ['class' => 'field checkbox_new_shipping_address','onchange' => 'valueChanged()']) }}
						{{ Form::label('checkbox_new_shipping_address',"Ship to a different shipping address") }}

					<script type="text/javascript">
						Parsley.on('field:validated', function(fieldInstance){
						if (fieldInstance.$element.is(":hidden")) {
						// hide the message wrapper
						fieldInstance._ui.$errorsWrapper.css('display', 'none');
						// set validation result to true
						fieldInstance.validationResult = true;
						return true;
						}
						});
					</script>	
			
					

					<div class="new_shipping_address_details_content col-sm-10">


						{{ Form::label('name', "Name") }}
                		{{ Form::text('name', null, ['class'=>'form-control', 'required' => '']) }}

						
						{{ Form::label('addr_first_line', "Address Line 1") }}
                		{{ Form::text('addr_first_line', null, ['class'=>'form-control', 'required' => '']) }}


                		{{ Form::label('addr_second_line', "Address Line 2") }}
                		{{ Form::text('addr_second_line', null, ['class'=>'form-control', 'required' => '']) }}

                		 
			            {{ Form::label('city', "City") }}
			            {{ Form::text('city', null, ['class'=>'form-control', 'required' => '']) }}


			            {{ Form::label('postcode', "Zip/Postal Code") }}
			            {{ Form::text('postcode', null, ['class'=>'form-control', 'required' => '']) }}



						<!--<div class="col-sm-6" style="margin-left: -10px;">-->
                		{{ Form::label('state', "State") }}
                		<br>
                		{{Form::select('state', $selectstate , null, ['placeholder' => 'Please select a state','required' => '']) }}
						<!--</div>-->
						
						<!--<div class="col-sm-6">-->
		                {{ Form::label('country', "Country") }}
		                <br>
		                {{ Form::select('country', $selectcountry , null, ['placeholder' => 'Please select a country','required' => '']) }}
		                <!--</div>-->
		              </div>  
		               
		                <div class="checkout-continue">
		                {{Form::submit('Continue', ['class' => 'button-checkout-new-shipping']) }}
						{!! Form::close() !!}
						</div>

					</div>

					


					<script type="text/javascript">

						$(document).ready(function() {
    						//$(".new_shipping_address_details_content").hide();
    						if ($('.checkbox_new_shipping_address').is(':checked')){
    							$(".new_shipping_address_details_content").show();
    							$(".button-checkout-current-shipping").hide();
    						}
    						else {
    							$(".new_shipping_address_details_content").hide();
    							$(".button-checkout-current-shipping").show();
    						}
    					});
						function valueChanged()
							{
							if($('.checkbox_new_shipping_address').is(":checked")){
							$(".new_shipping_address_details_content").show();
							$(".button-checkout-current-shipping").hide();
							$("#tickmark").removeClass("fa fa-check");
							$('.checkbox_new_shipping_address').val(1)
						}

							else{
							$(".new_shipping_address_details_content").hide();
							$(".button-checkout-current-shipping").show();
							$('.checkbox_new_shipping_address').val(0);
							
						}
							}

					</script>


				<script type="text/javascript">
					$(function(){
					var checkbox_value = localStorage.input === 'true'? true: false;
					$('.checkbox_new_shipping_address').prop('checked', checkbox_value || false);
					});
					//$('.checkbox_new_shipping_address').on('change', function() {
					//localStorage.input = $(this).is(':checked');
					//});
				</script>

				<script type="text/javascript">
					$(document).ready(function() {
					$(".checkout_shipping_info_content").click(function(){
					//$("#tickmark").addClass("fa fa-check");
					//$(".new_shipping_address_details_content").hide();
					$(".button-checkout-current-shipping").show();
					$(".checkbox_new_shipping_address").prop('checked', false);
					});
					});
				</script>

			</div>
		</div>	
	</section>


@include('partials/_footer')

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
@endsection
	

</body>
</html>