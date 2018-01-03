@extends('main')

@section('title', "| $product->name")


@section('content')

<div class="container">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="product-details">
			
			<div class="col-sm-5">
				<div class="view-product">
					<img src="{{'/'.$product->imagePath }}">
					<h3>ZOOM</h3>
				</div>
			</div>
			
			<div class="col-sm-7">
				<div class="product-information">
				 	<h2>{{ $product->name }}</h2>
				 	<p>Product ID: {{ $product->id }} </p>
				 	
				 	<span>
				 	<span>{{ 'RM '.$product->price }}</span>
				 	 	
				 	</span>

				 	<p><b>Availability:</b> {{ $product->quantity > 0 ? 'In Stock' : 'Sold Out' }}</p>


				 	<div class="col-sm-5 product-option">

				 		{!! Form::open(['method' => 'POST','route' => ['addtocart', $product->sku, $product->id]]) !!}

				 		
					 	@if(!empty($colorlabel))
					 	{{ Form::label('color', "Color") }}
					 	{{ Form::select('color', $colorvalue, null, ['placeholder' => '- Pick a color -']) }}

					 	@if ($errors->has('color')) 
						<p style="color:red;"> {{ $errors->first('color') }}</p> 
						@endif

					 	@endif
					

					 	@if(!empty($sizelabel))
					 	{{ Form::label('size', "Size") }}
					 	{{ Form::select('size', $sizevalue , null, ['placeholder' => '- Pick a size -']) }}


						@if ($errors->has('size')) 
						<p style="color:red;"> {{ $errors->first('size') }}</p> 
						@endif

					 	@endif


					 	{{ Form::button('<i class="fa fa-shopping-cart"></i> Add to cart', ['class' => 'btn btn-fefault cart', 'type' => 'submit']) }}
					 	
					 	{!! Form::close() !!}


				 	</div>
				</div>
			</div>
		</div>

		<!--<div class="category-tab shop-details-tab">
			<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Product Details</a></li>
								<li><a href="#reviews" data-toggle="tab">Reviews</a></li>
								<li><a href="#tag" data-toggle="tab">Product Q&A</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Seller Information</a></li>
							</ul>
			</div>

			<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="/images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
			</div>

		</div>-->

	</div>


</div>

@endsection 