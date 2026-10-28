<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model{
    protected $table = 'vdyvi_k2_users';

    protected $fillable = [
        'userID', 'gender', 'description', 'image', 'role', 'sipgo_id'
    ];

    // Si el campo timestamps (created_at, updated_at) no existe en la tabla
    public $timestamps = false;
}