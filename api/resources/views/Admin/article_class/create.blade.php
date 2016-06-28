@include('Cms.public.header')
@include('Cms.public.expand_left')
<div class="panel panel-primary margin10" style="float:left;width:80%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">扩展模块  > 分类关联管理</h3>
    </div>
    <div class="panel-body">
<div style="float:left;width:100%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleClassController@store')}}" method="post" id="form1"  >
        <div class="form-group width50">
            <label for="exampleInputEmail1">分类名称：</label>
            <input type="text" class="form-control"  placeholder="分类名称" name="name">
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
</div>

@include('Cms.public.footer')
