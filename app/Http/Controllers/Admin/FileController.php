<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    //ovaj kontroller se koristi za admin da ima preview na promeneti fajloj (buttono preview changes

    public function show(File $file){

        $file=$this->replaceFilePropertiesWithUnapprovedChanges($file);//Metod za unaproved files admin da mozi da gi vidi changes sho gi napraraj usero


        $uploads=$file->uploads;
        return view('filies.show',compact('file','uploads'));
    }

    protected function replaceFilePropertiesWithUnapprovedChanges( $file){
        if($file->approvals->count()){//AKO $file CHEKA APROVAL (COUNT TO PROVERUVA)
            $file->fill($file->approvals->first()->toArray());//go zemame file i mu prajme fill SO SITE PARAMETRI OD APPROVALS (TO SO SME SMENILE SO CHEKA APPROVAL OD ADMIN)
        }
        return $file;
    }
}
