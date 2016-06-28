@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
<div class="panel-group" id="accordion">
    <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\RoleController@relationEditor') }}" method="post"   >
    <button type="submit" class="btn btn-primary">保存配置</button>
    <br>
    <br>
    @foreach($list as $val)
        <div class="panel panel-info" >
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a  data-toggle="collapse" data-parent="#accordion"  href="#collapseOne{{$val["id"]}}">{{$val["name"]}}</a>
                </h4>
            </div>
            <div  id="collapseOne{{$val["id"]}}" class="panel-collapse collapse in">
                <div class="panel-body">
                    @foreach($val["modules_list"] as $val2)
                        <div class="role-relation-modules">
                            <label class="checkbox-inline">
                                <input type="checkbox" @if(in_array($val2["id"],$modules)) checked @endif onchange="checkBoxAll($(this))" alt="checkbox-inline-check{{$val2["id"]}}" > {{$val2["name"]}}
                            </label>
                            <div class="role-relation-modules-func">
                            @foreach($val2["modules_func_list"] as $val3)
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="modules[]" @if(in_array($val3["id"],$select)) checked @endif value="{{$val3["id"]}}"  class="checkbox-inline-check{{$val2["id"]}}"> {{$val3["name"]}}
                                </label>
                            @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#collapseOne{{$val["id"]}}').collapse({toggle: false});
            });
        </script>
    @endforeach
        <input type="hidden" name="id" value="{{$id}}">
    </form>
</div>
@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
