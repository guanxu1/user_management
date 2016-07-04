@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div >
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@addView') }}'">添加模块</button>
    <br>
    <br>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
        <thead>
        <tr>
            <th>ID</th>
            <th>模块名称</th>
            <th>Url</th>
            <th>归属分类</th>
            <th width="200px">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $val)
            <tr>
                <td  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$val["id"]}}" aria-expanded="true" aria-controls="collapseOne{{$val["id"]}}">{{$val["id"]}}</td>
                <td  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$val["id"]}}" aria-expanded="true" aria-controls="collapseOne{{$val["id"]}}">{{$val["name"]}}</td>
                <td  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$val["id"]}}" aria-expanded="true" aria-controls="collapseOne{{$val["id"]}}">{{$val["url"]}}</td>
                <td  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$val["id"]}}" aria-expanded="true" aria-controls="collapseOne{{$val["id"]}}">{{$val["classify_name"]}}</td>
                <td>
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAddView',["id"=>$val["id"]]) }}" class="btn btn-primary btn-sm ">添加功能</a>
                </td>
            </tr>
            @if(!empty($val["func_list"]))
            <tr>
                <td colspan="5">
                    <div class="panel-collapse collapse" id="collapseOne{{$val["id"]}}"   role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <table style="margin:0px" class="table table-striped table-bordered table-hover wrfont14">
                            @foreach($val["func_list"] as $val2)
                                <tr class="warning">
                                    <td>{{$val2["name"]}}</td>
                                    <td>{{$val2["url"]}}</td>
                                    <td width="200px">
                                        <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAddView',["id"=>$val["id"]]) }}" class="btn btn-warning btn-sm">编辑</a>
                                        <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAddView',["id"=>$val["id"]]) }}" class="btn btn-danger btn-sm ">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
<div class="pageList">

</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')