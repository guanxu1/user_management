<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary modal_save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
/**
 * @author: changshaoshuai changshaoshuai@wn518.com
 * @param  {[type]} title        [模态窗标题]
 * @param  {[type]} save_cn      [保存的文本]
 * @param  {[type]} body_builder [模态窗主题部分内容]
 * @param  {[type]} className    [确认标签的类名]
 */
function showModal(title, save_cn, body_builder, className) {  
  $('.modal').find('.modal-title').html(title);
  $('.modal').find('.modal_save').html(save_cn);
  $('.modal').find('.modal-body').html(body_builder);
  var classGroup = 'btn btn-primary modal_save '+className;
  $('.modal').find('.modal_save').attr('class', classGroup);
}
</script>