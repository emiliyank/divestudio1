<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClArticleTypeTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['article_type'];

    public function cmArticle()
    {
        return $this->belongsTo(CmArticle::class, 'cl_article_type_id');
    }
}
