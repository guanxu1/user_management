$(document).ready(function(){ 

	$("#box_checkall").click(function() {

		var checkall = $(".box_checkall").attr('checked');
		if(checkall == 'checked') {
			$('.box_check').each(function(){
               $(this).attr("checked",true);
            });
		}else{
			$('.box_check').each(function(){
               $(this).attr("checked",false);
            });
		}
	});

    $(".onlyInt").keyup(function(){
        var val = $(this).val();
        var num = val.replace(/[^0-9]*/g,"");
        $(this).val(num);
    });

});

    function getByteLen(val) {
        var len = 0;
       for (var i = 0; i < val.length; i++) {
                var a = val.charAt(i);
                len += 1;
            }
        return len;
    }
// 只要键盘一抬起就验证编辑框中的文字长度，最大字符长度可以根据需要设定
    function checkLength(obj,id,length) {
        var value = obj.value;
        //alert(value);
        var maxChars = length;//最多字符数
        var curr = maxChars - getByteLen(obj.value);
        if (curr > 0) {
                document.getElementById(id).innerHTML = curr.toString();
            } else {
                document.getElementById(id).innerHTML = '0';
                obj.value = cutstr(value,length);
            }
    }

    /**
      * js截取字符串，中英文都能用
      * @param str：需要截取的字符串
      * @param len: 需要截取的长度
      */
    function cutstr(str, len) {
        var str_length = 0;
        var str_len = 0;
        str_cut = new String();
        str_len = str.length;
        for (var i = 0; i < str_len; i++) {
            a = str.charAt(i);
            str_length++;
            str_cut = str_cut.concat(a);
            if (str_length >= len) {
                return str_cut;
            }
        }
        //如果给定字符串小于指定长度，则返回源字符串；
        if (str_length < len) {
            return str;
        }
    }

function selectMarket(nowSubsection,toUrl) {
    $.ajax({
        type: 'POST',
        url:toUrl+"?subsection_id="+nowSubsection,
        data: {subsection:nowSubsection},
        success: function(data){
            var html;
            if(data != "") {
                var obj = eval('(' + data + ')') ;
                $.each(obj,function(key,val){
                    html+= '<option value='+val.id+'>'+val.name+'</td>';
                });
                $("#market").html(html);
            }else{
                $("#market").html('<option></option>');
            }
        }
    });
}
	
	
function add_input(id,message) {
	
	var obj = $("."+id+":last");
	var holde;
	if(message) {
		holde = message;
	} else {
		holde = "默认标签名称";
	}
	var str = '<div class="form-group width50 add_input" id="add_input"><input type="text" class="form-control"  placeholder="'+holde+'" name="name[]" datatype="*1-8"  nullmsg="'+message+'不可为空！" errormsg="请输入0~8个汉字" ></div>';
	obj.after(str);
 
}

function delete_href(url){
	 if(confirm("确定删除该数据吗？"))
	 {
		window.location.href=url;
	 }
}
/**
 *
 * @param url
 * @param __this
 * @param option_default    => 不限初始值
 */
function category_classify(url,__this,option_default) {
	var group_value = __this.val();
    var html   = "<option value='"+option_default+"'>不限</option>";
	$.ajax({
        type: 'POST',
        url:url,
        data: {group:group_value},
        success: function(data){
            if(data != "") {
                var obj = eval('(' + data + ')') ;
                $.each(obj,function(key,val){
                    html+= '<option value='+val.id+'>'+val.name+'</td>';
                });
                __this.next().html(html);
            }else{
                __this.next().html(html);
            }
        }
    });
}

function category_market(url,__this,option_default) {
    var subsection_value = __this.val();
    var html   = "<option value='"+option_default+"'>不限</option>";
    $.ajax({
        type: 'POST',
        url:url,
        data: {subsection:subsection_value},
        success: function(data){
            if(data != "") {
                var obj = eval('(' + data + ')') ;
                $.each(obj,function(key,val){
                    html+= '<option value='+val.id+'>'+val.name+'</td>';
                });
                __this.next().html(html);
            }else{
                __this.next().html(html);
            }
        }
    });
}
function remove_parent2(__this) {
	__this.parent().parent().remove();
}

//切换地区
function subSectionChange(type,url) {
    var subsection_id = $("#subsection_id").val();
    var market_id 	 = $("#market_id").val();
    var company_id 	 = $("#company_id").val();

    $.ajax({
        url : url,
        type : 'post',
        async : false,
        data : {
            type: type ,
            subsection_id : subsection_id,
            market_id 	 : market_id,
            company_id 	 : company_id,
        },
        success : function(data) {
            data = JSON.parse(data);
            showAfterChangeList(data, type);
        }
    });
}
function showAfterChangeList(data, type) {
    var marketBuilder = "<option value='-1'>全部</option>";
    var companyBuilder = "<option value='-1'>全部</option>";
    if(type == 'subsection') {
        //显示市场列表
        for(var i=0; i<data.market_list.length; i++) {
            marketBuilder += "<option value="+data.market_list[i].market_id+">"+data.market_list[i].market_name+"</option>";
        }
        $("#market_id").html(marketBuilder);

        //显示公司列表
        for(var i=0; i<data.company_list.length; i++) {
            companyBuilder += "<option value="+data.company_list[i].company_id+">"+data.company_list[i].company_name+"</option>";
        }
        $("#company_id").html(companyBuilder);


    }

    if(type == 'market') {
        for(var i=0; i<data.company_list.length; i++) {
            companyBuilder += "<option value="+data.company_list[i].company_id+">"+data.company_list[i].company_name+"</option>";
        }
        $("#company_id").html(companyBuilder);


    }

}
