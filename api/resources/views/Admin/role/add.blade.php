@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div style="float:left;width:100%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@add') }}" method="post" id="form1"   class="registerform" >
        <div class="form-group width50">
            <label for="exampleInputEmail1">角色名称：</label>
            <input type="text" class="form-control"  placeholder="角色名称" name="name">
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
