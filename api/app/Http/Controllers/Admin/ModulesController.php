<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Classify;
use App\Http\Model\Modules;
use App\Http\Model\ModulesFunc;
use App\Http\Model\RoleRelation;
use App\Http\Model\RoleUser;
use App\Http\Model\User;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use DB;
Class ModulesController extends Controller {

    public function select(Request $request) {

        $id = $request->input("id");
        if(empty($id))  FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\IndexController@index'),'请选择正确模块！');
        $url = Modules::where("id","=",$id)->pluck("url");
        if(strstr("@",$url))  FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\IndexController@index'),'请确认路由已注册该URL！');
        $session_modules = Session::get("modules");
        if(!empty($session_modules["function"])) {
            $request_uri = URL::action(ConstantUtil::PROJECT_ADMIN.'\\'.$url);
            if(!in_array($request_uri,$session_modules["function"])) FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\LoginController@login'),'请登录！');
        }
        $modules    = explode("@",$url);
        $class      = "App\\Http\\Controllers\\".ConstantUtil::PROJECT_ADMIN."\\".$modules[0];
        $function   = $modules[1];
        $obj = new $class();
        Session::put("select",$id);
        Session::save();
        return $obj->$function($request);
    }

    public function index() {

        $result = [];
        $list = Modules::select(
            "modules.*" ,
            "classify.name as classify_name"
        )
            ->join("classify","classify.id","=","modules.classify_id")
            ->where("modules.status","=",ConstantUtil::GLOBAL_TRUE)
            ->get()->toArray();
        foreach($list as $val) {
            $func = ModulesFunc::where("modules_id","=",$val["id"])->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
            $val["func_list"] = $func;
            $result[] = $val;
        }
        $view = view(ConstantUtil::PROJECT_ADMIN.'/modules/index')->with("list",$result);
        return $view;
    }

    public function add(Request $request) {

        $name = $request->input("name");
        $url = $request->input("url");
        $classify = $request->input("classify");
        $data["name"] = $name;
        $data["url"] = $url;
        $data["create_time"] = date("Y-m-d H:i:s");
        $data["classify_id"] = $classify;
        $data["status"] = ConstantUtil::GLOBAL_TRUE;
        $result = Modules::insert($data);

        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ModulesController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ModulesController@index'),'添加成功！');
        }

    }

    public function addView() {

        $classify = Classify::getClassify();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/modules/add')->with("list",$classify);
        return $view;

    }

    public function funcAddView(Request $request) {

        $id = $request->input("id");
        if(empty($id)) return '';
        $view = view(ConstantUtil::PROJECT_ADMIN.'/modules/funcAdd')->with("id",$id);
        return $view;

    }

    public function funcAdd(Request $request) {

        $name = $request->input("name");
        $url = $request->input("url");
        $id = $request->input("id");
        $data["name"] = $name;
        $data["url"] = $url;
        $data["create_time"] = date("Y-m-d H:i:s");
        $data["modules_id"] = $id;
        $data["status"] = ConstantUtil::GLOBAL_TRUE;
        $result = ModulesFunc::insert($data);
        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ModulesController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ModulesController@index'),'添加成功！');

        }
    }

    public function getModules($user) {
        $rank = User::where("id","=",$user)->pluck("rank");
        if($rank != ConstantUtil::POWER_SUPER_MANAGE) return self::userPower($user);
        $result = [];
        $classify = Classify::getClassify();
        foreach($classify as $val) {
            $modules = Modules::where("classify_id","=",$val["id"])->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
            $val["list"] = $modules;
            $result[] = $val;
        }
        return [
            "modules" => $result
        ];
    }


    /**
     * 获取用户权限
     * @param $user
     * @return array
     */
    private function userPower($user) {
        if(empty($user)) return false;
        $result = $modules = $modules_list = [];
        // 获取对应角色
        $role_user = RoleUser::where("user_id","=",$user)->get()->toArray();
        // 获取角色对应的权限
        foreach($role_user as $val) {
            $role_relation      = RoleRelation::where("role_id",$val["role_id"])->lists("modules_func_id")->toArray();
            $modules_id         = ModulesFunc::select(DB::raw("distinct(modules_id) as modules_id"))->whereIn("id",$role_relation)->lists("modules_id")->toArray();
            $modules_function  = Modules::whereIn("id",$modules_id)->lists("url")->toArray();
            foreach($modules_function as $val) {
                $url = URL::action(ConstantUtil::PROJECT_ADMIN."\\".$val);
                if(empty($url)) continue;
                $result["function"][] = $url;
            }
            $function           = ModulesFunc::whereIn("id",$role_relation)->lists("url")->toArray();
            foreach($function as $val) {
                $url = URL::action(ConstantUtil::PROJECT_ADMIN."\\".$val);
                if(empty($url)) continue;
                $result["function"][] = $url;
            }
            $modules_list[] = $modules_id;
        }
        // 优化权限结构
        foreach($modules_list as $val) {
            foreach($val as $val2) {
                if(!in_array($val2,$modules)) $modules[] = $val2;
            }
        }
        if(empty($modules)) return false;
        $list = Modules::select(
            "modules.*",
            "classify.name as classify_name",
            "classify.id as classify_id"
        )
            ->leftjoin("classify","classify.id","=","modules.classify_id")
            ->whereIn("modules.id",$modules)
            ->get()->toArray();
        // 编辑结果
        foreach($list as $val) {
            $data = [];
            $data["id"]     = $val["classify_id"];
            $data["name"]   = $val["classify_name"];
            $data["list"][] = $val;
            // 如果已经有值， 则只对LIST更新
            if(!empty($return[$val["classify_id"]])) {
                $return[$val["classify_id"]]["list"][] = $val;
            } else {
                $return[$val["classify_id"]] = $data;
            }
        }
        sort($return);
        $result["modules"] = $return;
        return $result;
    }

}