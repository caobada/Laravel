<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
	public $remember_token = false;
	protected $table = "Role";
	public function permissions() {
		return $this->belongsToMany('App\Permission', Config::get('entrust::permission_role_table'));
	}

	public function users() {
		return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('entrust.role_user_table'), Config::get('entrust.role_foreign_key'), Config::get('entrust.user_foreign_key'));
	}
}
