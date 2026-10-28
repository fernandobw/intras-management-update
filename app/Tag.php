<?php

namespace App;

use App\TagXref;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'vdyvi_k2_tags';

    public $timestamps = false;

    public function tagXrefs()
    {
        return $this->hasMany(TagXref::class, 'tagID', 'id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'vdyvi_k2_tags_xref', 'tagID', 'itemID')
        ->where('published', 1)
        ->orderBy('itemID', 'desc');
    }
}
