<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'vdyvi_k2_items';

    public function getImageAttribute()
    {
        if ($this->id > 150) {
            return url('/resize/articles/').'/'.md5('Image'.$this->id).'.jpg';
        }

        return url('/resize/articles/').'/'.md5('Image'.$this->id).'_L.jpg';
    }

    public function getUrlAttribute()
    {
        return url('/categorias').'/'.$this->category->alias.'/item/'.$this->id.'-'.$this->alias;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'catid', 'id');
    }

    public function getImageLocalAttribute()
    {
        if ($this->id > 150) {
            return 'images/articles/'.md5('Image'.$this->id).'.jpg';
        }

        return 'images/articles/'.md5('Image'.$this->id).'_L.jpg';
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'vdyvi_k2_tags_xref', 'itemID', 'tagID');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'created',
    ];
}
