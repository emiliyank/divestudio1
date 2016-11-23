<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CmOfferTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['comment', 'type'];

    public function cmOffer()
    {
        return $this->belongsTo(CmOffer::class, 'cm_offer_id');
    }
}
