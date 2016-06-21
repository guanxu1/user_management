<?php
namespace  App\Http\Controllers\Admin;
use App\Utils\ConstantUtil;

/**
 * description : 商品
 * date        : 2016-02-18
 * author      : guanxu
 */
Class ModulesController extends Controller {

    public function index() {




    }

    public function add() {


    }

    public function addView() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/modules/add');
        return $view;

    }



}