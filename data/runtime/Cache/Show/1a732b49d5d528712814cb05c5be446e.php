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
 <!--          MUI -->
<link href="/public/mui-0.7.5/css/mui.min.css" rel="stylesheet" type="text/css" />

<script src="/public/js/jquery.js"></script>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
var geocoder,map,marker = null;
var init = function() {
    var center = new qq.maps.LatLng(39.916527,116.397128);
    map = new qq.maps.Map(document.getElementById('container'),{
        center: center,
        zoom: 15
    });
    //调用地址解析类
    geocoder = new qq.maps.Geocoder({
        complete : function(result){
            map.setCenter(result.detail.location);
            var marker = new qq.maps.Marker({
                map:map,
                position: result.detail.location
            });
        }
    });
        var address = "中国,南京,栖霞区,文苑路9号";
    //通过getLocation();方法获取位置信息值
    geocoder.getLocation(address);
}
</script>
<script type="text/javascript" src="/public/js/Chart.min.js"></script>
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
    <body class="bg" onload="init()">
    	
    	<div>
   			 <div class="header">
        <img src="<?php echo ($product["imgbg"]); ?>" id="headimg">

          <div class="headtext">
            <h1><?php echo ($product["name"]); ?></h1>
						<p>上市时间: 2016.8.1 产地: 南京邮电大学</p>
				</div>
 		  </div>
 		   </div>
 		   				<div class="menu">
<div class="am-btn-group am-btn-group-justify">
 <a type="button" class="am-btn am-btn-success am-active" href="/index.php/Show/index/index?id=<?php echo ($origincode); ?>">档案</a>
 <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/video?id=<?php echo ($origincode); ?>">视频</a>
  <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/comment?id=<?php echo ($origincode); ?>">评分</a>
   <a type="button" class="am-btn am-btn-success" href="/index.php/Show/index/comp?id=<?php echo ($origincode); ?>">简介</a>
</div>
</div>
<script type="text/javascript">
//地图
$(document).ready(function(){
  $("#divmap").click(function(){
    if($("#container").css("display")=="none"){
$("#container").show();
$("#mapcontainer").css("height","250px");
}else{
$("#container").hide();
$("#mapcontainer").css("height","100px");
}
  });
});
  //图片
$(document).ready(function(){
  $("#divimg").click(function(){
    if($("#flagtwo").css("display")=="none"){
      $("#flagtwo").show();
$("#imgcontainer").css("height","250px");
}else{
  $("#flagtwo").hide();
$("#imgcontainer").css("height","50px");
}
  });
});
//肥料
$(document).ready(function(){
  $("#divfn").click(function(){
    if($("#flagthree").css("display")=="none"){
      $("#flagthree").show();
$("#fncontainer").css("height","250px");
}else{
  $("#flagthree").hide();
$("#fncontainer").css("height","50px");
}
  });
});
//曲线
$(document).ready(function(){
  $("#divqx").click(function(){
    if($("#flagfour").css("display")=="none"){
      $("#flagfour").show();
$("#qxcontainer").css("height","250px");
}else{
  $("#flagfour").hide();
$("#qxcontainer").css("height","50px");
}
  });
});
//曲线
$(document).ready(function(){
  $("#divkind").click(function(){
    if($("#flagfive").css("display")=="none"){
      $("#flagfive").show();
$("#kindcontainer").css("height","250px");
}else{
  $("#flagfive").hide();
$("#kindcontainer").css("height","50px");
}
  });
});
</script>









  			  <div class="info"  style="height:250px;" id="mapcontainer">
  			  		<div class="title docmap" >
  			  			<img src="/public/image/8.png" class="titleimg" id="divmap" >
                <h2 class="map">南京文苑路基地</h2>
                

  			  		</div>
              <div id="container" class="mapimg" ></div>
          </div>
          <div class="info" style="height:250px;overflow:hidden;" id="imgcontainer">
              <div class="title"  style="background-color:rgb(24,114,222);">
                <img src="/public/image/11.png" class="titleimg" id="divimg">
              </div>
              <div>
                <div class="imgone">
                  <img src="<?php echo ($product["imgone"]); ?>" class="oneimg" id="flagtwo">
                </div>
                 <div class="imgsecond">
                  <div class="imgtwo">
                    <img src="<?php echo ($product["imgtwo"]); ?>" class="twoimg" >
                  </div>
                 <div class="imgtwo">
                    <img src="<?php echo ($product["imgthree"]); ?>" class="twoimg">                
                 </div>
                <div class="imgtwo">
                    <img src="<?php echo ($product["imgfour"]); ?>" class="twoimg">                
                 </div>
               </div>
              </div>
          </div>
   <div class="info" style="height:250px;" id="fncontainer">

              <div class="title">
                <img src="/public/image/13.png" class="titleimg" id="divfn">
              </div>
              <div id="feiliao">
                <div style="float:left;font-family:黑体;margin-top:20px;margin-left:45px;" >
                  <h1 id="flagthree">肥料</h1>
                </div>
                <div style="float:left;font-family:黑体;font-size:3em;margin-top:20px;color:#D1D2D3;margin-left:45px;" id="feiliaozero">
                  零使用
                </div>
              </div>      
              <div class="mui-divider"></div>
              <div id="feiliao">
                <div style="float:left;font-family:黑体;margin-top:20px;margin-left:45px;" >
                  <h1>农药</h1>
                </div>
                <div style="float:left;font-family:黑体;font-size:3em;margin-top:20px;color:#D1D2D3;margin-left:45px;" id="nongyaozero">
                  零使用
                </div>
              </div>
   </div>







<!-- 图表 -->
   <div class="info" style="height:250px;" id="qxcontainer">

              <div class="title">
                <img src="/public/image/12.png" class="titleimg" id="divqx">
              </div>
              <div id="flagfour"></div>
              <canvas id="myChart" style="width:100%;height:200px;"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
       labels : ["2016.3","4","5","6","7","8","9"],
  datasets : [
    {
      label: "光照时长（h）",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(42,71,254,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
      data : [11,10,9,12,12,11,9]
    },
    {
      label: "平均气温（℃）",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(255,194,35,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
      data : [12,11,12,6,12,11,9]
    }
  ]
    }
});
</script>

   </div>
          <div class="info" style="height:250px;" id="kindcontainer">
              <div class="title">
                <img src="/public/image/10.png" class="titleimg" id="divkind">
              </div>
              <div class="companyinfo" style="height:110px;" >
      
                <img class="am-circle companyimg" id="flagfive" src="<?php echo ($product["imgbg"]); ?>" width="90" height="90" style="border:1px solid #D1D2D3;" />
              
              <div class= "companyname">
                <h2>
                  品名:<?php echo ($product["kindname"]); ?>
                </h2>
                <p>
                  <?php echo ($product["kindtime"]); ?>
                </p>
                </div>

              </div>
              <div class="companyinfo">
              
<div class="mui-divider">
  
</div>
              <p class="infotext"><?php echo ($product["kindintroduction"]); ?></p>
              </div>      
          </div>

			<div class = "bottominfo">南京邮电大学®2016</div>
   		 	
    </body>
</html>