<html>
<head>
    <meta charset="utf-8">  
<style>
body {
	margin:0;
	padding:0;
	color: #555;
	background:#f5f5f5  ;
	font-size:12px;
}
.a_search table {
    font-size:14px;font-family:"微软雅黑";
	overflow:hidden;
	border:1px solid #d3d3d3;
	background:#fefefe;
	width:95%;
	margin:1% auto 0;
	-moz-border-radius:5px; /* FF1+ */
	-webkit-border-radius:5px; /* Saf3-4 */
	border-radius:5px;
	-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
.a_search th,.a_search  td {height:50px ; padding:0px 20px;text-align:left;}
.a_search input  { padding:3px 15px; margin-right:20px;}
.content-data-list a {color:#EA8956;text-decoration:none}
.content-data-list a:hover {color:red;}
.content-data-list table {
    font-size:14px;
    font-family:"微软雅黑";
	overflow:hidden;
	border:1px solid #d3d3d3;
	background:#fefefe;
	width:95%;
	margin:1% auto 0;
	-moz-border-radius:5px; /* FF1+ */
	-webkit-border-radius:5px; /* Saf3-4 */
	border-radius:5px;
	-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}

.content-data-list th,.content-data-list  td {height:50px ; padding:0px 5px;text-align:center;}
.content-data-list th label { padding:10px 20px;cursor:pointer }
.content-data-list td  label{ padding:10px 35px;cursor:pointer }
.content-data-list th { text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
.content-data-list td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
.content-data-list tr.odd-row td {background:#f6f6f6;}
.area-remove-data{border-radius:3px;border:1px #DCB0B0 solid ;width : auto;padding:3px;text-align: center;float:left;margin:5px;}
.css-remove{ cursor:pointer;margin-left:5px;display:inline-block; width:13px; height:2px; background:#D26D6D; font-size:0; line-height:0;vertical-align:middle;-webkit-transform: rotate(45deg);}
.css-remove:after { content:'.'; display:block; width:13px; height:2px; background:#D26D6D;-webkit-transform: rotate(-90deg);}
.span-remove { padding:1px; cursor:pointer}
.content-data-list .text-left {text-align: left;}

</style>
<script language="JavaScript" src="{{ URL::asset('/js/jquery-1.7.1.min.js') }}"></script>
<script language="JavaScript" src="{{ URL::asset('/js/my.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('/css/page.css') }}" />
</head>
<body>

