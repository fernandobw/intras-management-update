<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'vdyvi_k2_categories';

    public function articles(){
    	return $this->hasMany(Article::class,'catid','id');
    }
}
