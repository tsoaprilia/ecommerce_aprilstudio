<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $productName;
    public $productLink;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->productName = $order->transactions->first()->product->name_product;
        $this->productLink = $order->transactions->first()->product->link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Confirmation and Product Link')
            ->view('mail.confirmation'); // Adjust the location according to your email template
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);

        // Send confirmation email with product link
        Mail::to(Auth::user()->email)->send(new HelloMail($order));

        return Redirect::back();
    }
}
