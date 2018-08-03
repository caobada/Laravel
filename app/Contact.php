<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
	//
	protected $table = "contacts";
	public $remember_token = false;
	protected $fillable = [
		'id', 'hoten', 'email', 'contents', 'read',
	];
}
