<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClService extends Model
{
	use Translatable;
	public $translatedAttributes = ['service'];

	public function conUserServices()
    {
        return $this->hasMany(ConUserService::class);
    }
}

