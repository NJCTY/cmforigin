<?php

namespace Show\Controller;
use Common\Controller\HomebaseController;
class IndexController extends HomebaseController{
    function index(){	
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);



        $this -> assign('product',$product[0]);
        $this -> assign('company',$company[0]);
        $this -> assign('origincode',$code['origincode']);
        $this->display('doc');
    }

    //显示评论函数
    function comment_index(){
        $code['companycode'] = $_POST['companycode'];
        $code['productcode'] = $_POST['productcode'];
        $dbcom = M('comment');
        if($dbcom -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'")->find())
        {
            //查看是否有评论
            $result = $dbcom -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'")->page($_POST['page'],5)->select();
            $result['exist'] = 1;
        }else{
            //如果没评论
            $result['exist'] = 0;
        }

        $this->ajaxreturn($result);
    }

    //添加新评论
    function comment_post(){
        // $ip = getip();
        // $code = codecheck();
        // if($dbstar->where("ip = '".$ip."' and productcode = '".$code['productcode']."' and companycode ='".$code['companycode']."'")->find())
        // {
            
        // }
    }




    //评论星级函数
    function star(){
        $flag = 0; //初始化flag
        $ip = getip();  //获取ip
        $code = codecheck(); //检查条码
        $dbstar = M("commentstar"); //实例化数据库类
        if($dbstar->where("ip = '".$ip."' and productcode = '".$code['productcode']."' and companycode ='".$code['companycode']."'")->find())
        {
            //如果该ip已经评分过 就修改评分
            $new['level'] = $_GET['level'];
            if($dbstar->where("ip = '".$ip."' and productcode = '".$code['productcode']."' and companycode ='".$code['companycode']."'")->save($new)){
                $flag = 1;
            }
        }else{
            //未评分 添加该ip评分信息
            $new['ip'] = $ip;
            $new['companycode'] = $code['companycode'];
            $new['productcode'] = $code['productcode'];
            $new['level'] = $_GET['level'];
            if($dbstar->data($new)->add()){
                $flag = 1;
            }
        }
    }

    function comp(){	
        $code = codecheck();
        $company = getcompany($code['companycode']);
        $product = getproduct($code['productcode']);
        $this -> assign('origincode',$code['origincode']);
        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this->display('comp');
    }

    function video(){	
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);


        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this -> assign('origincode',$code['origincode']);
        $this->display('video');
    }
    function comment(){
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);
        $star = getstar();
        $this -> assign('star',$star);
        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this -> assign('origincode',$code['origincode']);
        $this->display('comment');
    }
    }
