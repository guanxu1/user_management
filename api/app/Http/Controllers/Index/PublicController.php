<?php
namespace  App\Http\Controllers\Cms;
use DB;
use App\Http\Controllers\Controller;
/**
 * description : 公共显示（VIEW）
 * date        : 2016-02-01
 * author      : guanxu
 */
Class PublicController extends Controller {




    public function header() {


        $view = view('public/header')->with('name', 'Victoria');
        return $view;

    }


}