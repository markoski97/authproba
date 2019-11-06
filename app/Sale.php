<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable =[
      'identifier',
        'buyer_email',
        'sale_price',
        'sale_commission'
    ];

    public function getRouteKeyName()//OVA GO KLAVAME DA ZA KOJ DA BIDI SLUG (DEFAULT E IDTO0 VO NAS SLUCAJ IDENTIFIER.
    {
       return 'identifier';
    }


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function file(){
        return $this->belongsTo(File::class);
    }

    public static function lifetimeCommission(){
        return static::get()->sum('sale_commission');
    }

    public static function mounthtimeCommission(){
        $now=Carbon::now();//momentalen datum vreme bla bla

        return static::whereBetween('created_at',[//zemigisite so spaga vo denovite megu mesecot (site fajloj so spaga samo vo mesecot kaj so se naogame momentalno)
            $now->startOfMonth(),
            $now->copy()->endOfMonth()
        ])->get()->sum('sale_commission');
    }
}
