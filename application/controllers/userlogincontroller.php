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
        $data['title']='选择你所在的校区';
        $this->load->model('market');
        $data['result']=$this->market->getCampusList();
        $this->load->view('partials/header',$data);
        $this->load->view('campus',$data);
    }

    /*
     * set cookies and sessions for user
     */
    public function setUser(){
        if(!isset($_COOKIE['uid'])){
            $cid=$this->input->post('cid');
            $this->load->model('user');
            $ip=$_SERVER['REMOTE_ADDR'];
            //set properties array to get new user object and create new user into database
            $properties=array('cid'=>$cid,'ip'=>$ip,'uhash'=>'12345','ordered'=>'0');
            $newUser=$this->user->newUser($properties);

            $this->user->login($newUser);//set cookies and sessions for new user
        } elseif(isset($_POST['cid'])){
            //for existing user to change campus
        } else{
            //accident loged in user
        }
        redirect('marketcontroller/showDailyMenu');
    }
}
