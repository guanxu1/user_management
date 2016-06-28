@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div class="panel-group" id="accordion">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@userEditor') }}" method="post"   >
    <button type="submit" class="btn btn-primary">保存配置</button>
    <br>
    <br>
            <div class="role-relation-modules">
                <label class="checkbox-inline">
                    <input type="checkbox"  onchange="checkBoxAll($(this))" alt="checkbox-inline-check1"> 管理员
                </label>
                <div class="role-relation-modules-func">
                    @foreach($list as $val)
                        <label class="checkbox-inline">
                            <input type="checkbox" name="user[]"  value="{{$val["id"]}}" class="checkbox-inline-check1">{{$val["username"]}}
                        </label>
                    @endforeach
                </div>
            </div>
        <input type="hidden" name="id" value="{{$id}}">
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
