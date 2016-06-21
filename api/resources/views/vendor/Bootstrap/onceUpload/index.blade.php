<link href="{{ URL::asset('/css/Bootstrap/onceUpload/fileinput.css') }}" rel="stylesheet">
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/onceUpload/fileinput.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/onceUpload/fileinput_locale_fr.js') }}" type="text/javascript"></script>
<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/onceUpload/fileinput_locale_es.js') }}" type="text/javascript"></script>
<input name="@if(!empty($onceUpload_name)){{$onceUpload_name}}@endif" type="file" multiple data-show-upload="false" data-show-caption="true"  @if(!empty($onceUpload_datatype))datatype="{{$onceUpload_datatype}}"@endif @if(!empty($onceUpload_nullmsg))nullmsg="{{$onceUpload_nullmsg}}"@endif >
<script type="text/javascript">
$("input[name={{$onceUpload_name}}]").fileinput({
    @if(!empty($onceUpload_value))
    initialPreview: [
        "<img src='{{$onceUpload_value}}' class='file-preview-image' alt='The Moon' title='The Moon' name='ccccccccc'>"
    ]
    @endif
});
</script>
