<?php
Route::group(array('middleware' => 'valid'), function() {

    Route::any("/admin/index"                   , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\IndexController@index');
    /**
     * 模块管理
     */
    Route::any("/admin/modules/select"             , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@select');    // 选择模块

    Route::any("/admin/modules/add/view"        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@addView');
    Route::any("/admin/modules/add"             , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@add');
    Route::any("/admin/modules/index"           , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@index');
    Route::any("/admin/classify/index"          , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ClassifyController@index');
    Route::any("/admin/classify/add/view"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ClassifyController@addView');
    Route::any("/admin/classify/add"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ClassifyController@add');
    Route::any("/admin/modules/func/add/view"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAddView');
    Route::any("/admin/modules/func/add"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAdd');
    Route::any("/admin/modules/func/delete"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcDelete');
    Route::any("/admin/modules/func/editor"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcEditor');
    /**
     * 角色管理
     */
    Route::any("/admin/role/index"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@index');
    Route::any("/admin/classify/add"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@add');
    Route::any("/admin/classify/add/view"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@addView');
    Route::any("/admin/role/relation/editor/view"               , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditorView');
    Route::any("/admin/role/relation/editor"                    , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditor');
    Route::any("/admin/role/relation/user/view"                    , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@userEditor');
    Route::any("/admin/role/relation/user"                    , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@userEditorView');

    /**
     * 用户管理
     */
    Route::any("/admin/user/index"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@index');
    Route::any("/admin/user/add/view"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@addView');
    Route::any("/admin/user/add"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@add');
    Route::any("/admin/user/editor/view"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@editorView');
    Route::any("/admin/user/editor"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@editor');
    Route::any("/admin/user/delete"                              , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@delete');
    Route::any("/admin/user/update"                          , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@update');


    /**
     * 文章管理
     */
    Route::any("/admin/article/index"                          , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@index');
    Route::any("/admin/article/add"                        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@add');                // 文章添加
    Route::any("/admin/article/editor"                  , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@editor');             // 文章编辑
    Route::any("/admin/article/editor/view"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@editorShow');         // 文章编辑页面
    Route::any("/admin/article/add/view"                          , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@addShow');
    Route::any("/admin/article/update"           , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@status');             // 文章状态修改
    Route::any("/admin/article/delete"           , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@delete');             // 文章删除
    // 栏目
    Route::any("/admin/article/column/index"                          , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@index');
    Route::any("/admin/article/column/addShow"                    , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@addShow');            // 栏目添加页面
    Route::any("/admin/article/column/add"                        , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@add');                // 栏目添加
    Route::any("/admin/article/column/editorShow"                 , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@editorShow');         // 栏目编辑页面
    Route::any("/admin/article/column/editor"                     , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@editor');             // 栏目编辑
    Route::any("/admin/article/column/delete"                     , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@delete');             // 栏目删除
    Route::any("/admin/article/column/info"                       , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@info');               // 栏目信息
    Route::any("/admin/article/column/rank2List"                  , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@rank2List');          // 栏目级别2列表
    Route::any("/admin/article/column/sonList"                    , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@sonList');            // 子栏目列表
    Route::any("/admin/article/column/numberToArticle"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@numberToArticle');    // 栏目序号查询文章


    Route::any ("/admin/login/quit"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\LoginController@quit');    // 退出



});


Route::any ("/admin/login"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\LoginController@login');    // 栏目序号查询文章
Route::any ("/admin/login/valid"            , \App\Utils\ConstantUtil::PROJECT_ADMIN.'\LoginController@valid');    // 栏目序号查询文章
