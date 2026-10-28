<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class TagXref extends Model
{
    protected $table = 'vdyvi_k2_tags_xref';

    public $timestamps = false;

    public function article(){
    	return $this->belongsTo(Article::class,'itemID','id');
    }
}
