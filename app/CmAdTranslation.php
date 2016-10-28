<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmAdTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['title','content'];

    public function cmAd()
    {
        return $this->belongsTo(CmAd::class, 'cm_ad_id');
    }
}
