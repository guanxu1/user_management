<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class RoleRelation extends Model
{
    protected $connection = 'user';
    protected $table = 'role_relation';
    public $timestamps = false;
    private $db;

    public function add($post) {
        if(empty($post["id"])) return false;
        $id = $post["id"];
        $modules = $post["modules"];
        $date = date("Y-m-d H:i:s");
        $this->db = DB::connection($this->connection);
        $this->db->beginTransaction();
        try{
            $this->db->table($this->table)->where("role_id","=",$id)->delete();
            if(!empty($modules)) {
                foreach($modules as $val) {
                    $data = [];
                    $data["role_id"] = $id;
                    $data["modules_func_id"] = $val;
                    $data["create_time"] = $date;
                    $this->db->table($this->table)->insert($data);
                }
            }
            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollback();
            return false;
        }

    }
}
