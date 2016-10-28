<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClService extends Model
{
	use Translatable;
	public $translatedAttributes = ['service'];
}

