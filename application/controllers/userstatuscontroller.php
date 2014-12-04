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
     * 判断cookie进入不同页面
    */
    public function checkUserStatus(){
        if(isset($_COOKIE['uid'])){
            if($this->validateUser($_COOKIE['uid'],$_COOKIE['uhash'])){ //合法用户
                $this->load->model('user');
                $oldUser=$this->user->oldUser($_COOKIE['uid']);
                //调用model user的方法设置用户cookie和session
                $this->user->login($oldUser);
                return redirect('marketcontroller/loadMenu');
            }
            else {//非法法用户
                unset($_COOKIE['uid']);
                return redirect('userlogincontroller/loadCampus');
                return false;
            }
         }
        return redirect('userlogincontroller/loadCampus');
    }


    /*
     * 检查用户合法性
     */
    private function validateUser($uid,$uhash){
        //添加用户合法性验证代码
        $this->load->model('user');
        $oldUser=$this->user->oldUser($uid);
        if($uhash==$oldUser->uhash){
            return true;
        }
        return false;
    }

}
