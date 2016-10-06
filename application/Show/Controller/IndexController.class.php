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


        $this -> assign('company',$company[0]);
        $this -> assign('product',$product[0]);
        $this -> assign('origincode',$code['origincode']);
        $this->display('comment');
    }
    }
