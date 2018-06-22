<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model {
	//
	public $timestamps = false;
	protected $table = "Role_User";
	public function user() {
		return $this->belongsTo('App\User', 'id', 'user_id');
	}
}
