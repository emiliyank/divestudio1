<?php

namespace App;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CmAd extends Model
{
    use Translatable;
    public $translatedAttributes = ['title','content'];

    protected $fillable = ['service_id'];
    protected $casts = [
        'user_id' => 'int',
    ];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function clRegion(){
        return $this->belongsTo(ClRegion::class, 'cl_region_id');
    }
    
    public function clService(){
        return $this->belongsTo(ClService::class, 'service_id');
    }

     public function cmOffers(){
        return $this->hasMany(CmOffer::class);
    }
}
