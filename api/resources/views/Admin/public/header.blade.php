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
                <li>
                    <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                        <i class="glyphicon glyphicon-cog"></i>系统管理<span class="pull-right glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul id="systemSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
                        <li><a href="#"><i class="glyphicon glyphicon-user"></i>模块管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="./plans.html">
                        <i class="glyphicon glyphicon-credit-card"></i>
                        物料管理
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="panel panel-primary margin10" style="float:left;width:75%">
                <div class="panel-heading">
                    <h3 class="panel-title wrfont16" id="right_title">系统结构</h3>
                </div>
                <div class="panel-body">


