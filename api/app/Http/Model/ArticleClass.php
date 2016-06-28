<?php
namespace  App\Http\Model;
use Illuminate\Database\Eloquent\Model;
class ArticleClass  extends  Model{
    protected $connection = 'user';
    protected $table = 'article_class';
    public $timestamps = false;
    /**
     * 查询类
     * @return mixed
     */

}