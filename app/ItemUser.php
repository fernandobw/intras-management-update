<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemUser extends Model
{
	use SoftDeletes;

    protected $table = 'vdyvi_k2_users';

    protected $primaryKey = 'userID';

    protected $dates = ['deleted_at'];

}
