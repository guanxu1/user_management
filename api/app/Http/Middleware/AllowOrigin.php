<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Model\Modules;
use App\Utils\ConstantUtil;
use Closure;
use Illuminate\Support\Facades\URL;
use Session;
class AllowOrigin
{
    public function handle($request, Closure $next) {
        /**
         * 模块权限未做完  需要认证URL地址
         */
        $user = Session::get("user");
        if(empty($user)) FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\LoginController@login'),'请登录！');
        $modules = Session::get("modules");
        $url = FunctionController::getUrl();
        if(!empty($modules["function"])) {



        }
        return $next($request);

    }

}
