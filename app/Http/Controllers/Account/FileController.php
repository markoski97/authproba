<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FileController extends Controller
{
    public function index(Request $request){
        $files=auth()->user()->files()->latest()->finnished()->get();
        return view('account.files.index',compact('files'));

    }

    public function edit(File $file){
            return view('account.files.edit',[
                'file'=>$file,
                'approval'=>$file->approvals()->first(),
            ]);
    }

    public function update(File $file,UpdateFileRequest $request){
        $this->authorize('touch',$file);
        $approvalproperties=$request->only(File::APPROVAL_PROPERTIES);
        if ($file->needsApproval($approvalproperties))
        {
           $file->createAproval($approvalproperties);
           return back()->withSuccess('thanks we will review you cnahjges soon');
        }

        $file->update($request->only(['live','price']));
        return back()->withSuccess('File Updated');
    }

    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createAndReturnSkeletonFile();

            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch',$file);


            return view('account.files.create',compact('file'));
    }

    public function store(File $file,StoreFileRequest $request){

        $this->authorize('touch',$file);//OVA GO KLAVAME ZA DA SE VIDI DALI FAJLO PRIPAJCA NA USERO


        $file->fill($request->only(['title','overview','overview_short','price']));
        $file->finished=true;
        $file->save();


        return redirect()->route('account.files.index')->withSuccess('Thanks,its subbmited for review. ');

    }

    public function createAndReturnSkeletonFile(){
        return auth()->user()->files()->create([

            'title'=>'Untitled',
            'overview'=>'None',
             'overview_short'=>'None',
            'price'=>0,
            'finished'=>false,

        ]);
    }
}
