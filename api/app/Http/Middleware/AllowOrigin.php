<?php

namespace App\Http\Middleware;
use App\Http\Model\Classify;
use App\Http\Model\Modules;
use App\Utils\ConstantUtil;
use Closure;
use Session;
class AllowOrigin
{

    public function handle($request, Closure $next) {

        $modules = $this->getModules();
        session::put("modules",$modules);
        return $next($request);
    }


    /**
     * 获取模块信息
     * @return array
     *
     */
    public function getModules() {
        $result = [];
        $classify = Classify::getClassify();
        foreach($classify as $val) {
            $modules = Modules::where("classify_id","=",$val["id"])->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
            $val["modules_list"] = $modules;
            $result[] = $val;
        }
        return $result;
    }



}
