@include('Cms.public.header')
@include('Cms.public.expand_left')
<div class="panel panel-primary margin10" style="float:left;width:80%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">扩展模块  > 多窗口</h3>
    </div>
    <div class="panel-body">
<div style="float:left;width:100%">
    <form action="{{ URL::action(env('CMS').'\ExpandController@editor')}}" method="post" id="form1"  >
        <div class="form-group width50">
            <label for="exampleInputEmail1">分类名称：</label>
            <input type="text" class="form-control"  placeholder="分类名称" name="name" value="{{$list["name"]}}">
        </div>

        <div class="form-group width50">
            <label for="exampleInputEmail1">分类关联：</label>
            <select class="form-control width20" name="class">
                @foreach($class as $val)
                    <option value="{{$val["id"]}}" @if($list["class"] == $val["id"]) selected @endif>{{$val["name"]}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group width50">
            <label for="exampleInputEmail1">调用模板：</label>
            <input type="text" class="form-control"  placeholder="调用模板" name="blade" value="{{$list["blade"]}}">
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">回调Function：</label>
            <input type="text" class="form-control"  placeholder="JS方法" name="return" value="{{$list["return"]}}">
        </div>
        <div class="form-group width50">
            <label for="exampleInputEmail1">执行Function：</label>
            <input type="text" class="form-control"  placeholder="PHP方法" name="execute" value="{{$list["execute"]}}"
        </div>
        <br>
        <button type="submit" class="btn btn-primary">保存</button>
        <input type="hidden" name="id" value="{{$id}}" >
    </form>
</div>

@include('Cms.public.footer')
