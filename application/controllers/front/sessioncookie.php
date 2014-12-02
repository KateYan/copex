<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessioncookie extends MY_Controller
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
    public function checkCookies(){


        if(($_COOKIE['uid']=='')&&($_COOKIE['cid']=='')&&($_COOKIE['vipid']=='')){
            redirect('front/logincontrol/loadCampus');
        }
        elseif(($_COOKIE['uid']!='')&&($_COOKIE['cid']!='')&&($_COOKIE['vipid']!='')){
            redirect('front/sessioncookie/setSession');
        }
        elseif($_COOKIE['uid']!=null&&$_COOKIE['cid']=!null&&$_COOKIE['vipid']==null){
            redirect('front/sessioncookie/setSession');
        }

    }

    /*
     * 校区界面post 校区id=>cid
     * 设置校区cookie['cid']
     */
    public function campusCookie(){
        $cid=$this->input->post('cid');
        $_COOKIE['cid']=$cid;

        redirect('front/marketcontrol/loadMenu');
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
            redirect('front/marketcontrol/loadMenu');
        }else redirect('front/marketcontrol/loadVipmenu');
    }
}
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 4:10 PM
 */ 