<link href="{{ URL::asset('/css/Bootstrap/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/datetimepicker/bootstrap-datetimepicker.js') }}"
        type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/datetimepicker/bootstrap-datetimepicker.fr.js') }}"
        type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/datetimepicker/bootstrap-datetimepicker.zh-CN.js') }}"
        type="text/javascript"></script>
<input size="16" type="text" name="{{$datetimepicker_name}}" value="@if(!empty($datetimepicker_value)){{$datetimepicker_value}}@endif" name="{{$datetimepicker_name}}" readonly
       class="form_datetime form-control @if(!empty($datetimepicker_class)){{$datetimepicker_class}}@endif" @if(!empty($datetimepicker_datatype))datatype="{{$datetimepicker_datatype}}"
       @endif @if(!empty($datetimepicker_nullmsg))nullmsg="{{$datetimepicker_nullmsg}}"@endif >
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        @if(!empty($datetimepicker_type) )
        minView: "month", //选择日期后，不会再跳转去选择时分秒
        @endif
        @if(!empty($datetimepicker_type) )
        format: 'yyyy-mm-dd',
        @else
        format: 'yyyy-mm-dd hh:ii:ss',
        @endif
        language: 'zh-CN', //汉化
        autoclose: true //选择日期后自动关闭
    });
</script>