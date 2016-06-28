<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Classify;
use App\Http\Requests\Request;
use App\Utils\ConstantUtil;

Class ClassifyController extends Controller {

    public function index() {

        $list = Classify::getClassify();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/classify/index')->with("list",$list);
        return $view;

    }

    public function add(Request $request) {

        $name = $request->input("name");
        $data["name"] = $name;
        $data["status"] = ConstantUtil::GLOBAL_TRUE;
        $data["create_time"] = date("Y-m-d H:i:s");
        $data["classify"] = ConstantUtil::SYSTEM_ADMIN;
        $result = Classify::insert($data);
        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index'),'添加成功！');
        }

    }

    public function addView() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/classify/add');
        return $view;

    }



}