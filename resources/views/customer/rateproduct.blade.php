@extends('main')

@section('title', '| Orders') 

@section('content')

<div class="container acc-rating">


@include('partials/_accsidebar')

	<div class="product-rating-wrapper">
		<div class="product-rating-info-wrapper">
			<div class="product-rating-info">
				<div class="product-rating-info-thumbnail">
					@if($product->thumbnailPath)
						<img src={{ URL::asset("$product->thumbnailPath") }}> 
					@endif
				</div>
				<div class="product-rating-info-product-info">
					<div class="product-rating-info-product-info-product-name">
						{{ $product->name }}
					</div>
					<div class="product-rating-info-product-info-product-description">
						{{ $product->description }}
					</div>	
				</div>
			</div>

			<div class="product-rating-form" style="margin-top: 50px; margin-left:20px;">
				<div class="form-review-product-label">
					Your Product Rating *
				</div>

			<script type="text/javascript">

				$(function(){
				    $("input[type='radio']").change(function(){
				        $("input[type='submit']").prop("disabled", false);
				    });
				});

				$(function(){
				    $("input[type='text']").keyup(function(){
				        $("input[type='submit']").prop("disabled", false);
				    });
				});

				$(function(){
				    $(document).on('input propertychange', "textarea[name='review']", function () {
    					$("input[type='submit']").prop("disabled", false);
					});
				});

			</script>
			
		@if(!empty($rating->rating))

			<script type="text/javascript">
				var rating = {{json_encode($rating->rating)}};
				
				$(document).ready(function(){

					switch (rating) {
						case 1:
					        $("#star-1").attr('checked', 'checked');
					        break;
					    case 2:
					        $("#star-2").attr('checked', 'checked');
					        break;
					    case 3:
					        $("#star-3").attr('checked', 'checked');
					        break;
					    case 4:
					        $("#star-4").attr('checked', 'checked');
					        break;
					    case 5:
					        $("#star-5").attr('checked', 'checked');
					        break;
					}

				});
			</script>
		@endif	

			<div class="stars">

				{!! Form::open(['method' => 'POST','route' => empty($rating) ? ['rating',$product->id] : ['ratingupdate',$product->id] ]) !!}
				
				{{ Form::radio('star',5,false,['class' => 'star star-5', 'id'=>'star-5']) }}
				<label class="star star-5" for="star-5"></label>
				
				{{ Form::radio('star',4,false,['class' => 'star star-4', 'id'=>'star-4']) }}
				<label class="star star-4" for="star-4"></label>


				{{ Form::radio('star',3,false,['class' => 'star star-3', 'id'=>'star-3']) }}
				<label class="star star-3" for="star-3"></label>


				{{ Form::radio('star',2,false,['class' => 'star star-2', 'id'=>'star-2']) }}
				<label class="star star-2" for="star-2"></label>


				{{ Form::radio('star',1,false,['class' => 'star star-1', 'id'=>'star-1']) }}
				<label class="star star-1" for="star-1"></label> <br>

			</div>

			<div class="review-form-title">

				{{ Form::label('title', "Review Title") }}
				{{ Form::text('title', empty($rating->title) ? null : $rating->title, ['class'=>'form-control']) }}

			</div>
			
			<div class="review-form-message" style="margin-top:20px;">	

				{{ Form::label('review', "Your Product Review") }}
				{{ Form::textarea('review', empty($rating->body) ? null : $rating->body, ['size' => '30x5']) }}

			</div>

			<div class="review-form-button">

			{{ Form::submit('SUBMIT', ['class' => 'review-btn', 'disabled' => 'disabled' ,'id' => 'startBtn']) }}
			{!! Form::close() !!}
			</div>	




			</div>	
		</div>	
	</div>	

</div>


@endsection
