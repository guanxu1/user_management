<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Classify;
use App\Http\Model\Modules;
use App\Http\Model\ModulesFunc;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * description : 商品
 * date        : 2016-02-18
 * author      : guanxu
 */
Class ModulesController extends Controller {

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




}