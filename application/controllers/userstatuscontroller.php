<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 4:10 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userstatuscontroller extends MY_Controller
{

    /* 微信二级菜单主入口控制方法。
     * 根据cookie进入不同页面
    */
    public function checkUserStatus(){
        if(isset($_COOKIE['uid'])){
            /*
             * 调用vailidatauer方法
             * 返回
             */
         }
        return redirect('userlogincontroller/loadCampus');
    }


    /*
     * 检查用户合法性
     */
    public function validateUser($uid,$uhash){
        //添加用户合法性验证代码
        //
        //
        return true;
    }



    /*
     * 为用户设置每次订餐行为的session
     * 1.新普通用户输入电话的时候
     * 2.新vip登陆成功的时候
     * 3.所有用户再次点击订餐的时候
     */
    public function setSession(){
        $data['uid']=$_COOKIE['uid'];
        $data['vipid']=$_COOKIE['vipid'];
        $data['cid']=$_COOKIE['cid'];
        $this->load->model('market');
        $dataset=$this->market->
        $this->load->model('user');
        $buyer=new User($dataset);
        if($_COOKIE['vipid']==NULL){
            redirect('marketcontroller/loadMenu');
        }else redirect('marketcontroller/loadVipmenu');
    }
}
