<script language="JavaScript" src="{{ URL::asset('/') }}js/uploadImg/swfupload1.js"></script>
<script language="JavaScript" src="{{ URL::asset('/') }}js/uploadImg/swfupload.queue.js"></script>
<script language="JavaScript" src="{{ URL::asset('/') }}js/uploadImg/fileprogress.js"></script>
<script language="JavaScript" src="{{ URL::asset('/') }}js/uploadImg/handlers.js"></script>
<link rel="stylesheet" href="{{ URL::asset('/') }}css/uploadImg/default.css" />
<script type="text/javascript">
    var swfu;
    var imgname = "{{$name}}";

    window.onload = function() {
        var settings = {
            flash_url : "{{ URL::asset('/') }}/js/uploadImg/swfupload.swf",
            upload_url: "{{ URL::action('FunctionController@uploadImg2') }}",
            post_params: {"limit" : "1"},
            file_size_limit : "100 MB",
            file_types : "*.jpg;*.jpeg;*.png;*.bmp",
            file_types_description :  "Web Image Files",
            file_upload_limit : 10,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,
            // Button settings
            button_image_url: "{{ URL::asset('/') }}/images/uploadimg.png",
            button_width: "100",
            button_height: "22",
            button_placeholder_id: "spanButtonPlaceHolder",
            button_text: '',
            button_text_style: ".theFont { font-size: 16; }",
            button_text_left_padding: 12,
            button_text_top_padding: 3,
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete
        };
        swfu = new SWFUpload(settings);
    };
</script>
<div>
    <div>
        <span id="spanButtonPlaceHolder"></span>
        <input id="btnCancel" type="hidden" value="" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
        <input type="hidden" id="uploadparam">&nbsp;&nbsp;<font style="color:red">图片为{{$width}}*{{$height}}的jpg图片，请注意选择</font>
    </div>
    <ul  id="imageView"></ul>
</div>
<script>
    $(document).ready(function(){
        //var editValue =value;
        var editValue = "{{$value}}";
        //console.log(editValue);
        if(editValue) {
            //var editObject =  eval(editValue);
            var editImgHtml = "";

            editImgHtml+= "<li><img src='"+editValue+"'><a style='cursor:pointer' onclick='$(this).parent().remove()'>&nbsp;删除</a><input type='hidden' name='"+imgname+"[]' value='"+editValue+"'></li>";

            $("#imageView").html(editImgHtml);
            $("#uploadparam").val('1');
        }
    });
</script>