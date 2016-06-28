function checkBoxAll(__this) {
	var checkall = __this.prop('checked');
	var sonClass = __this.attr("alt");

	if(checkall) {
		$('.'+sonClass+'').each(function(){
           $(this).prop("checked",true);
        });
	}else{
		$('.'+sonClass+'').each(function(){
           $(this).prop("checked",false);
        });
	}

}



