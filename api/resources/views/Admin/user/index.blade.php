@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div >
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@addView') }}'">添加用户</button>
    <br>
    <br>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
        <thead>
        <tr>
            <th>ID</th>
            <th>账户名</th>
            <th>姓名</th>
            <th>电话</th>
            <th>类型</th>
            <th width="200px">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $val)
            <tr>
                <td>{{$val["id"]}}</td>
                <td>{{$val["username"]}}</td>
                <td>{{$val["name"]}}</td>
                <td>{{$val["mobile"]}}</td>
                <td>{{\App\Utils\ConstantUtil::poserList($val["rank"])}}</td>
                <td>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@editorView',["id"=>$val["id"]]) }}" class="btn btn-primary btn-sm">编辑</a>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@update',["id"=>$val["id"]]) }}" class="btn btn-danger btn-sm">停用</a>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@delete',["id"=>$val["id"]]) }}" class="btn btn-danger btn-sm ">删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pageList">

</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')