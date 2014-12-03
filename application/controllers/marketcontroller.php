<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{
    /*
     * 加载普通用户菜单页面
     */
    public function loadMenu(){
        $this->load->model('menuitem');
        $cid=$_SESSION['cid'];
        $data['$base_url']=base_url();
        $data['date']=date('m月d日');
        $data['recommend']=$this->menuitem->recommend($cid);
        $data['saleitem']=$this->menuitem->saleitem($cid);
//
        $this->load->view('dailymenu',$data);
//
    }

    public function loadVipmenu(){
        $this->load->model('menu');



        $this->load->view('vipmenu',$data);
    }
}
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:28 PM
 */ 