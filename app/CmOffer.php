<?php

namespace App;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class CmOffer extends Model
{
	use Translatable;
	public $translatedAttributes = ['comment','type'];

    protected $fillable = ['price', 'deadline', 'is_approved'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function cmAd(){
        return $this->belongsTo(CmAd::class, 'cm_ad_id');
    }
}
