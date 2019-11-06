<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class File extends Model
{
    use HasApprovals, SoftDeletes;

    const APPROVAL_PROPERTIES = [ //ova ni treba za ko che prajme approval radi to so samo tie 3 ni se bitni ko che se menuva nesto
        'title',
        'overview_short',
        'overview',
    ];


    protected $fillable = [
        'title',
        'overview_short',
        'overview',
        'price',
        'live',
        'approved',
        'finished'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($file) {

            $file->identifier = uniqid(true);
        });
    }

    public function getRouteKeyName()
    {
        return 'identifier';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFinnished(Builder $builder)
    {

        return $builder->where('finished', true);

    }

    public function isFree()
    {
        return $this->price == 0;
    }


    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }

    public function needsApproval(array $approvalproperties)
    {

        if ($this->currentPropertiesDifferToGiven($approvalproperties)) {
            return true;
        }
        if ($this->uploads()->unapproved()->count()) {
            return true;
        }
        return false;
    }

    public function createAproval(array $approvalproperties)
    {
        $this->approvals()->create($approvalproperties);

    }

    protected function currentPropertiesDifferToGiven(array $properties)
    {

        return array($this->toArray(), self::APPROVAL_PROPERTIES != $properties);

    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function approve()
    {//OVA VO FILE NEW CONTROLLER SE KORISTI ZA APROVE VO BAZATA DA STANI 1 OD 0 ILI OD APROVE VO NOT APROVED
        $this->updateToBeVisible();

        $this->approveAllUploads();

    }

    public function approveAllUploads()
    {

        $this->uploads()->update([
            'approved' => true
        ]);
    }

    public function updateToBeVisible()
    {
        $this->update([
            'live' => true,
            'approved' => true,
        ]);
    }


    public function mergeApprovalProperties()
    {//OVA FUNKCIJA SE KORISTI ZA UPDATE APPRUVAL DA SE SPOJAT APPROVAL FILE I FILE VO FILE TABELATA

        $this->update(array_only($this->approvals->first()->toArray(),
            self::APPROVAL_PROPERTIES));//provoto gi zema od approvals tabelata site a posle so self mu kazuvame samo da gi zemi tie so se najduva vo metodo properties

    }

    public function deleteAllApprovals()
    {//ZA da go deletira approvalo od tabelata appruval posle uspesno approve
        $this->approvals()->delete();
    }

    public function deleteUnapprovedUploads()
    {
        $this->uploads()->unapproved()->delete();
    }

    public function visible()
    {
        if (auth()->user()->isAdmin()) {//OVA E ZA ADMIN DA MOZI DA GI GLEDA SITE POSTOJ (NEMORA DA SE APPROVED ILI LIVE)
            return true;
        }
        if (auth()->user()->id === $this->user->id) {//OVA E ZA USERO DA MOZI DA SI GI GLEDA SITE SVOJ POSTOJ (NEMORA DA SE APPROVED ILI LIVE)
            return true;
        }
        return $this->live && $this->approved;//AKO E APPROVED I LIVEE 1VO BAZA (TRUE) POKAZIGO NA PUBLIC VIEW FAJLO AKO NE E FRLI 404
    }

    public function matchesSale(Sale $sale){ //ova funkcija praj match so sale i fajl za da mozi usero da ja downloadira odredenio falj (sprema sale) a ne site fajloj

        return $this->sales->contains($sale);
    }

    public function getUploadlist(){//gi zema site fajloj so se approved so pato (pluck ('path') i gi matchova vo GetAtributePath ( vo Uploads model) funkcija

        return $this->uploads()->approved()->get()->pluck('path')->toArray();

    }

    public function sales()
    {
        return $this->hasMany(Sale::class);//OVA E SO SALE TABELATA POVRZANO
    }

    public function calculateCommission()//kalkulirajne na procent so zadrzuva stranata od vkupnata prodazba (se koristi vo Sale bazata i vo CrateSale job)
    {
        return ((config('filemarket.sales.commission'))/100)*$this->price; //za da ne menuvame direk vo funkcijata prajme fajl vo confing i tamu menuvame vrednost posle kako string
    }
}
