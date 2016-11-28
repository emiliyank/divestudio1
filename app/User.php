<?php

namespace App;

use App\CmAd;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','phone','password','user_type','cl_organization_type_id',
        'reg_number','vat_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function ads(){
        return $this->hasMany(Ad::class);
    }
}
