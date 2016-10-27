<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li><a href="/index.php/Portal/AdminPage/nongyao_add?comc=<?php echo ($product['companycode']); ?>&proc=<?php echo ($product['productcode']); ?>&type=<?php echo ($product['typenum']); ?>">添加<?php echo ($product["type"]); ?></a></li>
		</ul>
		<form class="js-ajax-form" method="post">
		<table class="table table-bordered">
		<tr>
			<td>当前产品：<?php echo ($product["name"]); ?></td>
		</tr>
		</table>

			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
												<th width="40"><?php echo ($product["type"]); ?>名称</th>
						<th width="80">添加时间</th>
						<th width="120"><?php echo L('ACTIONS');?></th>
					</tr>
				</thead>
				<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
										<td><a><?php echo ($vo["name"]); ?></a></td>
					<td><span><?php echo ($vo["addtime"]); ?></span></td>
					<td>
						<a href="/index.php/Portal/AdminPage/nongyao_delete?comc=<?php echo ($vo['companycode']); ?>&proc=<?php echo ($vo['productcode']); ?>&comid=<?php echo ($vo['id']); ?>" class="js-ajax-delete"><?php echo L('DELETE');?></a>


					</td>
				</tr><?php endforeach; endif; ?>
				<!-- <tfoot>
					<tr>
						<th width="16"><label><input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x"></label></th>
						<th width="100">ID</th>
						<th>产品名称</th>
						<th>种苗名称</th>
						<th width="80">出品公司</th>
						<th width="120"><span>添加时间</span></th>
						<th width="120"><?php echo L('ACTIONS');?></th>
					</tr>
				</tfoot> -->
			</table>
<!-- 			<div class="table-actions">
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('AdminPage/delete');?>" data-subcheck="true" data-msg="你确定删除吗？"><?php echo L('DELETE');?></button>
			</div> -->
			<div class="pagination"><?php echo ($Page); ?></div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
		setCookie('refersh_time', 0);
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location.reload();
			}
		}
		setInterval(function() {
			refersh_window()
		}, 2000);
	</script>
</body>
</html>