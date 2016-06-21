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
                <div class="form-group width20">
                    <label for="exampleInputPassword1">开始时间：</label>
                    @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"goods_start_time"])
                </div>

                <div class="form-group width20">
                    <label for="exampleInputPassword1">结束时间：</label>
                    @include('vendor.Bootstrap.datetimepicker.index',["datetimepicker_name"=>"end_start_time"])
                </div>

                <div class="form-group width50">
                    <label for="exampleInputEmail1">商品名称：</label>
                    <input type="text" class="form-control"  placeholder="商品名称" name="goods_name">
                </div>
                <div class="form-group width50">
                    <button type="button" class="btn btn-primary" id="goodsSearch">搜索</button>
                </div>
                <table  class="table table-striped table-bordered table-hover wrfont14">
                    <thead>
                    <tr>
                        <th>勾选</th>
                        <th>销售总数</th>
                        <th>商品名称</th>
                        <th>地区</th>
                        <th>档口</th>
                    </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>
            <div class="pageList page_branch{{$modal_id}}">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal_view{{$modal_id}}" id="goods_save">保存</button>
                <button type="button" class="btn btn-default modal_view{{$modal_id}}" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var page = 1;
    function page_ajax (__this) {
        var page_num = __this.html();
        if(!isNaN(page_num)) {
            page = page_num;
        } else if (page_num == '»') {
            page = __this.attr("max_page");
        } else if (page_num == '«') {
            page = __this.attr("min_page");
        }
        getGoodsList();
        return false;
    }

    function getGoodsList() {
        var goods_start_time = $("input[name=goods_start_time]").val();
        var end_start_time   = $("input[name=end_start_time]").val();
        var goods_name       = $("input[name=goods_name]").val();
        var store_id = '';
        @if(!empty($default_store))
            store_id = $('#store_id').val();
        @endif
        $.ajax({
            type: 'POST',
            url:"{{ URL::action(env('CMS').'\\'.$modal_execute) }}",
            data: {goods_start_time:goods_start_time,end_start_time:end_start_time,goods_name:goods_name,page:page,store_id:store_id},
            success: function(result){
                //var obj = eval('(' + result.body + ')') ;
                var html = "";
                $.each(result.body.data,function(key,val){
                    html+= '<tr>';
                    html+= '<td><label><input type=@if(!empty($modal_type))@if($modal_type == 1)"radio"@else"checkbox"@endif @else"checkbox" @endif" name="goods_name{{$modal_id}}" value="'+val.goods_id+'"  class="ace{{$modal_id}}" ><span class="lbl"></span></label></td>';
                    html+= '<td>'+val.order_item_count+'</td>';
                    html+= '<td>'+val.goods_name+'</td>';
                    html+= '<td>'+val.market+'</td>';
                    html+= '<td>'+val.name+'</td>';
                    html+= '</tr>';
                });
                if(!html) {
                    html = '<tr><td align="center" colspan="5">搜索无数据</td></tr>';
                }
                /**
                 * 分页
                 */
                var page_html = result.page.replace(/<a/g,'<a onclick="page_ajax($(this))" max_page="'+result.body.last_page+'"  min_page="'+result.body.from+'" ');
                page_html = page_html.replace(/href/g,'href="javascript:void(0)" alt');
                $(".page_branch{{$modal_id}}").html(page_html);
                // -----------------------------
                $("#tbody").html(html);
            }
        });
    }
    function checkEach(){
        var check="";
        $('.ace{{$modal_id}}').each(function(){
            if($(this).prop('checked') == true) {
                check+=$(this).val()+",";
            }
        });
        return check;
    }
    $(function(){
        $(".modal_view{{$modal_id}}").click(function(){
            $("#mymodal{{$modal_id}}").modal("toggle");
        });
        $("#goodsSearch").click(function(){
            getGoodsList();
        });
        $("#goods_save").click(function(){
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
    });

</script>
