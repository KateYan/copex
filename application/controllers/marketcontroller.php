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
     * load model "menuitem" and using its method recommend() and saleitem()
     * to find validate menuitem
     * for loading vipusers or non-vip users' menu
     */
    public function showDailyMenu(){
//        $this->load->model('menuitem');
//        $data['title']='特价午餐菜单';
        $data['date']=date('m月d日');
//        $data['recommend']=$this->menuitem->recommend($_SESSION['cid']);
//        $data['saleitem']=$this->menuitem->saleitem($_SESSION['cid']);
//
        $data['title']='午餐菜单';
        $data['recommend']=(object) array('fpicture'=>'../../css/images/3_03img01.jpg','fname'=>'鱼香宫保鸡丁小份','fprice'=>'7.99');
        $data['saleItem']=(object) array(
            (object) array('fpicture'=>'../../css/images/1_04img02.jpg','fname'=>'蜜辣烤翅','fprice'=>'7.99'),
            (object) array('fpicture'=>'../../css/images/1_04img01.jpg','fname'=>'红烧鸭子','fprice'=>'7.99')
        );

        $this->load->view('partials/header',$data);
        if(isset($_SESSION['vipid'])){
            $this->load->view('vipmenu',$data);
            return false;
        }
        $this->load->view('dailymenu',$data);

    }

//    public function loadVipmenu(){
//        $this->load->model('menu');
//
//
//
//        $this->load->view('vipmenu',$data);
//    }
}
