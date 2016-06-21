<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
<button class="btn btn-primary modal_view{{$modal_id}}" type="button">{{$modal_name}}</button>
<div class="modal" id="mymodal{{$modal_id}}">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content" style="overflow-y:scroll;height:95%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title wrfontBold16">云商抽奖列表</h4>
            </div>
            <div class="modal-body">
                <div class="form-group width20">
                    <label for="exampleInputPassword1">开始时间：</label>
                    @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"goods_start_time".$modal_id])
                </div>

                <div class="form-group width20">
                    <label for="exampleInputPassword1">结束时间：</label>
                    @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"end_start_time".$modal_id])
                </div>

                <div class="form-group width50">
                    <label for="exampleInputEmail1">抽奖活动名称：</label>
                    <input type="text" class="form-control"  placeholder="抽奖活动名称" name="goods_name{{$modal_id}}">
                </div>
                <div class="form-group width50">
                    <button type="button" class="btn btn-primary" id="goodsSearch{{$modal_id}}">搜索</button>
                </div>
                <table  class="table table-striped table-bordered table-hover wrfont14">
                    <thead>
                    <tr>
                        <th>勾选</th>
                        <th>序号</th>
                        <th>抽奖名称</th>
                        <th>地区</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                    </tr>
                    </thead>
                    <tbody id="tbody{{$modal_id}}"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal_view{{$modal_id}}" id="goods_save{{$modal_id}}">保存</button>
                <button type="button" class="btn btn-default modal_view{{$modal_id}}" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function(){
        $(".modal_view{{$modal_id}}").click(function(){
            $("#mymodal{{$modal_id}}").modal("toggle");
        });

        function getGoodsList{{$modal_id}}() {

            var goods_start_time = $("input[name=goods_start_time{{$modal_id}}]").val();
            var end_start_time   = $("input[name=end_start_time{{$modal_id}}]").val();
            var goods_name       = $("input[name=goods_name{{$modal_id}}]").val();
            $.ajax({
                type: 'POST',
                url:"{{ URL::action(env('CMS').'\\'.$modal_execute) }}",
                data: {goods_start_time:goods_start_time,end_start_time:end_start_time,goods_name:goods_name},
                success: function(result){
                    var obj = eval('(' + result + ')') ;
                    var html = "";
                    $.each(obj,function(key,val){
                        html+= '<tr>';
                        html+= '<td>'+val.id+'</td>';
                        html+= '<td><label><input type=@if(!empty($modal_type))@if($modal_type == 1)"radio"@else"checkbox"@endif @else"checkbox" @endif" name="goods_name{{$modal_id}}" value="'+val.id+'"  class="ace{{$modal_id}}" ><span class="lbl"></span></label></td>';
                        html+= '<td>'+val.name+'</td>';
                        html+= '<td>'+val.subsection_name+'-'+val.market_name+'</td>';
                        html+= '<td>'+val.start_time+'</td>';
                        html+= '<td>'+val.end_time+'</td>';
                        html+= '</tr>';
                    });
                    if(!html) {
                        html = '<tr><td align="center" colspan="5">搜索无数据</td></tr>';
                    }
                    $("#tbody{{$modal_id}}").html(html);
                }
            });
        }
        $("#goodsSearch{{$modal_id}}").click(function(){
            getGoodsList{{$modal_id}}();
        });
        $("#goods_save{{$modal_id}}").click(function(){
            var result;
            @if(!empty($modal_type))
                @if($modal_type == 1)
                result = $('input[name="goods_name{{$modal_id}}"]:checked ').val();
                @else
                    result = checkEach();
                @endif
            @else
                result = checkEach();
            @endif
            {{$modal_return}}(result);
        });

        function checkEach(){
            var check="";
            $('.ace{{$modal_id}}').each(function(){
                if($(this).prop('checked') == true) {
                    check+=$(this).val()+",";
                }
            });
            return check;
        }
    });
</script>
