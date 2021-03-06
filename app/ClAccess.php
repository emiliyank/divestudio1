<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClAccess extends Model
{
	use Translatable;
	public $translatedAttributes = ['access'];

    public function conRoleAccesses()
    {
    	return $this->hasMany(ConRoleAccess::class, 'id');
    }
}

