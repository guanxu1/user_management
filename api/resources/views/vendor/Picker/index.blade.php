<script language="JavaScript" src="{{ URL::asset('/') }}js/Picker/jquery-ui-1.8.17.custom.min.js"></script>
<script language="JavaScript" src="{{ URL::asset('/') }}js/Picker/jquery-ui-timepicker-addon.js"></script>
<script language="JavaScript" src="{{ URL::asset('/') }}js/Picker/jquery-ui-timepicker-zh-CN.js"></script>
<link rel="stylesheet" href="{{ URL::asset('/') }}css/Picker/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="{{ URL::asset('/') }}css/Picker/jquery-ui-timepicker-addon.css" />
<script>
    $(function() {
        $(".ui_timepicker").datetimepicker({
            showSecond: true,
            timeFormat: 'hh:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        })
    })
</script>
<input type="text"  class="ui_timepicker"  name="{{$name}}"  value="{{$value}}"  />