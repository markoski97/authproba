<?php
namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\View\View;

class AccountStatsComposer{//GI NAZNACUVAME ELEMENTITE I SO VREDNOSTI DA DOBIJA PRIMER 'fileCount'

    public function compose(View $view){

        $user=auth()->user();//za da se zemi odredenio logiran user

        $files=$user->files()->finnished();//zemigi site fajloj so finnished (appruvnati od admin)

        $sales=$user->sales;//zemigi site sales

        $lifetimeEarned=$user->sales->sum('sale_price');//zemigisite sales i soberigi site vrednosti od sale_price za da se dobija liftime kolku naprajl usero

        $now=Carbon::now();//ZEMIGO DENESNIO DATUM KOJ E
        //ZEMIGI SITE SALES OD USERO KADE STO CREATED_AT TABELATA E MEGU DATUMITE:
        $mouthtimeEarned=$user->sales()->whereBetween('created_at',[
                $now->startOfMonth(),//POCETOK NA MESEC
                $now->copy()->endOfMonth(),//KRAJ NA MESEC
        ])->get()->sum('sale_price');//SOBERIGI SITE STO SE NAJDUVAAT

        //sega ovdeka gi klavame site variabli so gi definiravme gore vo $view seto ova posle odi vo ComposerServicerProvider
        $view->with([
            'fileCount'=>$files->count(),
            'saleCount'=>$sales->count(),
            'lifetimeEarned'=>$lifetimeEarned,
            'mouthtimeEarned'=>$mouthtimeEarned,

        ]);
    }
}