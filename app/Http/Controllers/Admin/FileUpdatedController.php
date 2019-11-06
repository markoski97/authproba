<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Mail\Update\UpdateApproved;
use App\Mail\Update\UpdateRejected;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FileUpdatedController extends Controller
{
   public function index(){
        $files=File::whereHas('approvals')->oldest()->get();

        return view('admin.files.updated.index',compact('files'));
   }
   
   public function update(File $file){

        $file->mergeApprovalProperties();
        $file->approveAllUploads();
        $file->deleteAllApprovals();

        Mail::to($file->user)->send(new UpdateApproved($file));

       return back()->withSuccess("{$file->title}changes have been approved");
   }

   public function destroy(File $file){
        $file->deleteAllApprovals();
        $file->deleteUnapprovedUploads();

       Mail::to($file->user)->send(new UpdateRejected($file));
       return back()->withSucess("{$file->title} changes has been rejected");
   }
}
