<?php

namespace App;

use App\CmAd;
use Dimsav\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Translatable;
    public $translatedAttributes = ['name', 'org_name', 'address', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','phone','password','user_type','cl_organization_type_id',
        'reg_number','is_receiving_emails'
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

    public function conUserServices()
    {
        return $this->hasMany(ConUserService::class);
    }

    public function conUserRegions()
    {
        return $this->hasMany(ConUserRegion::class);
    }

    public function conUserLanguages()
    {
        return $this->hasMany(ConUserLanguage::class);
    }
}
