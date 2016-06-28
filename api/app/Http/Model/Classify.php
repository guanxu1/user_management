<?php

namespace App\Http\Model;

use App\Utils\ConstantUtil;
use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{

    protected $connection = 'user';
    protected $table = 'classify';
    public $timestamps = false;


    public static function getClassify() {
        return self::where("status","=",ConstantUtil::GLOBAL_TRUE)->where("classify","=",ConstantUtil::SYSTEM_ADMIN)->get()->toArray();
    }

    public static function getClassifyModules() {
        $result = [];
        $classify = self::getClassify();
        foreach($classify as $val) {
            $modules =  Modules::where("classify_id","=",$val["id"])->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
            foreach($modules as $key => $val2) {
                $modules_func = ModulesFunc::where("modules_id","=",$val2["id"])->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
                $modules[$key]["modules_func_list"] = $modules_func;
            }
            $val["modules_list"] = $modules;
            $result[] = $val;
        }
        return $result;
    }
}
