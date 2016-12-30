<?php

namespace App;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CmStaticPage extends Model
{
    use Translatable;
    public $translatedAttributes = ['topic','content'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public static function getHomeSliderPageId(){
    	return self::select('id')->where('is_home_slider', 1)->first();
    }

}
