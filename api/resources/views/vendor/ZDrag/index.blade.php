<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
	<script language="JavaScript" src="{{ URL::asset('/') }}js/ZDrag/zDrag.js"></script>
	<script language="JavaScript" src="{{ URL::asset('/') }}js/ZDrag/zDialog.js"></script>
	<script language="JavaScript" src="{{ URL::asset('/js/jquery-1.7.1.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('/') }}css/ZDrag/style.css" />
    <script type="text/javascript">
	$(function() {
		$("#ZDragClick").click(function() {
			var diag = new Dialog();
            diag.Title = "{{$title}}";
            diag.URL = "{{URL::asset($url)}}";
			diag.Width      = 1200;
            diag.OKEvent = function(){
				var value =  diag.innerFrame.contentWindow.document.getElementsByName ('param');
				alert(value[0]);
				$("#ZDragShow").html(
					'123'
				);
				diag.close();
			};
            diag.show();
            //var doc=diag.innerFrame.contentWindow.document;
            doc.open();
            doc.close();
		})
	})
    </script>
</head>
<body>
<div id="content">
    <h3>{{$title}}</h3>
    <div class="item">
        <input type="text" id="getval" value="窗口的值33返回到这里"/>
    </div>
</div>

</body>
</html>