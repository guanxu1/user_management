<?php
namespace  App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends  Model{


    protected $connection = 'user';
    protected $table = 'user';
    public $timestamps = false;

}