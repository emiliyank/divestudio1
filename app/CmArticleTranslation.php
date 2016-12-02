<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmArticleTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['title','content'];

    public function cmArticle()
    {
        return $this->belongsTo(CmArticle::class, 'cm_article_id');
    }
}
