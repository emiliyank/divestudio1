<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserService extends Model
{
    protected $fillable = ['user_id','cl_service_id','min_budget'];
    protected $user_id;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clService(){
        return $this->belongsTo(ClService::class, 'cl_service_id');
    }
}

