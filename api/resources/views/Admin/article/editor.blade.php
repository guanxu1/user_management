@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.left')

<div style="float:left;width:100%">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@editor')}}" class="registerform"  method="post" id="form1"  enctype="multipart/form-data">

        <div class="form-group width50">
            <label for="exampleInputEmail1">文章标题：<font color="red">*</font></label>
            <input type="text" class="form-control"  placeholder="文章标题" name="name" value="{{$list["name"]}}"  datatype="*1-50"  nullmsg="文章标题不可为空！" errormsg="请输入1~50个汉字">
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">文章跳转地址：</label>
            <input type="text" class="form-control"  placeholder="文章跳转地址" name="url" value="{{$list["url"]}}">
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">文章图片：</label>
            @include("vendor.Bootstrap.onceUpload.index" ,["onceUpload_name"=>"image","onceUpload_value"=>$list["image"]])
        </div>

        <div class="form-group width50">
            <label for="exampleInputEmail1">开始时间：</label>
            @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"start_time","datetimepicker_value"=>$list["start_time"]])
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">结束时间：</label>
            @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"end_time","datetimepicker_value"=>$list["end_time"]])
        </div>
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
        <div class="form-group">
            <label for="exampleInputEmail1">文章内容：</label>
            @include('vendor.Bootstrap.textarea.index',["textarea_value"=>$list["content"]])
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
        <input type="hidden" name="article_id" value="{{$list['id']}}" >
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
