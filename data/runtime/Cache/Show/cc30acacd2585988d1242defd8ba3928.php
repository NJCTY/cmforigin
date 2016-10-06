<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  
        <title><?php echo ($company["name"]); ?></title>
        <link rel="stylesheet" href="/public/bower_components/weui/dist/style/weui.min.css"/>
        <link rel="stylesheet" href="/public/css/origin.css">
          <link rel="stylesheet" href="/public/assets/css/amazeui.min.css">
          <link href="/public/mui-0.7.5/css/mui.min.css" rel="stylesheet" type="text/css" />
<script src="/public/mui-0.7.5/js/mui.min.js"></script>
          <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="assets/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="/public/assets/css/app.css">
    </head>
    <body class="bg">
    	
    	<div>
   			 <div class="header">
        <img src="/public/image/<?php echo ($product["image"]); ?>" id="headimg">

          <div class="headtext">
            <h1><?php echo ($product["name"]); ?></h1>
						<p>上市时间: 2016.8.1 产地: 南京邮电大学</p>
				</div>
 		  </div>
 		   </div>
 		   				<div class="menu">
<div class="am-btn-group am-btn-group-justify">
 <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/index?id=<?php echo ($origincode); ?>">档案</a>
 <a type="button" class="am-btn am-btn-success am-active" href="/index.php/Show/index/video?id=<?php echo ($origincode); ?>">视频</a>
  <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/comment?id=<?php echo ($origincode); ?>">评分</a>
   <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/comp?id=<?php echo ($origincode); ?>">简介</a>
</div>
</div>

  			  <div class="info">
  			  		<div class="title">
  			  			<img src="/public/image/4.png" class="titleimg">
  			  		</div>
              </div>
  				<div class="info">
              <div class="title">
                <img src="/public/image/5.png" class="titleimg">
              </div>
  			  </div>
			<div class = "bottominfo">南京邮电大学®2016</div>
   		 	
    </body>
</html>