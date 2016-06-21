<div class="form-group @if(!empty($market_class)){{$market_class}}@endif">
    地区：<select name="{{$subsection_name}}"  class="form-control selectWidth rows_display" onchange="category_market('{{URL::action("ServiceController@market")}}',$(this),'-1')"  id="subsection_name{{$id}}"></select>
    市场：<select name="{{$market_name}}"   class="form-control selectWidth rows_display"   id="market_name{{$id}}"></select>
</div>
<script>
    $(function() {
        var subsection_html     = "<option value='{{\App\Utils\All\ConstantUtil::GLOBAL_CITY_ALL}}'>不限</option>";
        var market_html         = "<option value='{{\App\Utils\All\ConstantUtil::GLOBAL_CITY_ALL}}'>不限</option>";
        var subsection_id       = @if(!empty($subsection_id)) {{$subsection_id}} @else -1 @endif;
        var market_id           = @if(!empty($market_id)) {{$market_id}} @else -1 @endif;
            $.ajax({
                type: 'POST',
                url:"{{ URL::action("ServiceController@subsection") }}",
                data:"",
                success: function(result){
                    var obj = eval('(' + result + ')') ;
                    if(result != "") {
                        $.each(obj,function(key,val){
                            if(subsection_id==val.id){
                                subsection_html+= '<option value="'+val.id+'" selected>'+val.name+'</option>';
                            }else{
                                subsection_html+= '<option value="'+val.id+'">'+val.name+'</option>';
                            }
                        });
                        $("#subsection_name{{$id}}").html(subsection_html);
                        if(market_id==-1){
                            $("#market_name{{$id}}").html(market_html);
                        }else{
                            $.ajax({
                                type: 'POST',
                                url:"{{ URL::action("ServiceController@market") }}",
                                data:{subsection:subsection_id},
                                success: function(results) {
                                    if(results!= ""){
                                        var objs = eval('(' + results + ')');
                                        $.each(objs,function(keys,vals){
                                            if(market_id==vals.id){
                                                market_html+= '<option value="'+vals.id+'" selected>'+vals.name+'</option>';
                                            }else{
                                                market_html+= '<option value="'+vals.id+'">'+vals.name+'</option>';
                                            }
                                        });
                                    }
                                    $("#market_name{{$id}}").html(market_html);
                                }
                            });

                        }
                    }
                }
            });

    })
</script>