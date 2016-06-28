@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')

<div style="float:left;width:100%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@funcAdd') }}" method="post" id="form1" class="registerform" >
        <div class="form-group width50">
            <label for="exampleInputEmail1">模块名称：</label>
            <input type="text" class="form-control"  placeholder="模块名称" name="name" datatype="*"  nullmsg="模块名称不可为空！" errormsg="请输入0~8个汉字" >
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">Url：</label>
            <input type="text" class="form-control"  placeholder="Url" name="url"  datatype="*"  nullmsg="Url不可为空！" errormsg="请输正确URL" >
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
        <input type="hidden" name="id" value="{{$id}}">
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
