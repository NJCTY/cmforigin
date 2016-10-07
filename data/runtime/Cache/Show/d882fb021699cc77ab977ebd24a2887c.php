<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <style type="text/css">
    .circle{
      top:20px;
      left:20px;
      display: inline-block;
    }
    .line{
      margin-top: 130px;
    }
  </style>
        <title><?php echo ($company["name"]); ?></title>
                <link rel="stylesheet" href="/public/css/circle.css">
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
 <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/video?id=<?php echo ($origincode); ?>">视频</a>
  <a type="button" class="am-btn am-btn-success am-active" href="/index.php/Show/index/comment?id=<?php echo ($origincode); ?>">评分</a>
   <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/comp?id=<?php echo ($origincode); ?>">简介</a>
</div>
</div>

  			  <div class="info">
  			  		<div class="title">
  			  			<img src="/public/image/6.png" class="titleimg">
              </div>
<div class="companyinfo">

                <div class="c100 p30 small circle">
                    <span>30%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div class= "companyname" style="left:10%;top:15px;">
                  <h3>评分等级：</h3>
                  <p>评分人数：              好评数：      </p>
                </div>

</div>
            <div class="mui-divider"></div>
            <div style="left:1%"> 
              
              <p style= "color:#8A8B8C;">高票点评</p>
            </div>




              </div>


              <div class="info" style="height:40px;">          
                 <div class="title">
                <img src="/public/image/7.png" class="titleimg">
              </div>
              </div>
			<div class = "bottominfo">南京邮电大学®2016</div>
   		 	
    </body>
</html>