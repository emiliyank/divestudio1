<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CmOffer extends Model
{
    protected $fillable = ['price','comment','type', 'deadline', 'is_approved'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function cmAd(){
        return $this->belongsTo(CmAd::class, 'cm_ad_id');
    }
}
