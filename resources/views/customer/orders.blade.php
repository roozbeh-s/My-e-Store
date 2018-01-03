
@extends('main')

@section('title', '| Account') 

@section('content')


<div class="container order-container">

        @if (session('order-success'))
            <p class="alert alert-info">{{ session('order-success') }}</p>
        @endif

        @include('partials/_accsidebar')


<div id="order_items" class="col-sm-6">



{!! Form::open(['method' => 'GET','route' => ['searchorder']]) !!}
{{ Form::select('status', $status, null, 
['placeholder' => '- Select Status -', 'class' => 'select-status first-disabled']) }}

{{ Form::button('Search', ['class' => 'btn-search', 'type' => 'submit']) }}

<div class="btn-reset">
<a  href="{{ route('orders') }}">Reset</a>
</div>
{!! Form::close() !!}



<script type="text/javascript">
    $( "select.first-disabled option:first-child" ).attr("disabled", "disabled");
</script>




<div class="table-responsive order_info">
<div class="order-history-table-title"><h2>View Orders/Shipping</h2></div>
                <table class="table table-condensed">
                    <thead>
                        <tr class="order_menu">
                            <td class="order-details">Order Date</td>
                            <td class="image"></td>
                            <td class="order-item">Item</td>
                            <td class="order-price">Order Price</td>
                            <td class="order-shippig-fee">Shipping Fee</td>
                            <td class="order-status">Order/Shipping<br>Status</td>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($orders as $order)
                        <tr>
                            <td class="order-details-value">
                                <div class="order-date">{{ Carbon\Carbon::parse($order->created_at)->addHours(8)->format('Y-m-d') }}</div> 
                                <div class="order-detail"> 
                                <a href="{{ route('orderdetail', ['id' => $order->id]) }}">Order Detail</a>
                                </div>
                                <div class="order-id">{{ $order->id }}</div>
                            </td>
                            <td class="image-value">
                                @foreach ($order->items as $item)
                                @if($item->thumbnailPath)
                                    <div><img src={{ URL::asset("$item->thumbnailPath") }}> </div> 
                                @endif 
                                @endforeach    
                            </td>
                            
                            <td class="order-item-value">
                                @foreach ($order->items as $item)
                                    <div class="product-name">{{ $item->product_name }}</div>
                                @endforeach  
                            </td>
                            
                            <td class="order-price-value">
                                {{ "RM ".$order->total }}
                            </td>
                            
                            <td class="order-shipping-fee-value">
                                {{ "RM ".$order->shipping_fee }}
                            </td>
                            
                            <td class="order-status-value">
                                {{ $order->getStatusLabel->label }}
                            </td>

                        </tr>
                     @endforeach
                    </tbody>
                </table>
                <div class="no-order-info hidden">
                    There is no recent order/shipping details.
                 </div>
                 {{ $orders->appends(Request::only('status'))->links() }}   
            </div>

</div>



</div>    



@endsection


