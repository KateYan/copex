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

    public function index()
    {
    }
    /* 微信二级菜单主入口控制方法。
     * 判断cookie内容
     * uid，cid, vipid 全空跳转加载选校区界面
     * 只有vipid为空为普通用户再次登录，设置session 用户信息
     * 全部不为空为会员再次登陆，设置session用户信息
    */
    public function checkStatus(){

    if(isset($_COOKIE['cid'])){

    }
        redirect('userlogincontroller/loadCampus');
//
//        elseif(isset($_COOKIE['cid']) && isset($_COOKIE['uid']) && empty($_COOKIE['vipid'])){
//            redirect('userlogincontroller/setSession');
//        }
//        elseif(isset($_COOKIE['cid']) && isset($_COOKIE['uid']) && isset($_COOKIE['vipid'])){
//            redirect('userlogincontroller/setSession');
//        }

    }
    /*
     * 检查用户合法性
     */
    public function validateUser($uid,$uhash){
        return true;
    }
    /*
     * 校区界面post 校区id=>cid
     * 新建一个普通用户只有uid,校区，ip，hash
     * 设置uid,cid,hash的cookie
     * 设置uid，cid,hash的session
     * 跳转去加载菜单页面
     */
    public function campusCookie(){
        $cid=$this->input->post('cid');
        $this->load->model('user');
        $newUser=$this->user->newUser($cid);

        setcookie('cid',$cid);
        setcookie('uid',$newUser->uid);
        setcookie('uhash',$newUser->uhash);

        $_SESSION['cid']=$cid;
        $_SESSION['uid']=$newUser->uid;
        $_SESSION['uhash']=$newUser->uhash;

        redirect('marketcontroller/loadMenu');
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
