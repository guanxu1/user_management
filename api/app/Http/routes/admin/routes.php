<?php
Route::group(array('middleware' => 'valid'), function() {

    Route::any("/admin/index"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\IndexController@index');
    Route::any("/admin/modules/add/view"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@addView');
    Route::any("/admin/modules/index"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@index');
    Route::any("/admin/classify/index"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index');
    Route::any("/admin/classify/add"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ClassifyController@addView');





});