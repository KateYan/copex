<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:28 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{
    /*
     * 调用model menuitem
     * 查找推荐菜品一个和特价菜品两个
     * 加载普通用户菜单页面
     */
    public function showDailyMenu(){
//        $this->load->model('menuitem');
//        $data['title']='特价午餐菜单';
        $data['date']=date('m月d日');
//        $data['recommend']=$this->menuitem->recommend($_SESSION['cid']);
//        $data['saleitem']=$this->menuitem->saleitem($_SESSION['cid']);
//
        $data['title']='午餐菜单';
        $data['menuitem']=array('image'=>'../../css/images/3_03img01.jpg','name'=>'鱼香宫保鸡丁小份','price'=>'7.99');
        $this->load->view('partials/header',$data);
        $this->load->view('vipmenu',$data);
//
    }

//    public function loadVipmenu(){
//        $this->load->model('menu');
//
//
//
//        $this->load->view('vipmenu',$data);
//    }
}
