<?php

namespace App\Jobs\Checkout;

use App\Events\Checkout\SaleCreated;
use App\File;
use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateSale implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $file;
    public $email;

    public function __construct(File $file,$email)//GI ZEMAME FILE I EMAIL KAKO PARAMETRI OD FILE TABELATA
    {
        $this->file=$file;
        $this->email=$email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sale=new Sale;

        $sale->fill([
            'identifier'=>uniqid(true),
            'buyer_email'=>$this->email,
            'sale_price'=>$this->file->price,
            'sale_commission'=>$this->file->calculateCommission()//METODO SE NAJDUVA VO FILE MODEL
        ]);//OVA VNESUVA POLINA VO SALES TABELATA

        $sale->file()->associate($this->file);//DA VNESI VO BAZATA KOJ FAJL ID E OVA OD FILE BAZA
        $sale->user()->associate($this->file->user);//DA VNESI KOJ USER ID GO PREZEL FAJLO

        $sale->save();

        //OVDEKA PRAJME EVENT ZA KO CHE SE ZAVRSI JOBO EVENTO DA NAPRAJ NESTO PRIMER MAIL DA PRATI NEGDE
        event(new SaleCreated($sale));
    }
}
