<?php
namespace  App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class ColumnRelation  extends  Model{


    protected $connection = 'user';
    protected $table = 'column_relation';
    public $timestamps = false;




}