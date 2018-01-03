	@extends('main')

@section('title', '| Products') 

@section('content')


<div class="container" >
	<div class="tab-content">
	@if(count($products))	
    @foreach($products->chunk(4) as $productChunck)
        <div class="row">
            @foreach($productChunck as $product)
                <div class="col-sm-3">
                    <a href="{{ url('productdetail/'.$product->sku.'/'.$product->id) }}">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                <img src={{ $product->imagePath }} alt="" />
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
    
    @else
    There is no product available
    @endif

	</div> 
    {{ $products->links() }}
</div>

@endsection