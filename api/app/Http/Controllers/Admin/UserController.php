<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\User;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * description : 商品
 * date        : 2016-02-18
 * author      : guanxu
 */
Class UserController extends Controller {

    public function index() {


        $list = User::where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/index')->with("list",$list);
        return $view;

    }

    public function addView() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/add');
        return $view;

    }

    public function add(Request $request) {

        $data["username"]   = $request->input("username");
        $data["password"]   = $request->input("password");
        $data["mobile"]     = $request->input("mobile");
        $data["rank"]       = $request->input("rank");
        $data["name"]       = $request->input("name");
        $data["create_time"]= date("Y-m-d H:i:s");
        $data["status"]     =  ConstantUtil::GLOBAL_TRUE;
        $result = User::insert($data);
        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\UserController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\UserController@index'),'添加成功！');
        }


    }


    public function editorView() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/add');
        return $view;

    }
    public function editor() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/add');
        return $view;

    }
    public function delete() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/add');
        return $view;

    }

    public function update() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/user/add');
        return $view;

    }

}