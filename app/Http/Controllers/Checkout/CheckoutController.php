<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Jobs\Checkout\CreateSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function free(FreeCheckoutRequest $request, File $file)
    {

        if (!$file->isFree()) {//Proverka vo sekoj slucaj dali e fajlo free.Ako fajlo ne e frii vrati gi nazad
            return back();
        }

        //Kreirame job za da kreira sale a vo jobo che kreirame event primer za po uspesen sale mail da prati negde

        dispatch(new CreateSale($file,$request->email));
        //CreateSale->SaleCreated->EventServiceProvider(tugka gi registrirame listenerite)->sendEmailToBuyer(posleden step).
        return back()->withSuccess('We\'ve emailed your download lik to you.');//flash message posle uspesno vnesuvajne na mail

    }

    public function payment(Request $request,File $file){

       try{
            $charge=Charge::create([
               'amount'=>$file->price*100,
               'currency'=>'usd',
                'source'=>$request->stripeToken,

                'application_fee'=> $file->calculateCommission() * 100,
            ],
                [
                    'stripe_account'=>$file->user->stripe_id
                ]);
       }
       catch(Exception $e){
           return back()->withError('Something went wrong');
       }
        dispatch(new CreateSale($file,$request->stripeEmail));
       return back()->withSuccess('Payment complete,We\'ve emailed your download lik to you.');

    }
}
