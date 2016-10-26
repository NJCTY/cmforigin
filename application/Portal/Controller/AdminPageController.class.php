<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\AdminbaseController;
class AdminPageController extends AdminbaseController {
	protected $posts_model;
	function _initialize() {
		parent::_initialize();
		$this->posts_model =D("Common/Posts");
	}
	//修改公司信息
	function companyinfo(){
		$admincode = sp_get_current_admin_id();
			if($check = M('company') ->where("admincode = ".$admincode)->find()){
				$check = M('company') ->where("admincode = ".$admincode)->select();
				$this->assign("company",$check[0]);
			}
		$this->display();
	}
	//批次添加函数
	function batch_add(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息

		$dbp = M('product');
		$post = $dbp ->where("companycode = '".$cominfo[0]['code']."'")->select();

		$this -> assign("product",$post);
		$this->display();
	}
	//批次上传函数
	function batch_post(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		$data['basename'] = $_POST['basename'];
		$data['place'] = $_POST['place'];
		$data['baseplace'] = $_POST['baseplace'];
		$data['outtime'] = $_POST['outtime'];
		$data['productcode'] = $_POST['productcode'];
		$data['companycode'] = $cominfo[0]['code'];
		$data['admincode'] = $admincode;
		$id = M('batch') -> max('id');
		$data['batchcode'] = $id + 1 + 100000;
		if(M('batch')->data($data)->add())
		{
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
	}
	//批次修改上传函数
		function batch_edit_post(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		$data['basename'] = $_POST['basename'];
		$data['place'] = $_POST['place'];
		$data['baseplace'] = $_POST['baseplace'];
		$data['outtime'] = $_POST['outtime'];
		if(M('batch')->where("companycode = '".$_POST['companycode']."' and productcode = '".$_POST['productcode']."' and batchcode ='".$_POST['batchcode']."'")->save($data))
		{
				$this->success("修改成功！");
			} else {
				$this->error("修改失败！");
			}
	}
	//评论删除函数
	function comment_delete(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		if($cominfo[0]['code']==$_GET['comc']){
			if(M('comment')->where("companycode = '".$_GET['comc']."' and productcode = '".$_GET['proc']."' and comment_id ='".$_GET['comid']."'")->delete()){
				$this->success("删除成功！");
			}else{
				$this->success("删除失败！");
			}
		}else{
			$this->success("删除失败！");
		}
	}
		//农药函数
	function nongyao_delete(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		if($cominfo[0]['code']==$_GET['comc']){
			if(M('nongyao')->where("companycode = '".$_GET['comc']."' and productcode = '".$_GET['proc']."' and id ='".$_GET['comid']."'")->delete()){
				$this->success("删除成功！");
			}else{
				$this->success("删除失败！");
			}
		}else{
			$this->success("删除失败！");
		}
	}
	//批次修改页面
	function batch_edit(){
		$code = codecheck();
		$batch = M('batch') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."' and batchcode ='".$code['batchcode']."'")->select();
		$this->assign("batch",$batch[0]);

		$this->display();
	}


	//批次显示函数
	function batch_index(){
		if(isset($_GET['id'])){
		$code = codecheck();
		$db = M('batch');
		$data = $db -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'")->select();
			$product = M('product') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'")->select();
		$this->assign("product",$product[0]);
		$this->assign('posts',$data);
		$this->display();	
	}else{
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select();
		$db = M('batch');
		$posts = $db ->where("companycode = '".$cominfo[0]['code']."'")->select();
		$dbp = M('product');
		$post = $dbp ->where("companycode = '".$cominfo[0]['code']."'")->select();
		$post[0]['name'] = "全部产品";
		$this->assign("posts",$posts);
		$this->assign("name",$cominfo[0]['name']);
		$this->assign("product",$post[0]);
		$this->assign("code",$cominfo[0]['code']);
		$this->display();	
	}
	}

	//提交新产品函数
	function post(){
		if (IS_POST) {
			            $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息

        }
        else{
			 foreach($info as $file){
                 $img ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['savepath'].$file['savename'];
                                    }
             $data['image'] = $img;
        }
			//接收post信息
			$data['name'] = $_POST['name'];
			$data['money'] = $_POST['money'];
			$data['introduction'] = $_POST['introduction'];
			$data['admincode'] = sp_get_current_admin_id();
			if($check = M('company') ->where("admincode = ".$data['admincode'])->find()){
				$check = M('company') ->where("admincode = ".$data['admincode']) ->save($data);
			}else{
				$check = M('company') ->data($data)->add();//创建公司代码
				$addinfo = M('company') ->where("admincode = ".$data['admincode']) ->select();
				$code['code'] = 10000 + $addinfo[0]['com_id'] - 1;
				$check = M('company') ->where("admincode = ".$data['admincode']) ->save($code);
			}
			echo "公司信息修改完成！";
		}
	}

	//产品信息管理页面
	function index(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select();
		$db = M('product');
		$posts = $db ->where("companycode = '".$cominfo[0]['code']."'")->select();
		$this->assign("posts",$posts);
		$this->assign("name",$cominfo[0]['name']);
		$this->assign("code",$cominfo[0]['code']);
		$this->display();
	}

	function recyclebin(){
		$where_ands=array("post_type=2 and post_status=0");
		$fields=array(
				'start_time'=> array("field"=>"post_date","operator"=>">"),
				'end_time'  => array("field"=>"post_date","operator"=>"<"),
				'keyword'  => array("field"=>"post_title","operator"=>"like"),
		);
		if(IS_POST){
		
			foreach ($fields as $param =>$val){
				if (isset($_POST[$param]) && !empty($_POST[$param])) {
					$operator=$val['operator'];
					$field   =$val['field'];
					$get=$_POST[$param];
					$_GET[$param]=$get;
					if($operator=="like"){
						$get="%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}else{
			foreach ($fields as $param =>$val){
				if (isset($_GET[$param]) && !empty($_GET[$param])) {
					$operator=$val['operator'];
					$field   =$val['field'];
					$get=$_GET[$param];
					if($operator=="like"){
						$get="%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}
		
		$where= join(" and ", $where_ands);
		
		$count=$this->posts_model->where($where)->count();
		$page = $this->page($count, 20);
		
		$posts=$this->posts_model->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
		
		$users_obj=M("Users");
		$users_data=$users_obj->field("id,user_login")->where("user_status=1")->select();
		$users=array();
		foreach ($users_data as $u){
			$users[$u['id']]=$u;
		}
		$this->assign("users",$users);
		
		$this->assign("Page", $page->show('Admin'));
		$this->assign("formget",$_GET);
		$this->assign("posts",$posts);
		$this->display();
	}
	
	function add(){
         $this->display();
	}
	
	function add_post(){
		if (IS_POST) {
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
  		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    	$file   =   $upload->upload();
    if(!$file) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        else{
       		$data['imgbg'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgbg']['savepath'].$file['imgbg']['savename'];
        	$data['imgone'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgone']['savepath'].$file['imgone']['savename'];
        	$data['imgtwo'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgtwo']['savepath'].$file['imgtwo']['savename'];
			$data['imgthree'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgthree']['savepath'].$file['imgthree']['savename'];
       		$data['imgfour'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgfour']['savepath'].$file['imgfour']['savename'];
	    }
	$data['name'] = $_POST['name'];
	$data['nongyao'] = $_POST['nongyao'];
	$data['huafei'] = $_POST['huafei'];
	$data['guangzhao'] = $_POST['guangzhao'];
	$data['qiwen'] = $_POST['qiwen'];
	$data['kindname'] = $_POST['kindname'];
	$data['kindtime'] = $_POST['kindtime'];
	$data['kindintroduction'] = $_POST['kindintroduction'];
	$id = M('product') -> max('product_id');
	$data['productcode'] = $id + 1 + 1000;
	$data['companycode'] = getcompanycode(sp_get_current_admin_id());

	if($db = M('product') -> data($data) ->add()){
		$isdone = 1;
	}else{
		$isdone =0;
	}
		if ($isdone == 1) {
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
		}
	}
	
	public function edit(){
		$code = codecheck(); //分解条码
		$info = M('product') ->where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") -> select();
		$this->assign('info',$info[0]);
		$this->assign('companycode',$code['companycode']);
		$this->assign('productcode',$code['productcode']);
		$this->display();
	}
	
	public function qrcode($level=3,$size=4)
  {
  	$id = $_GET['id'];
  	$url = "http://".$_SERVER['SERVER_NAME']."/Show?id=".$id;
       Vendor('phpqrcode.phpqrcode');
       $errorCorrectionLevel =intval($level) ;//容错级别 
       $matrixPointSize = intval($size);//生成图片大小 
       //生成二维码图片 
       $object = new \QRcode();
       $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);  
  }

	public function edit_post(){
		if (IS_POST) {
			$com = getcompany($_POST['companycode']);
			if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限删除本产品

		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
  		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    	$file   =   $upload->upload();
    if($file) {
           if($file['imgbg']!=NULL)
       		$data['imgbg'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgbg']['savepath'].$file['imgbg']['savename'];
       	if($file['imgone']!=NULL)
        	$data['imgone'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgone']['savepath'].$file['imgone']['savename'];
        if($file['imgtwo']!=NULL)
        	$data['imgtwo'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgtwo']['savepath'].$file['imgtwo']['savename'];
        if($file['imgthree']!=NULL)
			$data['imgthree'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgthree']['savepath'].$file['imgthree']['savename'];
		if($file['imgfour']!=NULL)
       		$data['imgfour'] ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['imgfour']['savepath'].$file['imgfour']['savename'];
	    }

	$data['name'] = $_POST['name'];
	$data['nongyao'] = $_POST['nongyao'];
	$data['huafei'] = $_POST['huafei'];
	$data['guangzhao'] = $_POST['guangzhao'];
	$data['qiwen'] = $_POST['qiwen'];
	$data['kindname'] = $_POST['kindname'];
	$data['kindtime'] = $_POST['kindtime'];
	$data['kindintroduction'] = $_POST['kindintroduction'];

	if($db = M('product') -> where("companycode = '".$_POST['companycode']."' and productcode = '".$_POST['productcode']."'")->save($data) ){
		$isdone = 1;
	}else{
		$isdone =0;
	}
		}
		else{
			$isdone = 0;
		}
		}

			if ($isdone == 1) {
				$this->success("保存成功！");
			} else {
				$this->error("保存失败！");
			}
	}
	
	function delete(){
		$code = codecheck(); //分解条码
		$com = getcompany($code['companycode']); //获得公司信息
		if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限删除本产品
			if($info = M('product') ->where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") -> delete()){ //删除
				$isdone = 1;
			}else{
				$isdone = 0;
			}
		}else{
			echo "无权限，请联系超级管理员。";
			$isdone = 0;
		}
			if ($isdone) {	//向前端返回结果
					$this->success("删除成功！");
				} else {
					$this->error("删除失败！");
				}
	}

	function batch_delete(){
		$code = codecheck(); //分解条码
		$com = getcompany($code['companycode']); //获得公司信息
		if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限删除本产品
			if($info = M('batch') ->where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."' and batchcode ='".$code['batchcode']."'") -> delete()){ //删除
				$isdone = 1;
			}else{
				$isdone = 0;
			}
		}else{
			echo "无权限，请联系超级管理员。";
			$isdone = 0;
		}
			if ($isdone) {	//向前端返回结果
					$this->success("删除成功！");
				} else {
					$this->error("删除失败！");
				}
	}

	function restore(){
		if(isset($_GET['id'])){
			$id = intval(I("get.id"));
			$data=array("id"=>$id,"post_status"=>"1");
			if ($this->posts_model->save($data)) {
				$this->success("还原成功！");
			} else {
				$this->error("还原失败！");
			}
		}
	}
	
	function clean(){
		
		if(isset($_POST['ids'])){
			$ids = implode(",", $_POST['ids']);
			if ($this->posts_model->where("id in ($ids)")->delete()!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		if(isset($_GET['id'])){
			$id = intval(I("get.id"));
			if ($this->posts_model->delete($id)!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	}
//评论管理函数
	function comment_manage(){
		$code = codecheck();
						$com = getcompany($code['companycode']); //获得公司信息
		if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限
		$posts = M('comment') ->where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") -> select();
		$this -> assign("posts",$posts);
		$this ->display();
	}else{
		$this->error("无权限进行此操作");
	}

}
//农药肥料post函数
	function nongyao_post(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		$data['name'] = $_POST['nongyaoname'];
		$data['addtime'] = $_POST['addtime'];
		$data['type'] = $_POST['type'];
		$data['productcode'] = $_POST['productcode'];
		$data['companycode'] = $cominfo[0]['code'];
		if($_POST['companycode'] == $cominfo[0]['code']){
		if(M('nongyao')->data($data)->add())
		{
			$this->success("添加成功!");
		} 
		else{
			$this->error("添加失败！");
			}
		}else{
			$this->error("添加失败！");
			}
	}
//农药肥料添加函数
	function nongyao_add(){
		if($_GET['type'] == 1){
			$type['name'] = "农药";
			$type['id'] = 1;
		}
		else{
			$type['name'] = "肥料";
			$type['id'] = 2;
		}

		$product = M('product')->where("companycode = '".$_GET['comc']."' and productcode = '".$_GET['proc']."'")->select();
		$this->assign("product",$product[0]);



		$this->assign("type",$type);
		$this->display();
	}
//农药肥料显示函数
	function nongyao_index(){
		$code = codecheck();
				$com = getcompany($code['companycode']); //获得公司信息
		if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限
				$data = M('nongyao') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."' and type = ".$_GET['type']) ->select();
				$product = M('product') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") ->select();
				if($_GET['type']==1){
					$product[0]['type'] = "农药";
					$product[0]['typenum'] = 1;
				}
				else{
					$product[0]['type'] = "化肥";
					$product[0]['typenum'] = 2;
				}
					$this->assign("posts",$data);
					$this->assign("product",$product[0]);

		$this->display();
	}else{
		$this->error("无权限进行此操作");
	}
}

//图片管理函数
	function image_index(){
		$code = codecheck();
				$com = getcompany($code['companycode']); //获得公司信息
		if($com[0]['admincode'] == sp_get_current_admin_id()){ //判断此管理员是否有权限
				$data = M('image') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") ->select();
				$product = M('product') -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'") ->select();

					$this->assign("posts",$data);
					$this->assign("product",$product[0]);

		$this->display();
	}else{
		$this->error("无权限进行此操作");
	}
	}
	function image_delete(){
		$admincode = sp_get_current_admin_id();
		$dbcompany = M('company');
		$cominfo = $dbcompany -> where('admincode ='.$admincode) ->select(); //根据管理员id找到公司信息
		if($cominfo[0]['code']==$_GET['comc']){
			if(M('image')->where("companycode = '".$_GET['comc']."' and productcode = '".$_GET['proc']."' and id ='".$_GET['comid']."'")->delete()){
				$this->success("删除成功！");
			}else{
				$this->success("删除失败！");
			}
		}else{
			$this->success("删除失败！");
		}
	}
	function image_add(){
		$product = M('product')->where("companycode = '".$_GET['comc']."' and productcode = '".$_GET['proc']."'")->select();
		$this->assign("product",$product[0]);
		$this->display();

	}
	function image_post(){
				if (IS_POST) {
			           $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
        }
        else{
			 foreach($info as $file){
                 $img ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['savepath'].$file['savename'];
                                    }
             $data['src'] = $img;
             $data['productcode'] = $_POST['productcode'];
             $data['companycode'] = $_POST['companycode'];
        }
        if(M('image')->data($data)->add()){
        	$this->success("上传成功");
        }else{
        	$this->error("上传错误");
        }
	}
	
}
}