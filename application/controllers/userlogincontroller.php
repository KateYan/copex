<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:27 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlogincontroller extends MY_Controller{

    /*
     * load campus choosing page
     */
    public function loadCampus(){
        $data['title'] = '选择你所在的校区';
        $this->load->model('market');
        $data['result'] = $this->market->getCampusList();
        $this->load->view('campus',$data);
    }
    /*
     * set cookies and sessions for user
     */
    public function setUser(){
        // make usre user did choose one campus
        if(empty($_POST['cid'])){
            return redirect('userlogincontroller/loadCampus');
        }

        if(!($this->input->cookie('uid'))){
            //for new users:

            $cid = $this->input->post('cid');
            $this->load->model('user');
            $ip = $_SERVER['REMOTE_ADDR'];
            $uhash = hash('md5', rand(10000,99999));
            $created = date("Y-m-d H:i:s");
                //set properties array to get new user object and create new user into database
            $properties = array('cid'=>$cid,'ip'=>$ip,'uhash'=>$uhash,'ordered'=>'0','created'=>$created);
            $newUser = $this->user->newUser($properties);
            $this->user->login($newUser);//set cookies and sessions for new user

        }elseif($this->input->post('cid') && isset($_SESSION['uid'])){
            //for existing user wants to change campus:
            $this->load->model('user');
            $uid = $_SESSION['uid'];
            $prop = 'cid';
            $value = $this->input->post('cid');
            $updateUser = $this->user->updateUser($uid,$prop,$value);
            //update user's cid session's value
            $this->user->login($updateUser);
        }else{
            //accidently opened by user
            redirect('userstatuscontroller/checkUserStatus');
            }

        redirect('marketcontroller/showDailyMenu');
    }

    /*
     * load vip log in page
     */
    public function showVipLogin(){
        $this->load->view('viplogin');
    }
    /*
     * vip user first log in
     */
    public function vipLogin(){
        if(!empty($_POST['phoneNumber'])){
            $phoneNumber = $this->input->post('phoneNumber');//get input phone number
            $this->load->model('user');
            $vipUser = $this->user->vipUser($phoneNumber); //use phone number to find if related vip exists
            if($vipUser){
                $this->user->login($vipUser);
                return redirect('marketcontroller/showDailyMenu');
            }
            echo "Not vailid vip user";
            return false;
        }
        echo "Please input phone number";
    }

    /*
     * change vip pay password
     */
    public function showChangePassword(){
        // forbid non-vip user to check this method using url directly
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
        $this->load->view('changePassword');
    }
    /*
     * using input phone number, old password and new password
     * to change vip user's old password
     */
    public function changePassword(){
        // forbid non-vip user to check this method using url directly
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }

        if(empty($_POST['phoneNumber'])||empty($_POST['oldPassword'])||empty($_POST['newPassword'])){ // user leaved blank
            echo "Please fulfill all blanks!";
            return false;
        }
        //get posted data
        $phoneNumber = $this->input->post('phoneNumber');
        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');

        $this->load->model('user');
        $vipUser = $this->user->oldUser($_SESSION['uid']);

        // user entered phone number that is not related to his own account
        $error_msg['uphone'] = null;
        $error_msg['oldpassword'] = null;
        $error_msg['newpassword'] = null;
        if($phoneNumber!=$vipUser->uphone){
            // alert that user entered wrong phone number
            $error_msg['uphone'] = "手机号无效，请输入您账户关联的手机号";
            $this->load->view('changePassword',$error_msg);
            return true;
        }
        // user entered his account related phone number
        $this->load->model('market');
        // user entered wrong old password
        if(!$this->market->validatePassword($vipUser->vipid,$oldPassword)){
            $error_msg['oldpassword'] = "请输入正确的现有密码";
            $this->load->view('changePassword',$error_msg);
            return true;
        }
        // old password is right and
        // entered new password is same as the old one
        if($newPassword==$oldPassword){
            //if there is old error session, unset it
            if(isset($_SESSION['error_msg_phone'])){
                unset($_SESSION['error_msg_phone']);
            }
            //if there is old error session, unset it
            if(isset($_SESSION['error_msg_oldpassword'])){
                unset($_SESSION['error_msg_oldpassword']);
            }
            $error_msg['newpassword'] = "请不要输入现有密码";
            $this->load->view('changePassword',$error_msg);
            return true;
        }
        $this->market->updatePassword($vipUser->vipid,$newPassword);
        // show password changed successful page
        $this->load->view('finishedPasswordChange');
        return true;
    }
}
