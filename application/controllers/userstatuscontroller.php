<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 4:10 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userstatuscontroller extends MY_Controller
{
    /* wechat enterence to copex
     * judge cookie to enter different controller-methods
    */
    public function checkUserStatus(){
        if(isset($_COOKIE['uid'])){
            $oldUser = $this->validateUser($_COOKIE['uid'],$_COOKIE['uhash']);
            if($oldUser){ //legal user
                //request user model's method login() to set cookies and sessions for user
                $this->user->login($oldUser);
                return redirect('marketcontroller/showDailyMenu');
            }
            else {//illegal user
                setcookie('uid','',time()-3600);
                delete_cookie('uid');
                return redirect('userlogincontroller/loadCampus');
            }
        }
        return redirect('userlogincontroller/loadCampus');
    }
    /*
     * Validate user by checking uid-uhash pair
     */
    private function validateUser($uid,$uhash){
        //code for validating user
        $this->load->model('user');
        $oldUser = $this->user->oldUser($uid);
        if($uhash==$oldUser->uhash){
            return $oldUser;
        }
        return false;
    }
}