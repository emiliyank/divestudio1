<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;


class CmRating extends Model
{
    protected $fillable = ['cm_ad_id', 'cm_offer_id', '	user_graded_id', 'grade', '	comment'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function cmAd(){
        return $this->belongsTo(CmAd::class, 'cm_ad_id');
    }

    public function cmOffer(){
    	return $this->belongsTo(CmOffer::class, 'cm_offer_id');
    }

    public function userGraded(){
    	return $this->belongsTo(User::class, 'user_graded_id');
    }
}
