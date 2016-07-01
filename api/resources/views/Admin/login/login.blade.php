<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form Template</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/css/login/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/login/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/login/form-elements.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/login/style.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Favicon and touch icons -->
</head>
<body>
<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3><b>管理系统</b></h3>
                            <p>请输入你的用户名和密码</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>

                    <div class="form-bottom">
                        <form action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\LoginController@valid') }}" method="post"  class="login-form" role="form" >
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="username" placeholder="用户名" class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="password" placeholder="密码" class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" class="btn">登 陆</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script language="JavaScript" src="{{ URL::asset('/js/login/jquery-1.11.1.min.js') }}"></script>
<script language="JavaScript" src="{{ URL::asset('/js/login/bootstrap.min.js') }}"></script>
<script language="JavaScript" src="{{ URL::asset('/js/login/jquery.backstretch.min.js') }}"></script>
<script language="JavaScript" src="{{ URL::asset('/js/login/scripts.js') }}"></script>
<script language="JavaScript" src="{{ URL::asset('/js/login/placeholder.js') }}"></script>


</body>

</html>