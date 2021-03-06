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
<script type="text/javascript" src="/public/js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="/public/js/jquery.raty.js"></script>


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
        <img src="<?php echo ($product["imgbg"]); ?>" id="headimg">

          <div class="headtext">
            <h1><?php echo ($product["name"]); ?></h1>
						<p>上市时间: <?php echo ($batch["outtime"]); ?> 产地: <?php echo ($batch["place"]); ?></p>
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

  			  <div class="info" style="height: auto;overflow: display;">
  			  		<div class="title">
  			  			<img src="/public/image/6.png" class="titleimg">
              </div>
<div class="companyinfo">

                <div class="c100 p<?php echo ($percent); ?> small circle">
                    <span><?php echo ($percent); ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div class= "companyname" style="width: 170px;">
                  <h3 id = "welcome">欢迎评价此产品：


                  </h3>
                  <h3 id ="thank">感谢您的评价！</h3>
<div >
  <div id="star1" style="width:300px;"></div>
  <div id="result1"></div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  if(<?php echo ($star["level"]); ?>){
    $("#welcome").hide();
  }else{
    $("#thank").hide();
  }

});

rat('star1','result1',5);
function rat(star,result,m){

  star= '#' + star;
  result= '#' + result;
  $(result).hide();//将结果DIV隐藏

  $(star).raty({
    path: "/public/images",
    starOff: 'star-off-big.png',
    starOn: 'star-on-big.png',
    number: 5,
    score: <?php echo ($star["level"]); ?>,
        size: 48,
    target: result, 
    targetKeep : true,//targetKeep 属性设置为true，用户的选择值才会被保持在目标DIV中，否则只是鼠标悬停时有值，而鼠标离开后这个值就会消失
    click: function (score, evt) {
        alert('感谢您的评价！');
        $.ajax({url:"/index.php/Show/index/star?id=<?php echo ($origincode); ?>&level="+score,async:false});
        $("#welcome").hide();
        $("#thank").show();
    }
  });
}
</script>
                </div>

</div>
            <div class="mui-divider"></div>
            <div style="left:1%"> 
              
              <p style= "color:#8A8B8C;">近期点评</p>
            </div>
            <div id = "contentcom">
            </div>
<script type="text/javascript">

function getcomment(page){
    $.post("/index.php/Show/index/comment_index",{
    productcode:"<?php echo ($product["productcode"]); ?>",
    companycode:"<?php echo ($product["companycode"]); ?>",
    page:page
    },function(data){
    for(var k=0;k<5;k++)
    {
        $("#contentcom").append("<div class='comtext' id='div+"+k+"'> <p >"+data[k]['content']+"</p><p style='font-size:10px;margin-left:70%;'>"+data[k]['timestamp']+"</p></div><div class='mui-divider'></div>");
     }


    }
    );
}



$(document).ready(function(){
  var page = 1;
getcomment(page);
$("#more").click(function(){
  page = page + 1;
   getcomment(page);
});

$("#buttonone").click(function(){
   var textdata =$("#postdata").val();
   var currentlength =$("#postdata").val().length; 
   if(currentlength<=50){
       $.post("/index.php/Show/index/comment_post",{
    productcode:"<?php echo ($product["productcode"]); ?>",
    companycode:"<?php echo ($product["companycode"]); ?>",
    data:textdata
    },function(data){
      if(data['isdone'] == 1){
        alert("评论成功!");
         window.location.reload();
      }
      else
        alert("每个用户只允许评论一次哦！");
    }
    );}
       else
        alert("字数请不要超过50字谢谢！");
});

$("#writecomment").click(function(){
  $("#textarea").show();
  $('html, body, .content').animate({scrollTop: $(document).height()}, 300); 
return false; 
});

});
</script>


              </div>
              <div>            <p id="more" style="text-align: center;">更多评论</p>
</div>

              <div class="info" style="height:40px;">          
                 <div class="title">
                <img src="/public/image/7.png" class="titleimg" id="writecomment">
              </div>
              </div>
              <div class="info" style="height:120px;display: none;" id="textarea">          <form>
                  <textarea class = "writetext" id="postdata"></textarea>
                  
                  <div id = "buttonone" style = "float:right;width: 100px;height: 20px;background-color: #46A3FF;color: white;text-align: center;font-family: 黑体;margin-top: 10px;margin-right: 20px;">提交评论</div>
                  </form>
              </div>
              <br>
			<div class = "bottominfo">南京邮电大学®2016</div>
   		 	
    </body>
</html>