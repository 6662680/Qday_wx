<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('mc/group/display');?>">会员组列表</a></li>
	<li <?php  if($do == 'post' && empty($groupid)) { ?>class="active"<?php  } ?>><a href="<?php  echo url('mc/group/post');?>">添加会员组</a></li>
	<?php  if($do == 'post' && !empty($groupid)) { ?><li class="active"><a href="<?php  echo url('mc/group/post', array('id' => $groupid));?>">编辑会员组</a></li><?php  } ?>
</ul>
<?php  if($do == 'display') { ?>
<script type="text/javascript">
	require(['jquery', 'util'], function($, u){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
</script>
<div class="panel panel-default">
<div class="panel-body table-responsive">
	<form action="" method="post" id="form1" >
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:15%">排序</th>
					<th style="width:30%">会员组名称</th>
					<th style="width:30%"></th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><input type="text" class="form-control orderlist" name="orderlist[<?php  echo $item['groupid'];?>]" value="<?php  echo $item['orderlist'];?>"></td>
					<td style="vertical-align:middle;">
						<input type="text" name="title[<?php  echo $item['groupid'];?>]" class="form-control" value="<?php  echo $item['title'];?>" />
					</td>
					<td style="vertical-align:middle;">
						<?php  if($item['isdefault'] == '1') { ?>
							<span class="label label-info">默认组</span>
						<?php  } ?>
					</td>
					<td style="vertical-align:middle;">
						<a href="<?php  echo url('mc/group/post', array('id' => $item['groupid']));?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>
						<a href="<?php  echo url('mc/group/delete', array('id' => $item['groupid']));?>" onclick="return confirm('确认删除吗？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a>
						<?php  if($item['isdefault'] != '1') { ?>
							<a href="<?php  echo url('mc/group/set', array('id' => $item['groupid']));?>" onclick="return confirm('每个公众号只能设置一个默认组，确定设置吗？');return false;" class="btn btn-default btn-sm">设为默认组</a>
						<?php  } ?>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="4" style="text-align:left">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
				</td>
			</tr>
		</table>
	</form>
</div>
</div>
<?php  } ?>
<?php  if($do == 'post') { ?>
<script>
	require(['jquery', 'util'], function($, u){
		$("#form2").submit(function(){
			if($.trim($(':text[name="title"]').val()) == '') {
				u.message('没有输入用户组名称.', '', 'error');
				return false;
			}
			var orderlist = parseInt($('#orderlist').val());
			if(isNaN(orderlist)) {
				u.message('排序值必须为数字.', '', 'error');
				return false;
			}
		});
	});
</script>
<div class="main">
	<form class="form-horizontal form" id="form2" action="" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				会员组参数
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">组名称</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">排序</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="orderlist" id="orderlist" value="<?php  echo $item['orderlist'];?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
			<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
		</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>