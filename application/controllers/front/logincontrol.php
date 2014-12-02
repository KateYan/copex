<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logincontrol extends MY_Controller{

    /*
     * 加载选校区页面
     */
    public function loadCampus(){
        $this->load->model('market');
        $data['result']=$this->market->getCampus();
        $this->load->view('front/campus',$data);
    }

    /*
     * 加载会员登陆界面
     */
    public function loadViplogin(){
        $this->load->view('front/vip/viplogin');
    }

    /*
     * 验证用户是否是vip
     * 确认是后更新cookie
     */
    public function login(){
        $uphone=$this->input->post('uphone');
        $this->load->model('market');
        $user=$this->market->isvip($uphone);
        if($user!=null){
            $vipid=$user->row(0);
            $_COOKIE['vipid']=$vipid->vipid;
            redirect('front/sessioncookie/setSession');
        }else{
            echo "error!";
        }
    }
}
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:27 PM
 */ 