@include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.header')
    <div style="float:left;width:100%">
        <form  action="{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\UserController@add') }}" method="post" id="form1" class="registerform"  >
            <div class="form-group width50">
                <label for="exampleInputEmail1">用户名：<font  color="red">*</font></label>
                <input type="text" class="form-control"  placeholder="用户名" name="username" datatype="*"  nullmsg="用户名不可为空！"  >
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">密码：<font  color="red">*</font></label>
                <input type="password" class="form-control"  placeholder="密码" name="password" datatype="*"  nullmsg="密码不可为空！" >
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">确认密码：<font  color="red">*</font></label>
                <input type="password" class="form-control"  placeholder="确认密码" name="twopassword" datatype="*" recheck="password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！">
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">电话号码：</label>
                <input type="text" class="form-control"  placeholder="电话号码1~11位" name="mobile" datatype="m"  ignore="ignore"  errormsg="手机号码格式不对！">
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">真实姓名：</label>
                <input type="text" class="form-control"  placeholder="真实姓名" name="name" >
            </div>
            <div class="form-group width50">
                <label for="exampleInputEmail1">权限：</label>
                <select class="form-control width50 " name="rank" id="class_relation">
                    @foreach(\App\Utils\ConstantUtil::poserList() as $key => $val)
                        <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
    @include(''.\App\Utils\ConstantUtil::PROJECT_ADMIN.'.public.footer')
