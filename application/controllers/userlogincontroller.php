<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:27 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlogincontroller extends MY_Controller{

    /*
     * 加载选校区页面
     */
    public function loadCampus(){
        $this->load->model('market');
        $data['title']='选择你所在的校区';
        $data['result']=$this->market->getCampusList();
        $this->load->view('partials/header',$data);
        $this->load->view('campus',$data);
    }

    /*
     * 校区界面post 校区id=>cid
     * 新建一个普通用户只有uid,校区，ip，hash
     * 设置uid,cid,hash的cookie
     * 设置uid，cid,hash的session
     * 跳转去加载菜单页面
     */
    public function setUser(){
        if(!isset($_COOKIE['uid'])){
            $cid=$this->input->post('cid');
            $this->load->model('user');
            $newUser=$this->user->newUser($cid);
            $this->user->login($newUser);
        } elseif(isset($_POST['cid'])){
            //老用户改校区
        } else{
            //点错页面的用户
        }

        redirect('marketcontroller/loadMenu');
    }



    /*
     * 加载会员登陆界面
     */
    public function loadViplogin(){
        $this->load->view('viplogin');
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
            redirect('userlogincontroller/setSession');
        }else{
            echo "error!";
        }
    }
}
