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
     * 判断cookie内容
     * 没有cookie uid 跳转加载选校区界面
     * 有则判断是否另外两个也有
     * 没有有另外两个则清空cookie转选校
     * 三个cookie都有判断user合法性
     * 合法加载对应菜单
     * 不合法清空cookie去选校
    */
    public function checkUserStatus(){
        if(isset($_COOKIE['uid'])){
            //如果有cookie cid和hash{
            //  调用validateUser方法
            //  如果返回值为真{判断用户类型，分别进入不同点餐页面}
            //  如果返回值为假{delete all cookie, 重定向到选校区方法}
            //}
            //如果不全有，删除所有cookie,跳转点餐页面
            if(isset($_COOKIE['cid'])&&isset($_COOKIE['uhash'])){
                $valid=$this->validateUser($_COOKIE['uid'],$_COOKIE['uhash']);
                if($valid){

                }
                else{
                    setcookie('uid','');
                    setcookie('cid','');
                    setcookie('uhash','');
                    return redirect('userlogincontroller/loadCampus');
                }
            }
            else{
                setcookie('uid','');
                setcookie('cid','');
                setcookie('uhash','');
                return redirect('userlogincontroller/loadCampus');
            }
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
