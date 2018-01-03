@extends('main')

@section('title', '| Products') 

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <script>
                $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min: {{ $minPrice }},
                max: {{ $maxPrice }},
                values: [ {{ $minPrice }}, {{ $maxPrice }} ],
                
                slide: function( event, ui ) {
                
                $( "#amount_start" ).val( ui.values[ 0 ]);

                $( "#amount_end" ).val(ui.values[ 1 ]);
                }
                });
                });
            </script>

            PRICE IN (RM)

            <div id="slider-range"></div>
            

            <div class='price-filter-form'>

            {!! Form::open(['method' => 'GET','route' => ['getproductbycategoryandPrice',$category->name] ]) !!}
            {{ Form::text('start_price', number_format($minPrice,0), ['id'=>'amount_start', 'class' => 'amount-start']) }}
            <div class="amount-divider">-</div>
            {{ Form::text('end_price', number_format($maxPrice,0), ['id'=>'amount_end', 'class' => 'amount-end']) }}
            {{ Form::button('',['class' => 'price-filter-btn','type'=>'submit' ]) }}
            {!! Form::close() !!}
            </div>

        </div>    


	<div class="tab-content col-sm-9">
    @foreach($products->chunk(4) as $productChunck)
        <div class="row">
            @foreach($productChunck as $product)
                <div class="col-sm-3">
                    <a href="{{ url('productdetail/'.$product->sku.'/'.$product->id) }}">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                <img src="{{ URL::to($product->imagePath) }}" alt="" />
                                <h2>{{ $product->price }}</h2>
                                <p>{{ $product->name }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
	</div>

    {{ $products->links() }}
</div>
</div>

@endsection