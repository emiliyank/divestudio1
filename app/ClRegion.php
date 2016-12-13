<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClRegion extends Model
{
	use Translatable;
	public $translatedAttributes = ['region'];

	public function cmAds(){
        return $this->belongsToMany(CmAd::class, 'con_ad_regions');
    }
}

