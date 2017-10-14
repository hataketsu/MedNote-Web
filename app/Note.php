<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model {
	use SoftDeletes;
	protected $fillable = [ 'title', 'content' ,'updated_at','created_at'];

}
