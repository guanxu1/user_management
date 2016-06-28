@include('Cms.public.header')
@include('Cms.public.expand_left')

<div class="panel panel-primary margin10" style="float:left;width:80%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">扩展模块  > 分类关联管理</h3>
    </div>
<div class="panel-body">
    <button type="button" class="btn btn-primary" onclick="jumpToCreate()">添加分类关联</button>
    <br>
    <br>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
        <thead>
        <tr>
            <th style="width: 10%;">ID</th>
            <th>名称</th>
            <th style="width: 10%;">操作</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($Rows))
            @foreach($Rows as $key=>$val)
                <tr>
                    <td>{{$val['id']}}</td>
                    <td>{{$val['name']}}</td>
                    <td>
                        <a href="{{URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleClassController@edit',['id'=>$val["id"]])}}" class="label label-sm label-warning">编辑</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @include('Cms.public.footer')
<script type="text/javascript">
    function jumpToCreate(){
        window.location.href = "{{URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleClassController@create')}}";
    }
</script>