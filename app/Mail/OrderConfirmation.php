<?php

namespace App\Mail;

use App\Order;
use Auth;
use App\orderaddress;




use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $orderaddress;

    
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, OrderAddress $orderaddress)
    
    {
        
        $this->order = $order;
        $this->user = Auth::user();
        $this->orderaddress=$orderaddress;
       
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        

        return $this->from('orders@etrademe.com')
                ->subject('Order Confirmation '.$this->order->id)
                ->markdown('emails.order.orderconfirmation')->with('order',$this->order)->with('user',$this->user);


 
    }
}
