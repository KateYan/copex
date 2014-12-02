<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{
    /*
     * 加载普通用户菜单页面
     */
    public function loadMenu(){
        $this->load->view('menu');



//        $this->load->view('menu',$data);
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