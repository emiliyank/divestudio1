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
        'name','email','phone','password','user_type','description','cl_organization_type_id',
        'org_name','reg_number','is_receiving_emails'
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
