<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    //
    public $remember_token = false;
    protected $table = "HomeType";
    public function home(){
    	return $this->hasMany('App\Home','type_id','id');
    }
}
