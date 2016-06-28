<?php
namespace  App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\FunctionController;
use DB;
class Column extends  Model{


    protected $connection = 'user';
    protected $table = 'column';
    protected $db;
    public $timestamps = false;

    /**
     * 栏目添加
     * @param $post
     * @return bool
     */
    public  function add($post) {
        $uploadImg = FunctionController::uploadImg();
        $this->db = DB::connection($this->connection);
        $this->db->beginTransaction();
        try{
            $date = date("Y-m-d H:i:s");
            $column['name']                 = $post["name"];
            $column['sort']                 = $post["sort"];
            $column['content']              = $post["content"];
            $column['title_img']            = empty($uploadImg["title_img"]["url"]) ? "" : $uploadImg["title_img"]["url"] ;
            $column['create_time']          = $date;
            $column_id = $this->db->table('column')->insertGetId($column);
            $data["column_id"]      = $column_id;
            $data["column_parent"]  = $post["parent_id"];
            $data["create_time"]    = $date;
            $rank = ColumnRelation::where("column_id","=",$data["column_parent"])->select()->get()->toArray();
            $data["rank"]           = $rank[0]["rank"]+1;
            $data["number"]         = $rank[0]["number"].sprintf("%04d", $data["column_id"]);
            $this->db->table('column_relation')->insert($data);
            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollback();
            return false;
        }


    }

    public static  function getName($id) {
        if(empty($id)) return false;
        return self::where("id","=",$id)->pluck("name");
    }


}