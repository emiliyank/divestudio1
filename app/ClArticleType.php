<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClArticleType extends Model
{
	use Translatable;
	public $translatedAttributes = ['article_type'];
}

