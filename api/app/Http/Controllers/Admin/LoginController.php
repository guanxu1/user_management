<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\User;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Session;

/**
 * description : 商品
 * date        : 2016-02-18
 * author      : guanxu
 */
Class LoginController extends Controller {

    public function login() {

        $view = view(ConstantUtil::PROJECT_ADMIN.'/login/login');
        return $view;

    }


    public function valid(Request $request) {

        $input["username"] = $request->input("username");
        $input["password"] = $request->input("password");
        $validator = Validator::make($input, [
            "username"=>"required|max:20",
            "password"=>"required|max:30"
        ]);
        if ($validator->errors()->all()) FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\LoginController@login'),'请输入正确参数');
        $user = User::where("username","=",$input["username"])
            ->where("password","=",md5($input["password"]))
            ->where("status","=",ConstantUtil::GLOBAL_TRUE)
            ->where("rank","<=",ConstantUtil::POWER_MANAGE)
            ->pluck("id");
        if(empty($user)) FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\LoginController@login'),'账户或者密码错误！');
        $ModulesController = new ModulesController();
        $modules = $ModulesController->getModules($user);
        Session::put("user",$user);
        Session::put("modules",$modules);
        Session::save();
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\IndexController@index'),'登陆成功！');

    }

    public function quit() {
        Session::flush("user");
        Session::save();
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\LoginController@login'),'退出成功！');
    }

}