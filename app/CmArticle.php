<?php

namespace App;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CmArticle extends Model
{
    use Translatable;
    public $translatedAttributes = ['topic','content'];

    protected $fillable = ['is_public', 'cl_article_type_id', 'picture', 'picture_thumb', 'is_paid'];
    protected $casts = [
        'user_id' => 'int',
    ];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function clArticleType(){
        return $this->belongsTo(ClArticleType::class, 'cl_article_type_id');
    }

    public function cmArticleRatings()
    {
        return $this->hasMany(CmArticleRating::class);
    }
}
