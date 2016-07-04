<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Classify;
use Illuminate\Http\Request;
use App\Utils\ConstantUtil;
use Illuminate\Support\Facades\URL;

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


    public function editorView(Request $request) {
        $id = $request->input("id");
        if(empty($id)) return '';
        $list = Classify::where("id","=",$id)->first()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/classify/editor')->with("list",$list);
        return $view;

    }
    public function editor(Request $request) {
        $id = $request->input("id");
        $name = $request->input("name");
        if(empty($id)) return '';
        Classify::where("id","=",$id)->update(["name"=>$name]);
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index'),'添加成功！');

    }
    public function delete(Request $request) {
        $id = $request->input("id");
        if(empty($id)) return '';
        Classify::where("id","=",$id)->delete();
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index'),'删除成功！');
    }


}