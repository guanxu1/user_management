<div class="form-group ">
    品类：<select name="{{$group_name}}"       class="form-control selectWidth rows_display" onchange="category_classify('{{URL::action("ServiceController@classify")}}',$(this),'0')"  id="group_name{{$id}}"></select>
    品种：<select name="{{$classify_name}}"   class="form-control selectWidth rows_display"   id="classify_name{{$id}}"></select>
</div>
<script>
    $(function() {
        var group_html      = "<option value='{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}'>不限</option>";
        var classify_html   = "<option value='{{\App\Utils\All\ConstantUtil::GLOBAL_ALL}}'>不限</option>";
        $.ajax({
            type: 'POST',
            url:"{{ URL::action("ServiceController@group") }}",
            data: {},
            success: function(result){
                var obj = eval('(' + result + ')') ;
                if(result != "") {
                    $.each(obj,function(key,val){
                        group_html+= '<option value="'+val.id+'"  >'+val.name+'</option>';
                    });
                    $("#group_name{{$id}}").html(group_html);
                    var group_value = $("#group_name{{$id}}").val();
                    $.ajax({
                        type: 'POST',
                        url:"{{ URL::action("ServiceController@classify") }}",
                        data: {classify:group_value},
                        success: function(result) {

                        }
                    });
                }
                $("#classify_name{{$id}}").html(classify_html);
            }
        });
    })
</script>