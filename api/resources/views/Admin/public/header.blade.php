<html>
<head>
    <meta charset="utf-8">
    <script language="JavaScript" src="{{ URL::asset('/js/jquery.1.11.3.min.js') }}"></script>
    <script language="JavaScript" src="{{ URL::asset('/js/my.js') }}"></script>
    <script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/bootstrap.min.js') }}"></script>
    <script language="JavaScript" src="{{ URL::asset('/js/Bootstrap/bootstrap-treeview.js') }}"></script>
    <script language="JavaScript" src="{{ URL::asset('/js/Validform/Validform_v5.3.2_min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('/css/Bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/my.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/Validform/Validform.css') }}" />

    <script type="text/javascript">
        $(function(){
             $(".registerform").Validform();
        })
    </script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul id="main-nav" class="nav nav-tabs nav-stacked" style="">
                <li class="active">
                    <a href="#"><i class="glyphicon glyphicon-th-large"></i>首页</a>
                </li>
                @foreach(session::get("modules") as $val)
                    <li>
                        <a href="#systemSetting{{$val["id"]}}" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-cog"></i>{{$val["name"]}}<span class="pull-right glyphicon glyphicon-chevron-down"></span>
                        </a>
                            <ul id="systemSetting{{$val["id"]}}" class="nav nav-list collapse secondmenu" style="height: 0px;">
                                @foreach($val["modules_list"] as $val2)
                                    <li><a href="@if(!empty($val2["url"])){{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN."\\".$val2["url"]) }}@endif"><i class="glyphicon glyphicon-user"></i>{{$val2["name"]}}</a></li>
                                @endforeach
                            </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10" style="padding-left:0px;">
            <div class="panel panel-primary margin10" style="float:left;width:100%;min-height:650px;border-color:#3C4049;">
                <div class="panel-heading" style="background-color: #3C4049;">&nbsp;</div>
                <div class="panel-body">


