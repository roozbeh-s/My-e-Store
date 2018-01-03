<!DOCTYPE html>
<html lang="en">

<title>Order Confirmation</title>

<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; font-family: Arial, Verdana, Sans-serif;">

	<table width="100%" height="100%"; cellpadding="0"; style="padding:20px 0px 20px 0px;" bgcolor="#ececec">	
		<tr align="center">
			<td>
				<table width="562" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="color: #000000; 
				padding: 16px 16px 16px 14px; font-family: Arial, verdana, Sans-serif; ">
					<tr>
						<td>
							<a href="{{ route('home') }}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
						</td>	
					</tr>
					
					<tr>
					<td>
					<hr>
					</td>
					</tr>
					
	
					<!-- line breaker -->
					<tr>
						<td style="padding-top:10px;"> Dear {{$user->name}},</td>	
					</tr>
					<tr>
						<td style="padding-top:10px; padding-bottom:20px;"> Your Order # {{ $order->id }} has been placed on {{ Carbon\Carbon::parse($order->created_at)->addHours(8)->format('Y-m-d') }}. You will be updated with another email shortly when the items are shipped.
						*Please take note of the expected delivery date of your order. Items shipped from overseas will have a longer delivery time.</td>
					</tr>
					
					<tr>
					<td bgcolor="f2f4f6" style="padding-top:10px; border-top: solid 2px #646464;">
					
					<table width="48%" style="float:left; margin-top:10px;">
					<tr>
					<td style="font-size:13px;">This order will arrive by:<br><br>
					Shipment # 1: 15 Sep - 20 Sep, 2017<br><br>
					<a valign="center" style="-webkit-appearance: button; -moz-appearance: button; appearance: button; text-decoration: none; width:100%; padding-bottom:10px; padding-top:10px; background-color: #FE980F; border: 0; color: #FFFFFF; text-align: center;" href="{{ route('orderdetail', ['id' => $order->id]) }}">ORDER STATUS</a></td>
					</tr>
					</table>
					
					<table width="50%" style="float:right; margin-top:10px; margin-left:5px;">
					<tr>
					<td style="font-size:13px;">
					Your Order will be delivered to:<br><br>
					{{ $orderaddress->receiver }}<br><br>	
					{{$orderaddress->addr_first_line.', '.$orderaddress->addr_second_line.', '.$orderaddress->city.', '.$orderaddress->province->name.', '.$orderaddress->nation->name.', '.$orderaddress->postcode }}<br> 
					</td>
					</tr>
					</table>
					
					</td>
					</tr>
					
					<tr>
					<td style="padding-top:10px; font-weight:bold;">Order details:</td>
					</tr>
					
					<tr><td style="height:10px;"></td></tr>
					
					<tr>
					<td style="padding-top:10px; border-collapse: collapse; border-top: 1px dashed rgb(231, 235, 237); border-right: 1px dashed rgb(231, 235, 237); border-left: 1px dashed rgb(231, 235, 237); border-image: initial; border-bottom: none; font-size:13px;">
					<table width="100%">
					@foreach($order->items as $item)	
					<tr>
					@if($item->thumbnailPath)	
					<td style="width:20%;"><img style="height: 42px; width: 42px;" src={{ URL::asset("$item->thumbnailPath") }} alt="" /></td>
					@endif 	
					<td style="width:60%; padding-left:5px;">
					{{ $item->product_name }} {{' X '.$item->qty }} 
					</td>
					<td style="width:20%; text-align:right; padding-right:5px; font-weight:bold;">
					{{ 'RM '.$item->product_price }}
					</td>
					</tr>
					@endforeach
					</table>
					</td>
					</tr>
					
					<tr>
					<td style="border-collapse: collapse; border-top: 1px dashed rgb(231, 235, 237); border-right: 1px dashed rgb(231, 235, 237); border-left: 1px dashed rgb(231, 235, 237); border-image: initial; border-bottom: none; font-size:13px;">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" align="left" style="border-spacing: 0px; border-collapse: collapse; font-size: 14px; width: 100% !important;">
					<tr>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(100, 100, 100); width: 80%;">
					Subtotal:
					</td>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(41, 41, 41); min-width: 140px;">{{ 'RM '.$order->subtotal }}</td>
					</tr>
					</table>
					</td>
					</tr>
					
					<tr>
					<td style="border-collapse: collapse; border-right: 1px dashed rgb(231, 235, 237); border-left: 1px dashed rgb(231, 235, 237); border-image: initial; border-bottom: none; font-size:13px;">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" align="left" style="border-spacing: 0px; border-collapse: collapse; font-size: 14px; width: 100% !important;">
					<tr>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(100, 100, 100); width: 80%;">
					Shipping Fee:
					</td>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(41, 41, 41); min-width: 140px;">{{ 'RM '.number_format($order->shipping_fee, 2, '.','') }}</td>
					</tr>
					</table>
					</td>
					</tr>
					
					<tr>
					<td style="border-collapse: collapse;border-right: 1px dashed rgb(231, 235, 237); border-left: 1px dashed rgb(231, 235, 237); border-image: initial; border-bottom: none; font-size:13px;">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" align="left" style="border-spacing: 0px; border-collapse: collapse; font-size: 14px; width: 100% !important;">
					<tr>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(100, 100, 100); width: 80%; font-weight:bold;">
					Total:
					</td>
					<td valign="top" align="right" style="border-collapse: collapse; padding-top: 10px; padding-right: 10px; color: rgb(41, 41, 41); min-width: 140px; font-weight:bold; padding-bottom:10px;">{{ 'RM '.$order->total }}</td>
					</tr>
					</table>
					</td>
					</tr>
					
					<tr>
					<td style="border-top: 1px dashed rgb(231, 235, 237); text-align:center; padding-top:5px;">etrademe.com</td>
					</tr>

				</table>
			</td>	
		</tr>		
	</table>
</body>

</html>
