@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')

<div style="float:left;width:100%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@add') }}" method="post" id="form1" class="registerform"  >
        <div class="form-group width50">
            <label for="exampleInputEmail1">模块名称：</label>
            <input type="text" class="form-control"  placeholder="模块名称" name="name" datatype="*"  nullmsg="模块名称不可为空！" errormsg="请输入0~8个汉字">
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">Url：</label>
            <input type="text" class="form-control"  placeholder="Url" name="url" datatype="*"  nullmsg="Url不可为空！" errormsg="请输正确URL" >
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">归属分类：</label>
            <select class="form-control width50 " name="classify" id="class_relation">
                @foreach($list as $val)
                    <option value="{{$val["id"]}}">{{$val["name"]}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
