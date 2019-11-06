<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Mail\Files\FileApproved;
use App\Mail\Files\FileRejected;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FileNewController extends Controller
{
    public function index(){
        $files=File::unapproved()->oldest()->get();
        return view('admin.files.new.index',compact('files'));
    }

    public function update(File $file){

       $file->approve();

        Mail::to($file->user)->send(new FileApproved($file)); //go fajcame mailo od usero (->user) i mu prajcame file approved (Mail->Fileapproved.php)

        return back()->withSuccess("{$file->title} has been approved");
    }

    public function destroy(File $file){//destroy method se korisiti za ko che se rejecktni od admin fajlo da se izbrisi od baza.

        $file->delete();
        $file->uploads->each->delete();


        Mail::to($file->user)->send(new FileRejected($file)); //go fajcame mailo od usero i mu prajcame file delete (Mail->File rejected

        return back()->withSuccess("{$file->title} has benn rejected");


    }
}
