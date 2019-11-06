<?php

namespace App\Mail\Checkout;

use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sale;
    public function __construct(Sale $sale)//zemame podatoci za sale
    {
        $this->sale=$sale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your purchase conrfrimation')->view('email.checkout.confirmation');
    }
}
