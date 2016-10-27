<?php

namespace Show\Controller;
use Common\Controller\HomebaseController;
class IndexController extends HomebaseController{
    function index(){	
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);
        $batch = getbatch($code['batchcode']);
        if(M('nongyao') -> where("productcode = '".$code['productcode']."' and companycode = '".$code['companycode']."' and type = '1'")->find()){
        $nongyao = M('nongyao') -> where("productcode = '".$code['productcode']."' and companycode = '".$code['companycode']."' and type = '1'")->page(1,6)->select();
        $nongyaoisset = 1;
}
    else{
        $nongyaoisset = 0;
}
            if(M('nongyao') -> where("productcode = '".$code['productcode']."' and companycode = '".$code['companycode']."' and type = 2")->find()){
        $feiliao = M('nongyao') -> where("productcode = '".$code['productcode']."' and companycode ='".$code['companycode']."' and type = 2")->page(1,6)->select();
        $feiliaoisset = 1;
    }
    else{
        $feiliaoisset = 0;
    }
        $this -> assign('batch',$batch[0]);
        $this -> assign('nongyao',$nongyao);
        $this -> assign('nongyaoisset',$nongyaoisset);
        $this -> assign('feiliaoisset',$feiliaoisset);
        $this -> assign('feiliao',$feiliao);
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
            $result = $dbcom -> where("companycode = '".$code['companycode']."' and productcode = '".$code['productcode']."'")->order("comment_id desc")->page($_POST['page'],5)->select();
            $result['exist'] = 1;
        }else{
            //如果没评论
            $result['exist'] = 0;
        }

        $this->ajaxreturn($result);
    }

    //添加新评论
    function comment_post(){
        $ip = getip();
        $code['companycode'] = $_POST['companycode'];
        $code['productcode'] = $_POST['productcode'];
        $db = M("comment");
        if($db->where("ip = '".$ip."' and productcode = '".$code['productcode']."' and companycode ='".$code['companycode']."'")->find())
        {
            $result['flag'] = 1;
            $result['isdone'] = 0;
        }else{
            $data['content'] = $_POST['data'];
            $data['productcode'] = $code['productcode'];
            $data['companycode'] = $code['companycode']; 
            $data['ip'] = $ip;
            if($db -> data($data)->add()){
                $result['isdone'] = 1;
            }else{
                $result['isdone'] = 0;
            }
        }
        $this->ajaxreturn($result);
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
    function imgpost(){
                $code['companycode'] = $_POST['companycode'];
        $code['productcode'] = $_POST['productcode'];
        $dbcom = M('image');
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
    function comp(){	
        $code = codecheck();
        $company = getcompany($code['companycode']);
        $product = getproduct($code['productcode']);
                $batch = getbatch($code['batchcode']);

$this -> assign('batch',$batch[0]);
        $this -> assign('origincode',$code['origincode']);
        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this->display('comp');
    }

    function video(){	
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);
        $batch = getbatch($code['batchcode']);

$this -> assign('batch',$batch[0]);

        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this -> assign('origincode',$code['origincode']);
        $this -> display('video');
    }
    function morepic(){
        $code = codecheck();
        $company = getcompany($code['companycode']);
        $product = getproduct($code['productcode']);
                $batch = getbatch($code['batchcode']);

$this -> assign('batch',$batch[0]);
        $this -> assign('origincode',$code['origincode']);
        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this->display();
    }
    function comment(){
        $code = codecheck();
        $product = getproduct($code['productcode']);
        $company = getcompany($code['companycode']);
        $star = getstar();
        $batch = getbatch($code['batchcode']);

$this -> assign('batch',$batch[0]);
        //计算星数百分比
        $total = M('commentstar') -> where("productcode = '".$code['productcode']."' and companycode = '".$code['companycode']."'")->count();
        $dbstar =  M('commentstar') -> where("productcode = '".$code['productcode']."' and companycode = '".$code['companycode']."'")->select();
        $count = 0;
        foreach ($dbstar as $key => $value) {
            $count = $count + $value['level'];
        }
        $result = 100*(int)($count / ($total * 5));
        $this -> assign('percent',$result);
        $this -> assign('star',$star);
        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this -> assign('origincode',$code['origincode']);
        $this->display('comment');
    }
    }
