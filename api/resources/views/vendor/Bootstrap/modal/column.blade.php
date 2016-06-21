<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
<button class="btn btn-primary modal_view{{$modal_id}}" type="button">{{$modal_name}}</button>
<div class="modal" id="mymodal{{$modal_id}}">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content" style="overflow-y:scroll;height:95%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title wrfontBold16">栏目列表</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">栏目信息：</label>
                    <select class="form-control width20 rows_display  column_id{{$modal_id}}" id="column_class_{{$modal_id}}"  onchange="addClass{{$modal_id}}($(this))"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal_view{{$modal_id}}" id="goods_save_{{$modal_id}}">保存</button>
                <button type="button" class="btn btn-default modal_view{{$modal_id}}" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    /**
     * 添加分类
     * @param self
     */
    function addClass{{$modal_id}}(self) {
        $.ajax({
            type: 'POST',
            url:"{{ URL::action(env('CMS').'\ColumnController@sonList')}}",
            data: {id:self.val()},
            success: function(result){
                if(result) {
                    var obj = eval('(' + result + ')') ;
                    var html = '<select class="form-control width20 rows_display column_id{{$modal_id}}" onchange="addClass{{$modal_id}}($(this))"><option value=""></option>';
                    $.each(obj,function(key,val){
                        if(val.name) {
                            html+="<option value="+val.id+">"+val.name+"</option>";
                        }
                    });
                    html+="</select>";
                    self.next().remove();
                    self.after(html);
                } else{
                    self.next().remove();
                }
            }
        });
    }

    $(function(){
        /**
         * 点击事件触发效果
         */
        $(".modal_view{{$modal_id}}").click(function(){
            $("#mymodal{{$modal_id}}").modal("toggle");
        });
        /**
         * 分类CLASS—2级栏目列表
         */
        $.get("{{ URL::action(env('CMS').'\ColumnController@rank2List') }}",function(result){
            var obj = eval('(' + result + ')') ;
            var html = "<option value=''></option>";
            $.each(obj,function(key,val){
                html+="<option value="+val.id+">"+val.name+"</option>";
            });
            $("#column_class_{{$modal_id}}").html(html);
        });

        /**
         * 保存结果
         */
        $("#goods_save_{{$modal_id}}").click(function(){
            var result = $('input[name="radio_article{{$modal_id}}"]:checked ').val();
            {{$modal_return}}(result);
            var column_select = $(".column_id{{$modal_id}}");
            var html="";
            column_select.each(function(){
                html = $(this).val();
            })
           {{$modal_return}}(html);
        });

    });
</script>
