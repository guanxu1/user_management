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
    <div class="container" style="width: 100%;padding:0;">
        <div class="navbar-collapse collapse" style="width: 100%;padding:0;">
            <ul class="nav navbar-nav" style="width: 100%">
                <li class="active" style="float:right"><a style="background-color:rgba(92, 173, 136, 0.92)" href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\LoginController@quit') }}">退 出</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul id="main-nav" class="nav nav-tabs nav-stacked" style="">
                <li class="active">
                    <a style="cursor:pointer" href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\IndexController@index') }}"><i class="glyphicon glyphicon-th-large"></i>首页</a>
                </li>
                @if(!empty(Session::get("modules")))
                @foreach(Session::get("modules")["modules"] as $val)
                    <li>
                        <a href="#systemSetting{{$val["id"]}}" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-cog"></i>{{$val["name"]}}<span class="pull-right glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul id="systemSetting{{$val["id"]}}" class="nav nav-list secondmenu collapse "  >
                                @foreach($val["list"] as $val2)
                                    <li><a id="color-eee{{$val["id"]}}-{{$val2["id"]}}" href="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ModulesController@select',["id"=>$val2["id"]]) }}"><i class="glyphicon glyphicon-user "></i>{{$val2["name"]}}</a></li>
                                @if(!empty($val2["url"]))
                                    @if( $val2["id"] == Session::get("select"))
                                        <script>
                                            $(document).ready(function(){
                                                $("#systemSetting{{$val["id"]}}").addClass("in");
                                                $("#color-eee{{$val["id"]}}-{{$val2["id"]}}").addClass("color-eee");
                                            });
                                        </script>
                                    @endif
                                @endif
                                @endforeach
                            </ul>
                    </li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="col-md-10" style="padding-left:0px;">
            <div class="panel panel-primary margin10" style="float:left;width:100%;min-height:650px;border-color:#3C4049;">
                <div class="panel-heading" style="background-color: #3C4049;">&nbsp;</div>
                <div class="panel-body">


