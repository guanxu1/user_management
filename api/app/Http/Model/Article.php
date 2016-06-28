<?php
namespace  App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
class Article extends  Model{
    protected $connection = 'user';
    protected $table = 'article';
    public $timestamps = false;





}