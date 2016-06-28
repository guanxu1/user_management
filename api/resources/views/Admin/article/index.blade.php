@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.left')
<div >
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@addShow', ['column_id' => $column_id]) }}'">添加文章</button>
<br>
<br>
<table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
    <thead>
    <tr>
        <th class="center">
            <label>
                <input type="checkbox" class="ace">
                <span class="lbl"></span>
            </label>
        </th>
        <th>标题</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>文章图片缩略图</th>
        <th width="50px">排序</th>
        <th>状态</th>
        <th width="200px">操作</th>
    </tr>
    </thead>
    <tbody>
    @if(is_object($list))
        @foreach($list as $val)
        <tr>
            <td class="center">
                <label><input type="checkbox" class="ace"><span class="lbl"></span></label>
            </td>
            <td>{{$val->name}}</td>
            <td>{{$val->start_time}}</td>
            <td>{{$val->end_time}}</td>
            <td><img src="{{$val->image}}" width="80px" height="35px" ></td>
            <td>{{$val->sort}}</td>
            <td style="vertical-align:middle">
                @if($val->status == \App\Utils\ConstantUtil::GLOBAL_TRUE)
                    <span class="label label-sm label-success">开启</span>
                    @else
                    <span class="label label-sm label-danger">关闭</span>
                @endif
            </td>
            <td style="vertical-align:middle">
                <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@editorShow', ['id' => $val->id]) }}" class="label label-sm label-warning">编辑</a>
                @if($val->status == \App\Utils\ConstantUtil::GLOBAL_TRUE)
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@status', ['id' => $val->id]) }}" class="label label-sm label-danger">关闭</a>
                @else
                    <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@status', ['id' => $val->id]) }}" class="label label-sm label-success">开启</a>
                @endif
                <a href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@delete', ['id' => $val->id]) }}" class="label label-sm label-danger">删除</a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
</div>
<div class="pageList">
    @if(is_object($list))
        {!! $list->appends(['id'=>$column_id])->render() !!}
    @endif
</div>


@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
