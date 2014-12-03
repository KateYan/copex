<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 2014-11-16
 * Time: 2:33 PM
 */
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();

        session_start();

//        setcookie('cid','');
//        $this->input->set_cookie('cid');
////        setcookie('uid','');
//////        $this->input->set_cookie('uid','');
//        $this->input->set_cookie('uid');
////        setcookie('vipid','');
//////        $this->input->set_cookie('vipid','');
//        $this->input->set_cookie('vipid');

    }

}
