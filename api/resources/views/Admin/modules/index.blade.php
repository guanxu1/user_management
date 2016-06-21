@include('Cms.public.header')
@include('Cms.public.expand_left')
<div class="panel panel-primary margin10" style="float:left;width:80%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">扩展模块  > 多窗口</h3>
    </div>
    <div class="panel-body">
<button type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::action(env('CMS').'\ExpandController@addShow', ['id' => $id]) }}'">添加多窗口</button>
<br>
<br>
<table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
    <thead>
        <tr>
            <th class="center">序号</th>
            <th>窗口名称</th>
            <th>分类关联ID</th>
            <th>分类关联</th>
            <th>调用模板</th>
            <th>回调JS</th>
            <th>执行Function</th>
            <th width="110px">操作</th>
        </tr>
    </thead>
    <tbody>
        @if(is_array($list))
            @foreach($list as $val)
                <tr>
                <td>{{$val["id"]}}</td>
                <td>{{$val["name"]}}</td>
                <td>{{$val["class"]}}</td>
                <td>{{$val["class_name"]}}</td>
                <td>{{$val["blade"]}}</td>
                <td>{{$val["return"]}}</td>
                <td>{{$val["execute"]}}</td>
                <td>
                    <a href="{{ URL::action(env('CMS').'\ExpandController@editorShow', ['id' => $val["id"]]) }}" class="label label-sm label-warning">编辑</a>
                    <a href="{{ URL::action(env('CMS').'\ExpandController@delete', ['id' => $val["id"]]) }}" class="label label-sm label-warning">删除</a>
                </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@include('Cms.public.footer')
