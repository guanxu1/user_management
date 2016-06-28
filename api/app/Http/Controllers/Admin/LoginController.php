<?php
namespace  App\Http\Controllers\Admin;
use App\Utils\ConstantUtil;

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
}