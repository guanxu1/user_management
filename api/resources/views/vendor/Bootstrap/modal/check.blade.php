<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-transition.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/modal/bootstrap-modal.js') }}" type="text/javascript"></script>
<a class="cursorPointer modal_view{{$modal_id}} {{$modal_class}}">{{$modal_name}}</a>
<div class="modal" id="mymodal{{$modal_id}}">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content" style="overflow-y:scroll;height:60%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title wrfontBold16">{{$modal_name}}</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-striped table-bordered table-hover wrfont14">
                    <tbody>
                    @if(!empty($modal_list) && is_array($modal_list))
                        @foreach($modal_list as $val)
                            <tr>
                                <td>{{$val["name"]}}：</td>
                                <td>{{$val["value"]}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function(){
        /**
         * 点击事件触发效果
         */
        $(".modal_view{{$modal_id}}").click(function(){
            $("#mymodal{{$modal_id}}").modal("toggle");
        });
    });
</script>
