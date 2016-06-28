<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Column;
use App\Http\Model\ColumnRelation;
use App\Utils\ConstantUtil;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

/**
 * description : 栏目模块
 * date        : 2016-02-01
 * author      : guanxu
 */
Class ColumnController extends Controller {

    /**
     * 栏目添加页面
     * @return mixed
     */
    public function addShow(Request $request) {
        $column_id = $request->input("id");
        session::put("column_id",$column_id);
        $view = view(ConstantUtil::PROJECT_ADMIN.'/column/add')->with("column_id",$column_id);
        return $view;

    }

    /**
     * 栏目添加
     * @param Request $request
     */
    public function add(Request $request) {
        $column = new Column();
        $post = $request->input();
        $result = $column->add($post);
        if($result === true) FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index'));
        End:
        FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index'), trans("messages.no_market"));
    }

    /**
     * 栏目首页
     * @return mixed
     */
    public function index() {
        $result = Column::select(
            "column.*" ,
            "column_relation.column_id",
            "column_relation.column_parent",
            "column_relation.rank",
            "column_relation.number"
        )
            ->where("column.status","=",ConstantUtil::GLOBAL_TRUE)
            ->leftJoin("column_relation" , "column_relation.column_id" , '=' , "column.id")
            ->get()->toArray();
        $column_id = session::get("column_id");
        if(!empty($column_id)) {
            $number = ColumnRelation::where("column_id","=",$column_id)->pluck("number");
            $number_array = [];
            for($i=0;$i<strlen($number)/4;$i++) {
                $number_array[] = intval(substr($number,$i*4,4));
            }
            foreach($result as $key => $val) {
                if(in_array($val["column_id"],$number_array)) $result[$key]["column_open"] = 1;
            }
        }
        $result = json_encode($result);
        return $result;
    }

    /**
     * 编辑显示
     * @param Request $request
     * @return mixed
     */
    public function editorShow(Request $request) {
        $column_id = $request->input("id");
        session::put("column_id",$column_id);
        $list = Column::where("column.id","=",$column_id)
            ->join("column_relation","column.id","=","column_relation.column_id")
            ->get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/column/editor')->with("column_id",$column_id)->with("list",$list[0]);
        return $view;
    }

    /**
     * 判断市场唯一值
     * @param $market_id
     * @param $column_id
     * @return bool   TRUE => 通过
     */

    private function marketVerify($market_id,$column_id) {
        if(empty($market_id) || empty($column_id)) return true;
        // 保存自己本身市场
        $same_id = ColumnRelation::where("column_id","=",$column_id)->where("status","=",ConstantUtil::NORMAL)->where("market_id","=",$market_id)->pluck("id");
        if(!empty($same_id)) return true;
        // 查询符合条件的NUM
        $selfNumber = ColumnRelation::where("column_id","=",$column_id)->where("status","=",ConstantUtil::NORMAL)->where("rank",">","2")->pluck("number");
        if(empty($selfNumber)) return true;
        // 查询自己2级栏目下，是否市场冲突
        $selfNumber = substr($selfNumber,0,8);
        $id = ColumnRelation::where("market_id","=",$market_id)->where("number","like",$selfNumber."%")->where("rank",">","2")->where("status","=",ConstantUtil::NORMAL)->pluck("id");
        if(empty($id)) return true;
        return false;
    }


    /**
     * 编辑
     * @param Request $request
     * @return bool
     */
    public function editor(Request $request) {
        $column_id = $request->input("column_id");
        if(empty($column_id))  return false;
        $column["name"] = $request->input("name");
        $column["sort"] = $request->input("sort");
        $column["content"] = $request->input("content");
        $column["content_img_status"] = $request->input("content_img_status");
        if(!empty($_FILES)) {
            $uploadImg = FunctionController::uploadImg();
            if(empty($uploadImg)) goto GoOn;
            foreach($uploadImg as $key=>$val) {
                $column[$key] = $val["url"];
            }
        }
        GoOn:
        $column_relation["subsection_id"] = $request->input("subsection") == '' ? null : $request->input("subsection");
        $column_relation["market_id"] = $request->input("market") == '' ? null : $request->input("market")  ;
        $marketVerify = $this->marketVerify($column_relation["market_id"],$column_id);
        if($marketVerify === false) goto End;
        ColumnRelation::where("column_id",$column_id)->update($column_relation);
        Column::where("id",$column_id)->update($column);
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ColumnController@editorShow', ['id' => $column_id ]));
        End:
        FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ColumnController@editorShow', ['id' => $column_id ]) , trans("messages.no_market"));

    }

    /**
     * 删除栏目 【物理删除】
     * @param Request $request
     * @return bool
     */
    public function delete(Request $request) {
        $column_id = $request->input("id");
        $selfRank = ColumnRelation::where("column_id","=",$column_id)->pluck("rank");
        if($selfRank <= ConstantUtil::SAFE_RANK) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index'),"2级以内栏目不可删除");
            return false;
        }
        $column = ColumnRelation::where("column_id","=",$column_id)->select("column_parent","number")->get()->toArray();
        $column_parent = $column[0]["column_parent"];
        $number = $column[0]["number"];
        $result = Column::where("id",$column_id)->delete();
        ColumnRelation::where("number","like",$number."%")->delete();
        if($result == 1)
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $column_parent ]));
        else
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\ArticleController@index' , ['id' => $column_parent]));
    }

    /**
     * 栏目详情
     * @param Request $request
     * @return bool
     */
    public function info(Request $request) {

        $column_id = session::get("column_id");
        if(empty($column_id)) return false;
        $number = ColumnRelation::where("column_id","=",$column_id)->pluck("number");
        for($i=0;$i<strlen($number)/4;$i++) {
            $self_column = substr($number,4*$i,4);
            $column[] = $self_column;
        }
        if(empty($column)) return '';
        $list = Column::whereIn("id",$column)->select("name")->get()->toJson();
        return $list;
    }

    public function rank2List() {
        return ColumnRelation::where("rank","=",2)
            ->leftjoin("column",function($val){
                $val->on("column.id","=",
                    DB::raw("column_relation.column_id AND column.status = ".ConstantUtil::NORMAL." "));
            })
            ->select("column.id","column.name")
            ->get()->toJson();
    }
    public function sonList(Request $request) {
        $column_id = $request->input("id");
        if(empty($column_id)) return "";
        $result = ColumnRelation::where("column_parent","=",$column_id)
            ->leftjoin("column",function($val){
                $val->on("column.id","=",
                    DB::raw("column_relation.column_id AND column.status = ".ConstantUtil::NORMAL." "));
            })
            ->select("column.id","column.name")
            ->get()->toArray();
         if(empty($result)) return "";
        return json_encode($result);
    }


    public function numberToArticle(Request $request) {

        $number = $request->input("number");
        $number = explode(",",$number);
        $num="0001";
        foreach($number as $val) {
            if(empty($val)) continue;
            $num.= sprintf("%04d", $val);
        }
        $column_id = ColumnRelation::where("number","=",$num)->pluck("column_id");
        $column_name = Column::where("id","=",$column_id)->pluck("name");
        $article = Article::where("column_id","=",$column_id)->get()->toArray();
        if(empty($article)) return "";
        return json_encode(["body"=>$article,"column_name"=>$column_name]);
    }
}