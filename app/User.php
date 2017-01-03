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
        'username','reg_number','vat_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userType()
    {
        return $this->belongsTo(ClRole::class, 'user_type', 'code');
    }

    public function clAccesses(){
        return $this->belongsToMany(ClAccess::class, 'con_role_access');
    }
    
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
