@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.left')

<div style="float:left;width:70%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@editor')}}" class="registerform" method="post" enctype="multipart/form-data">
        <div class="form-group width50">
            <label for="exampleInputEmail1">栏目名称：</label><font color="red">*</font>
            <input type="text" class="form-control"  placeholder="栏目名称" name="name" value="{{$list["name"]}}" datatype="*1-15"  nullmsg="栏目名称不可为空！" errormsg="请输入1~15个汉字">
        </div>
        <!-- 栏目Log -->
        <div class="form-group width50">
            <label for="exampleInputEmail1">栏目Log：</label>
            @include("vendor.Bootstrap.onceUpload.index" ,["onceUpload_name"=>"title_img","onceUpload_value"=>$list["title_img"]])
        </div>
        <!-- 地区区域 -->
        <!-- 栏目简介 -->
        <div class="form-group">
            <label for="exampleInputPassword1">栏目简介：</label>
            <textarea class="form-control" rows="3" name="content">{{$list["content"]}}</textarea>
        </div>
        <!-- 排序 -->
        <div class="form-group">
            <label for="exampleInputPassword1">排序</label>
            <select class="form-control width20" name="sort">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
        <input type="hidden" name="column_id" value="{{$column_id}}" >
    </form>
</div>

@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')