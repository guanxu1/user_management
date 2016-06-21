<script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/uploadFile/bootstrap-filestyle.js') }}" type="text/javascript"></script>
<style>
    @if(!empty($uploadFile_width))
    .input-group{
        width: {{$uploadFile_width}}%;
    }
    @endif
</style>
<script>
    $(function() {
        $("#uploadfile{{$uploadFile_id}}").filestyle({});
    })
</script>
<input name='{{$uploadFile_name}}' type="file" id="uploadfile{{$uploadFile_id}}" class="filestyle" data-buttonName="btn-primary">