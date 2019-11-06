<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Sale;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileDownloadController extends Controller
{
    //ovaj kontroler gi zema fajlojte i gi zipova za da mozi zipiran fiajl da se dowloadira od mail posle uspesen kupen fajl.
    protected $zipper;
    public function __construct(Zipper $zipper)//Zipper $zipper ti e Paket (preku composer) za zipirajne na fajloj
    {
        $this->zipper=$zipper;
    }

    public function show(File $file,Sale $sale){
        if(!$file->visible()){
            return abort(403);//ako se sluci fajlo da ne e live ili approved (to so proveruva visible funkcijata) da daj error 403
        }

        if(!$file->matchesSale($sale)){
            return abort(403);
        }

       // $this->zipper->make('')->add([])->close(); logikata zemigo zipper naprajgo fajlo ako ima pojce od eden klajgi vo array i zatvori

        //dd($file->getUploadlist());


        $this->createZipForFileInPath($file,$path=$this->generateTemporaryPath($file));//generirajne na zip fajlot na odreden fajl i klavajne na zipiranio fajl vo posakuvanata pateka (preku funkcijata generateTemporarypath)

        return response()->download($path)//downlodirajgo fajlo vo browser ($path pokazuva na fajlo kaj se najduva vo public tmp)
            ->deleteFileAfterSend(true);//i posle to deletirajgo fajlo od tmp


    }

        public function createZipForFileInPath(File $file,$path){//kreirajne zip za odreden zip so odreden lokacija


        $this->zipper->make($path)->add($file->getUploadlist())->close();//zemigo fajlot so patekata ,kaljgo vo arry(ako ima pojce fajloj getUploadList) i so zipper napraj zip fajl)
        }

        public function generateTemporaryPath(File $file){//generiram temp path za zipiranio fajl (mu klavame kako se vika zipiranio fajl)
            return public_path('tmp/' . str_slug($file->title) . '.zip');
        }

}
