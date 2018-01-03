@extends('main')


@section('title', '| Shopping Cart')


@section('content')

<section id="cart_items">
    <div class="container">

    @if (Session::has('message-error'))
        <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
    @endif

    @if (Session::has('message-success'))
        <div class="alert alert-success">{{ Session::get('message-success') }}</div>
    @endif



    @if(Cart::count() > 0)

   
        <div class="table-responsive cart_info col-sm-8">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Item Price</td>
                    <td class="quantity">Quantity</td>
                    <!--<td class="total">Total</td>-->
                    <td></td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cartItems as $cartItem)
                    
                    <tr>
                        <td class="cart_product" style="margin-left: -20px;">
                         <img src={{ $cartItem->options->image  }} alt="" />
                        </td>

                        <td class="cart_description">
                        <div>
                        {{ $cartItem->name }}


                        </div>
                        <div>


                        @if($cartItem->options->size || $cartItem->options->color)

                        <a href="#editcartmodal{{$cartItem->rowId}}" class="btn btn-fefault update_qty" data-toggle="modal" id="editoption{{$cartItem->rowId}}">Edit</a>            
                        
                        <br>
                        <div class="cartoptions">
                        {{ $cartItem->options->size}}@if($cartItem->options->size) / @endif{{ $cartItem->options->color}}@if($cartItem->options->color) / @endif Qty: {{ $cartItem->qty}}
                        </div>
                        @endif

                        <script>

                              $(document).ready(function(){
                                
                              $("#editoption{{$cartItem->rowId}}").click(function(){

                                 var sizevalue=$(this).val();
                                 var div=$(this).parent();
                                 var op=" ";

                                $.ajax({
                                    
                                    type: 'get',
                                    url: "editoption/{{$cartItem->rowId}}",
                                    dataType: 'json',
                                    data:{'sizevalue': sizevalue},
                                    
                                    success: function(data) {
                                    if(data['size'].length!=0){

                                    op+='<option value="0" selected disabled>Pick a size</option>';

                                    for(var i=0;i<data['size'].length;i++){
                                        op+='<option value="'+data['size'][i]+'">'+data['size'][i]+'</option>';
                                    }
                                    div.find('.size').html("");
                                    div.find('.size').append(op);

                                    }else {
                                        $('.sizefield{{$cartItem->rowId}}').addClass('hidden');
                                    }
                                },
                                    error: function() {
                                

                                    }
                                });
                              });
                              });


                            $(document).ready(function(){
                                
                              $("#editoption{{$cartItem->rowId}}").click(function(){

                                 var colorvalue=$(this).val();
                                 var div=$(this).parent();
                                 var op=" ";

                                $.ajax({
                                    
                                    type: 'get',
                                    url: "editoption/{{$cartItem->rowId}}",
                                    dataType: 'json',
                                    data:{'colorvalue': colorvalue},
                                    
                                    success: function(data) {

                                    if(data['color'].length!=0){

                                    op+='<option value="0" selected disabled>Pick a color</option>';

                                    for(var i=0;i<data['color'].length;i++){
                                        op+='<option value="'+data['color'][i]+'">'+data['color'][i]+'</option>';
                                    }
                                    div.find('.color').html("");
                                    div.find('.color').append(op);

                                    }else {
                                        $('.colorfield{{$cartItem->rowId}}').addClass('hidden');
                                    }

                                },
                                    error: function() {
                                
                                    }
                                });
                              });
                              });

                        </script>
                        


                        @include('modals.editcartmodal')


                        </div> 
                        </td>

                        <td class="cart_price">
                        {{ 'RM '.number_format(($cartItem->price),2) }}
                        </td>

                        
                      

                        <td class="cart_quantity">
                        <div>
                            {!! Form::open(['method' => 'POST','route' => ['increaseproduct',$cartItem->rowId]]) !!}
                            {{ Form::text('quantity', $cartItem->qty, ['class'=>'cart_quantity_input', 'size' =>2 ])}}
                        </div>
                        <div>
                            {{ Form::button('Update Qty', ['class' => 'btn btn-fefault update_qty', 'type' => 'submit']) }}
                            {!! Form::close() !!}
                        </div>     
                        </td>
                        
                        <!--<td class="cart_total">
                        {{-- 'RM '.number_format(($cartItem->qty * $cartItem->price),2)  --}}
                        </td>-->

                        <td class="cart_delete">
                        <a class="cart_quantity_delete" href={{ url('removefromcart/'.$cartItem->rowId) }} ><i class="fa fa-times"></i></a>
                        </td>

                    @endforeach
                </tbody>
            </table>
        </div>



        <div class="col-sm-4" style="float: left; margin-bottom: 10px;" >
            <div class="total_area">
                <ul>
                    <li>Sub Total <span>{{ Cart::subtotal() }}</span></li>
                    <li>Shipping Cost <span>Free</span></li>
                    <li> GST@6%<span>{{ Cart::tax() }}</span></li>
                    <li>Total <span>{{Cart::total()}}</span></li>

                </ul>   
                    <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>

            </div>
        </div>
   @else

   <div>
        <h2>
           No item in Shopping Cart
        </h2>
   </div>
   @endif

</div>


</section>



@endsection  
   