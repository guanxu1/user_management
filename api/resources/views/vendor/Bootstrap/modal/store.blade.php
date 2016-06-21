<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
<button class="btn btn-primary modal_view{{$modal_id}}" type="button">{{$modal_name}}</button>
<div class="modal" id="mymodal{{$modal_id}}">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content" style="overflow-y:scroll;height:95%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title wrfontBold16">商铺列表</h4>
            </div>
            <div class="modal-body">
                <div class="form-group width50">
                    <label for="exampleInputEmail1">店铺名称：</label>
                    <input type="text" class="form-control"  placeholder="店铺名称" name="stall_name{{$modal_id}}">
                </div>
                <div class="form-group width50">
                    <button type="button" class="btn btn-primary" id="stallSearch{{$modal_id}}">搜索</button>
                </div>
                <table  class="table table-striped table-bordered table-hover wrfont14">
                    <thead>
                    <tr>
                        <th>勾选</th>
                        <th>序号</th>
                        <th>商铺名称</th>
                        <th>所属市场</th>
                        <th>公司名称</th>
                        <th>创建时间</th>
                    </tr>
                    </thead>
                    <tbody id="tbody{{$modal_id}}"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal_view{{$modal_id}}" id="goods_save_{{$modal_id}}">保存</button>
                <button type="button" class="btn btn-default modal_view{{$modal_id}}" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function(){
        function getStallList{{$modal_id}}(){
            var stall_name       = $("input[name=stall_name{{$modal_id}}]").val();
            $.ajax({
                type: 'POST',
                url:"{{ URL::action('ServiceController@storeIndex')}}",
                data: {stall_name:stall_name},
                success: function(result){
                    if(result) {
                        var obj = eval('(' + result + ')') ;
                        var html ="";
                        $.each(obj,function(key,val){
                            html+="<tr>";
                            html+= '<td><input type=@if(!empty($modal_type))@if($modal_type=='1')"radio"@else"checkbox"@endif @else"checkbox" @endif class="radio_article{{$modal_id}}" name="radio_article{{$modal_id}}" value="'+val.id+'"></td>';
                            html+='<td>'+val.id+'</td>';
                            html+='<td>'+val.name+'</td>';
                            html+='<td>'+val.subsection_name+'-'+val.market_name+'</td>';
                            html+='<td>'+val.company_name+'</td>';
                            html+='<td>'+val.create_time+'</td>';
                            html+="</tr>";
                        });
                        $("#tbody{{$modal_id}}").html(html);
                    }else{
                        $("#tbody{{$modal_id}}").html('');
                    }
                }
            });

        }
       /**
        * 搜索
        * */
        $("#stallSearch{{$modal_id}}").click(function(){
            getStallList{{$modal_id}}();
        });

        /**
         * 点击事件触发效果
         */
        $(".modal_view{{$modal_id}}").click(function(){
            $("#mymodal{{$modal_id}}").modal("toggle");
        });
        /**
         * 保存结果
         */
        $("#goods_save_{{$modal_id}}").click(function(){
            var result;
            @if(!empty($modal_type))
                @if($modal_type == 1)
                result = $('input[name="radio_article{{$modal_id}}"]:checked ').val();
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
            $('.radio_article{{$modal_id}}').each(function(){
                if($(this).prop('checked') == true) {
                    check+=$(this).val()+",";
                }
            });

            return check;
        }
    });
</script>
