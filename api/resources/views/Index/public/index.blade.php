@include('Ys.public.header')

<div class="panel panel-primary margin10 floatDiv" style="width:99%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title">版本详情</h3>
    </div>
    <div class="panel-body">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover wrfont14">
            <thead>
            <tr>
                <th>版本</th>
                <th>更新标题</th>
                <th>更新内容</th>
                <th>创建时间</th>
            </tr>
            </thead>
            <tr>
                <td>Laravel_V2.01</td>
                <td>新增公共服务</td>
                <td>
                    1.新增公共路由器（路由根目录）【方便调用公共M接口】<br>
                    2.新增公共服务器文件（C根目录）【公共数据调用接口，只针对后台系统使用】<br>
                    3.新增一/二级分类公共接口（include("vendor.Ys.classify",["group_name"=>"group_name","classify_name"=>"classify_name","id"=>1])）
                </td>
                <td>2016-03-18 14:50:00</td>
            </tr>
            <tr>
                <td>YS_V2.01</td>
                <td>新增公共服务</td>
                <td>
                    1.新增优惠券分享功能
                </td>
                <td>2016-03-18 14:50:00</td>
            </tr>
            <tbody>
            </tbody>
        </table>
   </div>
</div>

@include('Ys.public.footer')
