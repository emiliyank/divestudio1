<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;


class CmArticleRating extends Model
{
    protected $fillable = ['cm_article_id', 'rating'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function cmArticle(){
        return $this->belongsTo(CmArticle::class, 'cm_article_id');
    }
}
