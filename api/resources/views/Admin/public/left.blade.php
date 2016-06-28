<link rel="stylesheet" href="{{ URL::asset('/css/Ztree/metro.css') }}">
<script src="{{ URL::asset('/js/Ztree/jquery.ztree.all-3.5.min.js') }}"></script>
<script>
    var zTree;
    var demoIframe;
    function addHoverDom(treeId, treeNode) {
        var sObj = $("#" + treeNode.tId + "_span");
        var addStr ="";
        if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
        addStr += "<span class='button add'    title='添加' id='addBtn_" + treeNode.tId + "'></span>";
        addStr += "<span class='button edit'   title='编辑' id='editBtn_" + treeNode.tId + "'></span>";
        addStr += "<span class='button remove' title='删除' id='removeBtn_" + treeNode.tId
        + "' title='add node' onfocus='this.blur();'></span>";
        sObj.after(addStr);
        sObj.click(function(){
            window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ArticleController@index')}}'+'?id='+treeNode.id;
        });
        var btn = $("#addBtn_"+treeNode.tId);
        if (btn) btn.bind("click", function(){
            window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@addShow')}}'+'?id='+treeNode.id;
            //alert(treeNode.id);
            /*
             var zTree = $.fn.zTree.getZTreeObj("treeDemo");
             zTree.addNodes(treeNode, {id:(1000 + newCount), pId:treeNode.id, name:"new node" + (newCount++)});
             return false;
             */
        });
        var edit_btn = $("#editBtn_"+treeNode.tId);
        if (edit_btn) edit_btn.bind("click", function(){
            window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@editorShow')}}'+'?id='+treeNode.id;
        });

        var remove_btn = $("#removeBtn_"+treeNode.tId);
        if (remove_btn) remove_btn.bind("click", function(){
            if(confirm("是否删除该栏目")){
                window.location.href='{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@delete')}}'+'?id='+treeNode.id;
            }

        });
    };
    $(function(){
        var setting = {
            check: {
                enable: true
            },
            view: {
                addHoverDom: addHoverDom,
                removeHoverDom: removeHoverDom,
                dblClickExpand: false,
                showLine: true,
                selectedMulti: false
            },
            data: {
                simpleData: {
                    enable:true,
                    idKey: "id",
                    pIdKey: "pId",
                    rootPId: ""
                }
            },
            callback: {
                beforeClick: function(treeId, treeNode) {
                    var zTree = $.fn.zTree.getZTreeObj("tree");
                    if (treeNode.isParent) {
                        zTree.expandNode(treeNode);
                        return false;
                    } else {
                        demoIframe.attr("src",treeNode.file + ".html");
                        return true;
                    }
                }
            }
        };
        $.ajax({
            type: 'POST',
            url:"{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@index')}}",
            data: {subsection:'123'},
            success: function(data){
                zNodes = new Array();
                var obj = eval('(' + data + ')') ;
                $.each(obj,function(key,val){
                    zNodes[key] = {id:val.column_id, pId:val.column_parent, name:val.name};
                    if(val.column_open == '1') {
                        zNodes[key].open = true;
                    }else{
                        zNodes[key].open = false;
                    }
                });
                var t = $("#tree");
                t = $.fn.zTree.init(t, setting, zNodes);
                demoIframe = $("#testIframe");
                demoIframe.bind("load", loadReady);
                var zTree = $.fn.zTree.getZTreeObj("tree");
                zTree.selectNode(zTree.getNodeByParam("id", 101));
            }
        });
        $.ajax({
            type: 'POST',
            url:"{{ URL::action(\App\Utils\ConstantUtil::PROJECT_ADMIN.'\ColumnController@info')}}",
            success: function(data){
                var html="";
                var obj = eval('(' + data + ')') ;
                $.each(obj,function(key,val){
                    html+=val.name+' > ';
                });
                $("#right_title").html(html);
            }
        });

    });

    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_"+treeNode.tId).unbind().remove();
        $("#removeBtn_"+treeNode.tId).unbind().remove();
        $("#editBtn_"+treeNode.tId).unbind().remove();
    };
    function loadReady() {
        var bodyH = demoIframe.contents().find("body").get(0).scrollHeight,
                htmlH = demoIframe.contents().find("html").get(0).scrollHeight,
                maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
                h = demoIframe.height() >= maxH ? minH:maxH ;
        if (h < 530) h = 530;
        demoIframe.height(h);
    }


</script>

<div class="panel panel-primary margin10" style="float:left;width:20%;">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16">Tree</h3>
    </div>
    <div class="panel-body">
        <ul id="tree" class="ztree"></ul>
    </div>
</div>
<div class="panel panel-primary margin10" style="float:left;width:75%">
    <div class="panel-heading">
        <h3 class="panel-title wrfont16" id="right_title"></h3>
    </div>
    <div class="panel-body">
