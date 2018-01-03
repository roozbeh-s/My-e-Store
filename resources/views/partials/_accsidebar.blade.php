	<div class="col-sm-3">

        <div class="acc-sidebar">
        	<div class="acc-sidebar-heading"> My Account </div>

			<ul>
				<li><a href={{ route('account') }} class="{{ Request:: is('customer/account') ? "active" : "" }}">Account Dashboard</a></li>
				<hr class="acc-hr">
				<li><a href={{ route('accountedit') }} class="{{ Request:: is('customer/edit') ? "active" : "" }}">Account Information</a></li>
				<hr class="acc-hr">
				<li>
				<a href={{ route('addressedit') }} class="{{ Request:: is('customer/edit/address') ? "active" : "" }}">Address Book</a>
				 </li>
				<hr class="acc-hr">
				<li><a href={{ route('orders') }} class="{{ Request:: is('customer/orders') ? "active" : "" }}">Orders</a></li>
				@if(!empty($order)) <li><a href={{ route('orderdetail', ['id' => $order->id])  }} class="active">> Order details</a></li>@endif
				<hr class="acc-hr">
				<li><a href={{ route('review') }} class="{{ Request:: is('customer/review') ? "active" : "" }}">Reviews</a></li>
			</ul>
        </div> 
    
      </div>  

