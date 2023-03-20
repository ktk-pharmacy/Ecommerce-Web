<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $orderStatus;
    public $orderCancelRemark;
    public $deliveryRefrenceNumber;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderStatus = $this->orderStatus;
        return $this->subject("Order $this->orderStatus")
                    ->view('emails.order-status', compact('orderStatus'));
    }
}
