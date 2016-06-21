<div class="form-group @if(!empty($stall_class)){{$stall_class}}@endif">
    商户：<select name="{{$company_name}}"  class="form-control selectWidth rows_display" id="company_name{{$id}}"></select>
    档口：<select name="{{$stall_name}}"   class="form-control selectWidth rows_display"   id="stall_name{{$id}}"></select>
    @if(!empty($goods_show_status))
        <input type="text" class="form-control" placeholder="商品ID" name="{{$goods_show_name}}" value="{{$goods_show_value}}" id="goods_show_id{{$modal_id}}" readonly>
        <script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
        <script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
        <button class="btn btn-primary modal_view{{$modal_id}}" type="button">商品</button>
        <div class="modal" id="mymodal{{$modal_id}}">
            <div class="modal-dialog" style="width: 80%;">
                <div class="modal-content" style="overflow-y:scroll;height:95%">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title wrfontBold16">商品列表</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group width50">
                            <button type="button" class="btn btn-primary" id="goodsSearch">查询数据</button>
                        </div>
                        <br>
                        <br>
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
                    <div class="pageList page_branch{{$modal_id}}"></div>
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
        var company_id   = $("#company_name{{$id}}").val();
        var stall_id     = $("#stall_name{{$id}}").val();
        $.ajax({
            type: 'POST',
            url:"{{ URL::action(env('CMS').'\\GoodsController@ysGoodsList') }}",
            data: {company_id:company_id,stall_id:stall_id,page:page},
            success: function(result){
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
            $("#goods_show_id{{$modal_id}}").val(result);
        });
    });

</script>
@endif
</div>
<script type="text/javascript">
    $(function(){
        $('select[name="{{$stall_name}}"]').html('<option value="{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}">不限</option>');
        var company_id       = @if(!empty($company_id)) {{$company_id}} @else 0 @endif;
        var stall_id           = @if(!empty($stall_id)) {{$stall_id}} @else 0 @endif;
        $.ajax({
            type: 'post',
            url: "{{URL(env('YS').'/order/company')}}",
            data: {},
            async: true,
            success: function (data) {
                var company_html = '';
                company_html += '<option value="{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}">不限</option>';
                if(data) {
                    for (var i = 0; i < data.length; i++) {
                        //  company_html += '<option value="' + data[i]['company_id'] + '">' + data[i]['company_name'] + '</option>';
                        if(company_id==data[i]['company_id']){
                            company_html+= '<option value="'+data[i]['company_id']+'" selected>'+data[i]['company_name']+'</option>';
                        }else{
                            company_html+= '<option value="'+data[i]['company_id']+'">'+data[i]['company_name']+'</option>';
                        }
                    }
                    $('select[name="{{$company_name}}"]').html(company_html);
                    $.ajax({
                        type: 'post',
                        url: "{{URL(env('YS').'/order/stall')}}",
                        data: {company_id:company_id},
                        async: true,
                        success: function (data) {
                            var stall_html = '';
                            stall_html += '<option value="{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}">不限</option>';
                            for (var i = 0; i < data.length; i++) {
                                if(stall_id==data[i]['id']){
                                    stall_html+= '<option value="'+data[i]['id']+'" selected>'+data[i]['name']+'</option>';
                                }else{
                                    stall_html+= '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
                                }
                            }
                            $('select[name="{{$stall_name}}"]').html(stall_html);
                        }
                    });

                }

            }
        });

        $("#company_name"+"{{$id}}").change(function(){
            company_id = $(this).val();
            $.ajax({
                type: 'post',
                url: "{{URL(env('YS').'/order/stall')}}",
                data: {company_id:company_id},
                async: true,
                success: function (data) {
                    var stall_html = '';
                    stall_html += '<option value="{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}">不限</option>';
                    for (var i = 0; i < data.length; i++) {
                        stall_html += '<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>';
                    }
                    $('select[name="{{$stall_name}}"]').html(stall_html);
                }
            });
        });
    });
</script>