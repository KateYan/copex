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
        return redirect('admincontroller/showAdminLogin');
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
            $this->load->view('admin/adminlogin',$data);
        }else{
            $this->load->view('admin/adminlogin');
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

        $_SESSION['username'] = $username;
        return redirect('admincontroller/showAdminPanel');
    }

    // load admin Panel page
    public function showAdminPanel(){
        if(!isset($_SESSION['username'])){// fobid non-loged user to see admin panel
            return redirect('admincontroller/showAdminLogin');
        }
        // get click rate
        $this->load->model('market');
        $data['clickTimes'] = $this->market->getClick();
        $data['title'] = "Copex | 控制面板";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/adminPanel');
        $this->load->view('partials/adminFooter');
    }
    //show campus choose for view orders
    public function showOrderPanel(){
        // campus list data
        $this->load->model('market');
        $data['campusList'] = $this->market->getCampusList();

        $data['title'] = "Copex | 订单管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/orderPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    //show orders on the way and history orders
    public function showOrders(){

        // campus list data
        $this->load->model('market');
        if(isset($_POST['campus'])){
            $campusId = $this->input->post('campus');
        }elseif(isset($_SESSION['order_campus'])){
            $campusId = $_SESSION['order_campus']['cid'];
        }
        // get campus name
        $campus = $this->market->getCampusById($campusId);
        $_SESSION['order_campus'] = array('cid'=>$campus->cid,'cname'=>$campus->cname);

        $data['title'] = "Copex | 订单管理";

        // get orderTimeRange
        $userType = 'vip';
        $this->load->model('market');
        $orderTimeRange = $this->market->orderTimeRange($userType);
        $orderStart = $orderTimeRange['orderStart'];
        $orderEnd = date("00:00:00");
        $time = date('H:i:s');
        if($time >= $orderEnd && $time< $orderStart){
            $date = date("Y-m-d");
        }else{
            $date = date('Y-m-d',strtotime('+1 day'));
        }

        // show today's order that needed to prepare
        $this->load->model('order');
        if($this->order->getOrdersByCampusDate($campusId,$date)){// check number of orders
            $data['prepareOrder'] = $this->order->getOrdersByCampusDate($campusId,$date);
        }
        // find all orders for admin
        if($this->order->getAllOrdersByCampus($campusId)){
            $data['historyOrder'] = $this->order->getAllOrdersByCampus($campusId);
        }

        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/order_campus',$data);
        $this->load->view('partials/adminFooter');
    }

    // show one order's detail with order's id
    public function showOrderDetail($errorCode = null){

        // check if there is error code
        $eMsg = array(
            'notsafe' => "该订单未付款或未取款，请变更状态后再删除！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $this->load->model('order');
        if(!isset($_GET['orderId'])){
            if(isset($_SESSION['orderDetail'])){
                $orderId = $_SESSION['orderDetail']['order']->oid;
            }
        }else{
            $orderId = $_GET['orderId'];
        }

        $orderDetail = $this->order->getOrderDetailById($orderId);

        //clear session
        if(isset($_SESSION['orderDetail'])){
            unset($_SESSION['orderDetail']);
        }
        $_SESSION['orderDetail'] = $orderDetail;


        $data['title'] = "Copex | 订单详情";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/orderDetail',$data);
        $this->load->view('partials/adminFooter');

    }

    // change order's status into ispaid
    public function confirmPaid(){
        // get total preparedOrder's number
        $orderNumber = $_POST['orderNumber'];
        // store all order's which are needed to be updated as ispaid into an numnered array
        $orderIdList = array();
        for($i=0;$i<$orderNumber;$i++){
            if(isset($_POST["order$i"])){
                $orderIdList[] = $_POST["order$i"];
            }
        }
        $columnName = "oispaid";
        $this->load->model('order');
        $this->order->updateOrder($orderIdList,$columnName);

        return redirect('admincontroller/showOrders');
    }

    // change order's status into ispaid
    public function confirmPickedup(){
//        var_dump($_POST);
//        die();
        // get total preparedOrder's number
        $orderNumber = $_POST['orderNumber'];
        // store all order's which are needed to be updated as ispaid into an numnered array
        $orderIdList = array();
        for($i=0;$i<$orderNumber;$i++){
            if(isset($_POST["order$i"])){
                $orderIdList[] = $_POST["order$i"];
            }
        }
        $columnName = "ostatus";
        $this->load->model('order');
        $this->order->updateOrder($orderIdList,$columnName);

        return redirect('admincontroller/showOrders');
    }
    // log out administer
    public function logOut(){
        unset($_SESSION['vipUser']);
        unset($_SESSION['username']);
        return redirect('admincontroller/showAdminLogin');
    }

    public function goback(){
        if(isset($_SESSION['order_campus'])){
            unset($_SESSION['order_campus']);
        }
        if(isset($_SESSION['orderDetail'])){
            unset($_SESSION['orderDetail']);
        }

        return redirect('admincontroller/showOrderPanel');
    }

    //delete order
    public function deleteOrder(){
        if(!$this->input->post('orderId')){
            return redirect('admincontroller/showOrderDetail');
        }

        $orderId = $this->input->post('orderId');
        // check if order is safe to be deleted
        if($_SESSION['orderDetail']['order']->ostatus == 0 || $_SESSION['orderDetail']['order']->oispaid == 0){
            return redirect('admincontroller/showOrderDetail/notsafe');
        }
        $this->load->model('order');
        $this->order->deleteOrder($orderId);
        unset($_SESSION['orderDetail']);

        return redirect('admincontroller/showOrders');
    }
}