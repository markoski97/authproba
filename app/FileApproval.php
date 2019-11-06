<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileApproval extends Model
{
    use SoftDeletes;

    protected $table='file_approvals';

    protected $fillable=[
        'title',
        'overview_short',
        'overview',
    ];

    protected static function boot(){//ova se klava za samo poslednio approval so e pobaran pri editirajne da go gleda admino.
        parent::boot();
        static::creating(function($approval){
            $approval->file->approvals->each->delete();
        });
    }

    public function file(){
        return $this->belongsTo(File::class);
    }
}
