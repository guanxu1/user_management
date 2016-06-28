<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Article;
use App\Http\Model\ArticleClass;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;


/**
 * description : 文章模块
 * date        : 2016-02-01
 * author      : guanxu
 */
Class ArticleController extends Controller {

    /**
     * 文章列表页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $column_id = $request->input("id","1");
        $pre_page = ConstantUtil::PAGE ;
        session::put("column_id",$column_id);
        $list = Article::where("column_id","=",$column_id)->paginate($pre_page);
        foreach($list as $key => $val) {
            $list[$key]->class_name = ArticleClass::where("id","=",$val->class)->pluck("name");
        }
        $view = view(ConstantUtil::PROJECT_ADMIN.'/article/index')->with("column_id",$column_id)->with("list",$list);
        return $view;
    }

    /**
     * 添加显示页
     * @param Request $request
     * @return mixed
     */

    public function addShow(Request $request) {
        $column_id = $request->input("column_id");
        $class = ArticleClass::get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/article/add')->with("column_id",$column_id)->with("date",date("Y-m-d H:i:s"))->with("class_list",$class);
        return $view;

    }

    /**
     * 文章添加
     * @param Request $request
     */
    public function add(Request $request) {

        $data["name"]           = $request->input("name");
        $data["url"]            = $request->input("url");
        $data["class"]          = $request->input("class");
        $data["start_time"]     = $request->input("start_time");
        $data["end_time"]       = $request->input("end_time");
        $data["sort"]           = $request->input("sort");
        $data["content"]        = $request->input("content");
        $data["column_id"]      = $request->input("parent_id");
        $data["key_id"]         = $request->input("key_id");
        $data["create_user"]    = 'guanxu';
        $data["create_time"]    = date("Y-m-d H:i:s");
        $uploadImg = FunctionController::uploadImg();
        if(!empty($uploadImg)) $data["image"] = $uploadImg["image"]["url"];
        $result = Article::insert($data);
        if($result === true)
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $data["column_id"] ] ) );
        else
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $data["column_id"] ] ) );

    }



    /**
     * 文章修改
     * @param Request $request
     * @return $this
     */
    public function editorShow(Request $request) {
        $id = $request->input("id");
        if(empty($id)) return "";
        $list = Article::where("id",$id)->get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/article/editor')->with("list",$list[0]);
        return $view;

    }

    /**
     * 编辑
     * @param Request $request
     * @return bool
     */
    public function editor(Request $request) {
        $article_id = $request->input("article_id");
        if(empty($article_id))  return false;
        $data["name"]           = $request->input("name");
        $data["url"]            = $request->input("url");
        $data["class"]          = $request->input("class");
        $data["start_time"]     = $request->input("start_time");
        $data["end_time"]       = $request->input("end_time");
        $data["sort"]           = $request->input("sort");
        $data["content"]        = $request->input("content");
        $data["key_id"]         = $request->input("key_id");
        $data["update_user"]    = ConstantUtil::ARTICLE_USER;
        $data["update_time"]    = date("Y-m-d H:i:s");
        if(!empty($_FILES)) {
            $uploadImg = FunctionController::uploadImg();
            if(empty($uploadImg)) goto GoOn;
            foreach($uploadImg as $key=>$val) {
                $data[$key] = $val["url"];
            }
        }
        GoOn:
        Article::where("id",$article_id)->update($data);
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index', ['id' => session::get("column_id") ]));
    }


    /**
     * 修改文章状态
     * @param Request $request
     */
    public function status(Request $request) {
        $id = $request->input("id");
        $article = Article::where("id",$id)->get()->toArray();
        $newStatus = ConstantUtil::changeStatus($article[0]["status"]);
        $result = Article::where("id",$id)->update(["status"=>$newStatus]);
        if($result == 1 )
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $article[0]["column_id"] ] ) );
        else
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $article[0]["column_id"] ] ) );
    }

    public function delete(Request $request) {
        $id = $request->input("id");
        if(empty($id)) return '';
        Article::where("id","=",$id)->delete();
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => session::get("column_id") ]));
    }



}