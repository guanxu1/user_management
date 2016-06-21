@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div class="panel panel-primary margin10" style="float:left;width:80%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">扩展模块  > 多窗口</h3>
    </div>
    <div class="panel-body">
    <div style="float:left;width:100%">
        <form action="" method="post" id="form1"  >
            <div class="form-group width50">
                <label for="exampleInputEmail1">窗口名称：</label>
                <input type="text" class="form-control"  placeholder="分类名称" name="name">
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">调用模板：</label>
                <input type="text" class="form-control"  placeholder="调用模板" name="blade">
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">回调Function：</label>
                <input type="text" class="form-control"  placeholder="JS方法" name="return">
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">执行Function：</label>
                <input type="text" class="form-control"  placeholder="PHP方法" name="execute">
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
    @include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
