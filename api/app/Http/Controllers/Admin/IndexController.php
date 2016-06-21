<?php
namespace  App\Http\Controllers\Admin;
use App\Utils\ConstantUtil;

/**
 * description : 商品
 * date        : 2016-02-18
 * author      : guanxu
 */
Class IndexController extends Controller {

    public function index() {




        $view = view(ConstantUtil::PROJECT_ADMIN.'/index/index');
        return $view;



    }
}