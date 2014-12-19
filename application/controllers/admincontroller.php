<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/16/2014
 * Time: 9:44 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admincontroller extends MY_Controller{

    public function index() {
        return redirect('admin/showAdminLogin');
    }
    // admin login page
    public function showAdminLogin($errorCode = null){
        $eMsg = array(
            'nouname' => "管理员用户名不能为空！",
            'nopsw' => "管理员密码不能为空!",
            'wrongadmin'=>"该管理员不存在！",
            'wrongpsw'=>"管理员密码不正确！"
        );
        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = $eMsg["$errorCode"];
            $this->load->view('adminlogin',$data);
        }else{
            $this->load->view('adminlogin');
        }
    }

    // admin login check
    public function adminLogin(){
        if(empty($_POST['username'])){// admin didn't enter user name
            return redirect('admincontroller/showAdminLogin/nouname');
        }
        if(empty($_POST['password'])){//admin didn't enter password
            return redirect('admincontroller/showAdminLogin/nopsw');
        }
        // get posted user name and password to check if it is valid
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $this->load->model('admin');// check if admin user exists
        if(!$this->admin->validateAdmin($username)){
            return redirect('admincontroller/showAdminLogin/wrongadmin');
        }
        if(!$this->admin->validatePassword($username,$password)){// check if entered password is right
            return redirect('admincontroller/showAdminLogin/wrongpsw');
        }

        $this->load->view('dashboard');

    }

    /*
     * show user's all orders
     */
    public function showAllOrder(){

        $this->load->model('order');
        $data['orders'] = $this->order->allOrders();
        $this->load->view('allorders',$data);
    }

    public function showOrderDetail($orderId=null){
        $this->load->model('order');
        if(!empty($orderId)){
            $data['orderFood'] = $this->order->orderFoodDetail($orderId);
            $data['orderSidedish'] = $this->order->orderSidedishDetail($orderId);
//            var_dump($data['orderFood']);
//            var_dump($data['orderSidedish']);
//            die();
            $this->load->view('orderdetail',$data);
        }
        return false;

    }
}