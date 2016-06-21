<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
<button class="btn btn-primary modal_view{{$modal_id}}" type="button">{{$modal_name}}</button>
<div class="modal" id="mymodal{{$modal_id}}">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content" style="overflow-y:scroll;height:95%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title wrfontBold16">商品列表</h4>
            </div>
            <div class="modal-body">
                <div class="form-group width50">
                    <label for="exampleInputEmail1">商品名称：</label>
                    <input type="text" class="form-control"  placeholder="商品名称" name="goods_name">
                </div>
                <div class="form-group width50">
                    <button type="button" class="btn btn-primary" id="goodsSearch">搜索</button>
                </div>
                <table  class="table table-striped table-bordered table-hover wrfont14">
                    <thead>
                @if($att_type=="erp_att")
                    <tr>
                        <td>选择<input type="checkbox" onclick="clickAll(this)"/></td>
                        <td>商品ID</td>
                        <td>商品名称</td>
                        <td>所属商户</td>
                        <td>所属档口</td>
                        <td>规格</td>
                        <td>品牌</td>
                        <td>售价</td>
                    </tr>
                 @else
                 <tr>
                     <td>选择<input type="checkbox" onclick="clickAll(this)"/></td>
                     <td>名称</td>
                     <td>所属商户</td>
                     <td>所属档口</td>
                     <td>规格名称</td>
                     <td>价格区间</td>
                 </tr>
                    @endif
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal_view{{$modal_id}}" id="goods_save">保存</button>
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

        function getGoodsList() {
            var goods_name      = $("input[name=goods_name]").val();
            var stall_id = $("select[name=stall]").val();
            var company_id   = $("select[name=company]").val();
            var market_id       = $("select[name=market]").val();
            var type=$("input[name=active_type_flag]").val();
            $.ajax({
                type: 'POST',
                url:"{{ URL::action(env('YS').'\ActiveController@getActiveGoodsListAjax')}}",
                data: {stall_id:stall_id,company_id:company_id,market_id:market_id,type:type,goods_name:goods_name},
                success: function(result){
                    var obj = eval('(' + result + ')') ;
                    var html = "";
                    if(type=="erp_att"){
                        $.each(obj,function(key,val){
                            html+= '<tr>';
                            html+= '<td><label><input type="checkbox"  name="goods_ids[]" value="'+val.goods_id+'"  class="ace1" ><span class="lbl"></span></label></td>';
                            html+= '<td>'+val.goods_id+'</td>';
                            html+= '<td>'+val.goods_name+'</td>';
                            html+= '<td>'+val.company_name+'</td>';
                            html+= '<td>'+val.stall_name+'</td>';
                            html+= '<td>'+val.goods_spec+'</td>';
                            html+= '<td>'+val.goods_brand+'</td>';
                            html+= '<td>'+val.price+'</td>';
                            html+= '</tr>';
                        });
                        if(!html) {
                            html = '<tr><td align="center" colspan="8">搜索无数据</td></tr>';
                        }
                    }else{
                        $.each(obj,function(key,val){
                            html+= '<tr>';
                            html+= '<td><label><input type="checkbox"  name="goods_ids[]" value="'+val.sku_id+'"  class="ace1" ><span class="lbl"></span></label></td>';
                            html+= '<td>'+val.goods_name+'</td>';
                            html+= '<td>'+val.stall_name+'</td>';
                            html+= '<td>'+val.company_name+'</td>';
                            html+= '<td>'+val.sku_value+'</td>';
                            html+= '<td>'+val.price+'</td>';
                            html+= '</tr>';
                        });
                        if(!html) {
                            html = '<tr><td align="center" colspan="6">搜索无数据</td></tr>';
                        }
                    }

                    $("#tbody").html(html);
                }
            });
        }
        $("#goodsSearch").click(function(){
            getGoodsList();
        });
        $("#goods_save").click(function(){
            var result;
            result = checkEach();
            {{$modal_return}}(result);
        });
        function checkEach(){
            var check="";
            $('.ace1').each(function(){
                if($(this).prop('checked') == true) {
                    check+=$(this).val()+",";
                }
            });
            return check;
        }
    });

    //全选/返选
    function clickAll(obj){
        if($(obj).prop('checked') == true){
            for(i = 0;i < $('.ace1').length;i++){
                if($('.ace1')[i].type == "checkbox")
                {
                    $('.ace1')[i].checked = true;
                }
            }
        }else{
            for(i = 0;i < $('.ace1').length;i++){
                if($('.ace1')[i].type == "checkbox")
                {
                    $('.ace1')[i].checked = false;
                }
            }
        }
    }
</script>
