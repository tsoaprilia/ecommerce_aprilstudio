<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $productNames;
    public $productLinks;

    /**
     * Create a new message instance.
     *
     * @param string $productNames
     * @param string $productLinks
     * @return void
     */
    public function __construct($productNames, $productLinks)
    {
        $this->productNames = $productNames;
        $this->productLinks = $productLinks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('viewmail');
    }
}
