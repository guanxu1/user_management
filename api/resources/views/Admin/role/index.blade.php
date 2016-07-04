@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div >
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@addView') }}'">添加角色</button>
    <br>
    <br>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
        <thead>
        <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th width="300px">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $val)
            <tr>
                <td>{{$val["id"]}}</td>
                <td>{{$val["name"]}}</td>
                <td>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditorView',["id"=>$val["id"]]) }}" class="btn btn-primary btn-sm">编辑</a>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@userEditorView',["id"=>$val["id"]]) }}" class="btn btn-primary btn-sm">分配用户</a>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditorView',["id"=>$val["id"]]) }}" class="btn btn-warning btn-sm">模块权限</a>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditorView',["id"=>$val["id"]]) }}" class="btn btn-danger btn-sm">删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pageList">

</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')