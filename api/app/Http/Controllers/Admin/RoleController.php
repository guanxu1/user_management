<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Model\Classify;
use App\Http\Model\Role;
use App\Http\Model\RoleRelation;
use App\Http\Model\RoleUser;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Utils\ConstantUtil;
use Illuminate\Support\Facades\URL;
use DB;

Class RoleController extends Controller {

    public function index() {
        $list = Role::where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/role/index')->with("list",$list);
        return $view;
    }

    public function add(Request $request) {

        $name = $request->input("name");
        $data["name"] = $name;
        $data["status"] = ConstantUtil::GLOBAL_TRUE;
        $data["create_time"] = date("Y-m-d H:i:s");
        $result = Role::insert($data);
        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加成功！');
        }

    }



    public function addView() {


        $view = view(ConstantUtil::PROJECT_ADMIN.'/role/add');
        return $view;

    }


    public function relationEditorView(Request $request) {

        $id = $request->input("id");
        if(empty($id)) return '';
        $select = RoleRelation::where("role_id","=",$id)->lists("modules_func_id")->toArray();
        $modules =  RoleRelation::select(
                DB::raw("distinct(modules_func.modules_id)")
            )
            ->where("role_relation.role_id","=",$id)
            ->join("modules_func","modules_func.id","=","role_relation.modules_func_id")
            ->lists("modules_id")->toArray();
        $list = Classify::getClassifyModules();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/role/relationEditor')->with("list",$list)->with("id",$id)->with("select",$select)->with("modules",$modules);
        return $view;

    }

    public function relationEditor(Request $request) {

        $modules = $request->input();
        $role = new RoleRelation();
        $result = $role->add($modules);
        if(empty($result)) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加失败！');
        } else {
            FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加成功！');
        }
    }



    public function userEditorView(Request $request) {

        $id = $request->input("id");
        if(empty($id)) return '';
        $list = User::where("rank","=",ConstantUtil::POWER_MANAGE)->where("status","=",ConstantUtil::GLOBAL_TRUE)->get()->toArray();
        $view = view(ConstantUtil::PROJECT_ADMIN.'/role/userEditor')->with("list",$list)->with("id",$id);
        return $view;

    }

    public function userEditor(Request $request) {

        $role_id    = $request->input("id");
        $user       = $request->input("user");
        RoleUser::where("role_id","=",$role_id)->delete();
        if(empty($user)) goto End;
        $date = date("Y-m-d H:i:s");
        try {
            foreach($user as $val) {
                $data = [];
                $data["user_id"] = $val;
                $data["role_id"] = $role_id;
                $data["create_time"] = $date;
                RoleUser::insert($data);
            }
        } catch ( \PDOException $e) {
            FunctionController::errorView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加失败！');
        }
        End:
        FunctionController::successView(URL::action(ConstantUtil::PROJECT_ADMIN.'\RoleController@index'),'添加成功！');
    }




}