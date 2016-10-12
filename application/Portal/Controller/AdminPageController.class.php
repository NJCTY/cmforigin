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
	function companyinfo(){
		$admincode = sp_get_current_admin_id();
			if($check = M('company') ->where("admincode = ".$admincode)->find()){
				$check = M('company') ->where("admincode = ".$admincode)->select();
				$this->assign("company",$check[0]);
			}
		$this->display();
	}
	//文件上传函数
	function imgupload(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
            $info['success'] = false;
        }
        else{
			echo "hahahachengongle";
        }
	}
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
  	$url = $_GET['url'];
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
	
	
	
}