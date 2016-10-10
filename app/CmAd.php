<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CmAd extends Model
{
    protected $fillable = ['title','content','service_id'];
    protected $casts = [
        'user_id' => 'int',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function clRegion(){
        return $this->belongsTo(ClRegion::class, 'cl_region_id');
    }
    
    public function clService(){
        return $this->belongsTo(ClService::class, 'service_id');
    }
}
