<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserService extends Model
{
    protected $fillable = ['user_id','cl_service_id','min_budget'];
    protected $user_id;
}

