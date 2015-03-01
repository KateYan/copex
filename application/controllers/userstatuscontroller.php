<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 4:10 PM
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Userstatuscontroller extends MY_Controller {
	/* wechat enterence to copex
	 * judge cookie to enter different controller-methods
	 */
	public function index() {
        // store update click by plus 1 to the stored click
        $this->load->model('market');
        $this->market->updateClick();
		return redirect('userstatuscontroller/checkUserStatus');
	}

	public function checkUserStatus() {
		if ($this->input->cookie('uid')) {
			$oldUser = $this->validateUser($this->input->cookie('uid'), $this->input->cookie('uhash'));
			if ($oldUser) {
				//legal user
				//request user model's method login() to set cookies and sessions for user
				$this->user->login($oldUser);
				return redirect('marketcontroller/showDailyMenu');
			} else {
				//illegal user
				setcookie('uid', '', time() - 3600,'/');
				delete_cookie('uid');
				return redirect('userlogincontroller/loadCampus');
			}
		}
		return redirect('userstatuscontroller/welcome');
//        return redirect('userlogincontroller/loadCampus');
	}

    /*
     * show welcome page for user who first login
0    */
    public function welcome(){
        $this->load->view('welcome');
    }
	/*
	 * Validate user by checking uid-uhash pair
	 */
	private function validateUser($uid, $uhash) {
		//code for validating user
		$this->load->model('user');
		$oldUser = $this->user->oldUser($uid);
		if ($uhash == $oldUser->uhash) {
			return $oldUser;
		}
		return false;

	}
    /*
     * show user's all orders
     */
    public function showUserOrder(){
        if(!$this->input->cookie('uid')){
            return redirect('userstatuscontroller/checkUserStatus');
        }

        $oldUser = $this->validateUser($this->input->cookie('uid'), $this->input->cookie('uhash'));
        if ($oldUser) {
            //legal user
            //request user model's method login() to set cookies and sessions for user
            $this->user->login($oldUser); // open session for user
        }
        $data['title'] = '我的订单';
        $date = date('Y年m月d日');
        $data['date'] = $date;
        $this->load->view('partials/header',$data);

        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d',strtotime('+1 day'));
        // for non-vip user
        if(!isset($_SESSION['vipid'])){
            $this->load->model('order');
            // if user ordered already
            if($this->order->findUserOrder($_COOKIE['uid'],$today,$tomorrow)){
                $order = $this->order->findUserOrder($_COOKIE['uid'],$today,$tomorrow);
                $data['order'] = $order['order'];
                $data['food'] = $order['food'];

                if(isset($order['drink'])){
                    $data['drink'] = $order['drink'];
                }

            }
            $this->load->view('userOrders',$data);
        }else{ // for vip user
            $this->load->model('order');
            if($this->order->findVipOrder($_COOKIE['uid'],$today,$tomorrow)){
                $data['orders'] = $this->order->findVipOrder($_COOKIE['uid'],$today,$tomorrow);

            }
            $this->load->view('vipOrders',$data);
        }
    }

    // for first log in user to know how abot copex
    public function showInstruction1(){
        $this->load->view('instruction1');
    }

    public function showInstruction2(){
        $this->load->view('instruction2');
    }

    public function showInstruction3(){
        $this->load->view('instruction3');
    }

    public function showWaitting(){
        $this->load->view('waitting');
    }

    public function showMapping(){
        $this->load->view('mapping');
    }

}