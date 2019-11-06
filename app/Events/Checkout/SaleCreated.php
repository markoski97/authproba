<?php

namespace App\Events\Checkout;

use App\Sale;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaleCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $sale;
    public function __construct(Sale $sale)//koristime se od sale tabelata
    {
        $this->sale=$sale;//GI ZEMAME SITE PODATOCI OD KREIRANIO SALE (PREKU JOBO)
    }
    //POSLE OVA ODI VO EVENT SERVICE PROVIDER VO PROVIDERS I NAZNACUVA EVENT SO KOJ GO PRAKAME EMAILOT
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

}
