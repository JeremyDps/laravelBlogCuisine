<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps = false;

    public function articles() {
        return $this->belongsToMany('App\Article', 'article_categorie');
    }
}
