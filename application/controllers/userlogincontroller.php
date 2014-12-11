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
        if(!($this->input->cookie('uid'))){
            $cid = $this->input->post('cid');

            $this->load->model('user');
            $ip = $_SERVER['REMOTE_ADDR'];
            $uhash = hash('sha256',rand(10000,99999));
            //set properties array to get new user object and create new user into database
            $properties = array('cid'=>$cid,'ip'=>$ip,'uhash'=>$uhash,'ordered'=>'0');
            $newUser = $this->user->newUser($properties);
            $this->user->login($newUser);//set cookies and sessions for new user
        }
        elseif(isset($_POST['cid'])&&isset($_SESSION['uid'])){
            //for existing user to change campus
            $this->load->model('user');
            $name = 'cid';
            $value = $this->input->post('cid');
            $updateUser = $this->user->updateUser($_SESSION['uid'],$name,$value);
            //update user's cid session's value
            $this->user->login($updateUser);
        }
        else{
            //accident loged in user
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
        $this->load->view('changePassword');
    }
    /*
     * using input phone number, old password and new password
     * to change vip user's old password
     */
    public function changePassword(){
        if(!empty($_POST['phoneNumber'])&&!empty($_POST['oldPassword'])&&!empty($_POST['newPassword'])){
            //get posted data
            $phoneNumber = $this->input->post('phoneNumber');
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $this->load->model('user');
            $vipUser = $this->user->oldUser($_SESSION['uid']);
            if($phoneNumber==$vipUser->uphone){ // user entered his account related phone number
                $this->load->model('market');
                $vipCard = $this->market->getVipCard($vipUser->vipid);

                // user entered right old password
                if($oldPassword==$vipCard->vpassword){
                    // entered new password is not same with the old one
                    if($newPassword!=$vipCard->vpassword){
                        $this->market->updatePassword($vipUser->vipid,$newPassword);
                        return redirect('marketcontroller/showSideDish');
                    }
                    echo "Please do not enter same password";
                    return false;
                }
                echo "Wrong Password";
                return false;
            }
            echo "Not your Phone Number!";
            return false;
        }
        echo "Please fulfill all blanks!";
        return false;
    }
}
