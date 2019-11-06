<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasApprovals,SoftDeletes;

    protected $fillable=[

        'filename',
        'size',
        'approved'

        ];


    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPathAttribute(){//se koristi za da se najdi pato na fajlojte pred da se zippira za downlodirajne posle platen fajl (na mail download.
         return storage_path('app/files/'. $this->file->identifier .'/'.$this->filename);//ova go zema celosnio pat do fajlo (primer 0 => "C:\XAMPP\htdocs\Laravel\authproba\storage\app/files/15da71ec5d2c6b/users.txt")
    }
}
