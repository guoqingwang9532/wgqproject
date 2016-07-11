<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/wgqproject/Public/Backend/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/wgqproject/Public/Backend/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/wgqproject/Public/Backend/css/style.css" rel="stylesheet" type="text/css" />
<link href="/wgqproject/Public/Backend/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c"> <span class="select-box inline">
		<select name="" class="select">
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> 日期范围：
		<input type="text" class="input-text Wdate" style="width:120px;">
		-
		<input type="text"  class="input-text Wdate" style="width:120px;">
		<input type="text" name="" id="" placeholder=" 资讯名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" id='delck'class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="article_add('添加资讯','article-add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标题</th>
					<th width="80">分类</th>
					<th width="80">来源</th>
					<th width="120">更新时间</th>
					<th width="75">浏览次数</th>
					<th width="60">发布状态</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td><input type="checkbox" value="<?php echo ($vol["id"]); ?>" name="ckdel"class='ck'></td>
					<td><?php echo ($vol["id"]); ?></td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"><?php echo ($vol["title"]); ?></u></td>
					<td><?php echo ($vol["catename"]); ?></td>
					<td><?php echo ($vol["source"]); ?></td>
					<td><?php echo (date('Y-m-d H:i:s',$vol["update_time"])); ?></td>
					<td><?php echo ($vol["r_count"]); ?></td>
					<td class="td-status"><span class="label label-success radius">
					<?php if($vol["status"] == 0 ): ?>草稿<?php elseif( $vol["status"] == 1 && $vol["isold"] == 0 ): ?>已发布<?php else: ?> <span class="label label-defaunt radius">已下架</span><?php endif; ?>
					</span></td>
					<td class="f-14 td-manage">
					<?php if($vol["status"] == 1 ): if($vol["isold"] == 0 ): ?><a style="text-decoration:none" onClick="article_stop(this,<?php echo ($vol["id"]); ?>)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
					<?php else: ?>
					<a style="text-decoration:none" onClick="article_start(this,<?php echo ($vol["id"]); ?>)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a><?php endif; endif; ?>
					<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo ($vol["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/wgqproject/Public/Backend/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/wgqproject/Public/Backend/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="/wgqproject/Public/Backend/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/wgqproject/Public/Backend/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/wgqproject/Public/Backend/js/H-ui.js"></script> 
<script type="text/javascript" src="/wgqproject/Public/Backend/js/H-ui.admin.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: "/wgqproject/index.php/Backend/Info/article_add"
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href ='/wgqproject/index.php/Backend/Info/delOne/id/'+id;
	});
}
/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗?',function(index){
	/*	$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});*/
/*
		$.get("<?php echo U('Info/haha');?>",{'id':id},function(data){
			if(data == 2 ){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已下架!',{icon: 5,time:1000});
				alert(data);
			}
			
		})*/
	window.location.href = '/wgqproject/index.php/Backend/Info/haha/id/'+id;
	//alert(123)
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		/*$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});*/
		window.location.href = '/wgqproject/index.php/Backend/Info/haha/id/'+id;
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
$(function(){
  $('#delck').on('click',function(){
  	   var id = $(':checkbox:checked');
  	   //alert(id);
  	  //alert(id.val());
  	   //alert(1233)
  	  //循环
  	  var ids = '';
  	  for (var i = 0;i<id.length; i++) {
  	  	 ids = ids + id[i].value + ','; 
  	  }
  	  ids = ids.substring(0,ids.length-1);
  	  window.location.href = '/wgqproject/index.php/Backend/Info/delAll/ids/'+ids;
  })
	
})

</script> 
</body>
</html>