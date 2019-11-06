<?php
namespace App\Http\ViewComposers;

use App\File;
use App\Sale;
use Carbon\Carbon;
use Illuminate\View\View;

class AdminStatsComposer{//GI NAZNACUVAME ELEMENTITE I SO VREDNOSTI DA DOBIJA PRIMER 'fileCount'

    public function compose(View $view){





        $view->with([
            'fileCount'=>File::finnished()->approved()->count(),//zemigisite fajloj od file tabelata i so se approved i izbroj gi
            'saleCount'=>Sale::count(),//site sale brojki i soberigi
            'lifetimeCommission'=>Sale::lifetimeCommission(),//zemigi site od sale tabela kolona sale_commission i soberigi
            'mouthtimeCommission'=>Sale::mounthtimeCommission(),//zemigi site od sale od kolona sale_commission so spaga vo mesec samo



        ]);
    }
}