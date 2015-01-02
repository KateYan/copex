<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:28 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{

    /*
     * if some user try to use url/uri to see daily menu directyly,
     * forbid it and redirect to check user's status
     */
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('uphone','Phone','trim|required|greater_than[1000000000]|less_than[100000000000]|numeric|integer');
        if(!isset($_SESSION['uid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
    }
    /* load model "menuitem" and using its method recommend() and saleitem()
     * to find validate menuitem
     * for loading vipusers or non-vip users' menu
     */
    public function showDailyMenu($errorCode = null){
        unset($_SESSION['POST']);
        // error message for user has already ordered at the same day
        $eMsg = array(
            'orderlimit' => "普通用户每天只能下一单哦！", // non-vip
            'nofulfill'=> "您还没有选择菜品或输入手机号哦！", // non-vip
            'nofoodpicked'=>"您还没有点任何一款主食哦！", // vip
            'wrongphone'=>"请输入正确的手机号",// non-vip
            'timelimit' => "超过订餐时间！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
//            $data["eMsg"] = $eMsg["$errorCode"];
        }

        // header date change time setting
        $time = date('H:i:s');
        if($time>='00:00:00'&&$time<'13:00:00'){
            $data['date'] = date('m月d日');
        }else{
            $data['date'] = date('m月d日',strtotime('+1 day'));
        }

        $data['title'] = '午餐菜单';
        $data['uphone'] = $_SESSION['uphone'];

        //using cid and date to find menuitems
        $this->load->model('menuitem');
        $data['recomdItem'] = $this->menuitem->recomdItem($_SESSION['cid']);
        $data['saleItem'] = $this->menuitem->saleItem($_SESSION['cid']);

        // create session to store all three food's information
        $this->menuitem->storeFoodInSession($data['recomdItem'],$data['saleItem']);

        //show campus name for user to switch favor-campus
        $this->load->model('market');
        $campus = $this->market->getCampusById($_SESSION['cid']);
        $data['cname'] = $campus->cname;

        // get user type for getting different order time range
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
        }else{
            $userType = 'user';
        }

        // get orderTimeRange
        $orderTimeRange = $this->market->orderTimeRange($userType);
        $data['orderStart'] = $orderTimeRange['orderStart'];
        $data['orderEnd'] = $orderTimeRange['orderEnd'];

        $this->load->view('partials/header',$data);
        //if user is vip->he has vipid session then load vipmenu
        if(!empty($_SESSION['vipid'])){
            //vip
            $data['menu_items'] = [$data['recomdItem'], $data['saleItem'][0], $data['saleItem'][1]];
            unset($data['recomdItem']);
            unset($data['saleItem']);
            $this->load->view('vipmenu',$data);
        }
        else{
            //normal user
            $this->load->view('normal_menu',$data);
        }
    }

    /*
     * show sidedish option for vipuser
     */
    public function showSideDish($errorCode = null){
        // if there are posted food amount and their value are all equal to zero, then return error
        if(isset($_POST['amt1'])&&isset($_POST['amt2'])&&isset($_POST['amt3'])){
            if($_POST['amt1']==0&&$_POST['amt2']==0&&$_POST['amt3']==0){
                return redirect('marketcontroller/showDailyMenu/nofoodpicked');
            }
        }
        //forbid non-vip user to see sidedish page
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
        // error message setting
        $eMsg = array(
            'nopw' => "密码不能为空",
            'wrongpw'=> "您输入的密码不正确"
        );

        if(!empty($errorCode) && !isset($eMsg["$errorCode"])){
            return redirect('marketcontroller/showDailyMenu');
        }elseif(!empty($errorCode)){
            $data['eMsg'] = $eMsg["$errorCode"];
        }

        $totalCost = 0;
        $data['orderedDishes'] = array();

        $selected = false;


        for ($i = 1; $i <= 3; $i++) {
            $amt = empty($_SESSION['POST']["amt$i"])? $this->input->post("amt$i") : (int)$_SESSION['POST']["amt$i"];
            if($amt > 0 && $amt <= 50){
                $selected = true;
                $fid = $_SESSION["food$i"]['id'];
                $name = $_SESSION["food$i"]['name'];
                $cost = $_SESSION["food$i"]['price'] * $amt;
                $totalCost += $cost;
                $data['orderedDishes'][] = array('inputName'=>"amt$i", 'name'=>$name,'qty'=>$amt,'cost'=>$cost);
                $_SESSION['POST']["amt$i"] = $amt;
            }
        }

        if(!$selected){
            return redirect('marketcontroller/showDailyMenu');
        }

        //get sidedishes:

        for ($i = 1; $i <= 4; $i++) {
            if(!empty($_SESSION['POST']["sd$i"])){
                $data['selectedSd']["$i"] = true;
            }
        }


        $this->load->model('menuitem');
        $data['sideDish'] = $this->menuitem->getSideDish($_SESSION['cid']);

        if (empty($_SESSION["sidedish1"])) {
            // store sidedish's session
            $this->menuitem->storeSidedishInSession($data['sideDish']);
        }

        // get the total cost of all the dishes user just ordered
        $data['totalcost_befortax'] = $totalCost;

        // using user's vipid to get vip user's vip card's balance to show
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($_SESSION['vipid']);
        $data['balance'] = $vipCard->vbalance;


        $data['title'] = '精选小食';
        //get error message
        if(isset($_SESSION['error'])){
            $data['error'] = $_SESSION['error'];
        }

        $this->load->view('partials/header',$data);
        $this->load->view('sidedish',$data);
    }

    /*
     * generate order for non-vip user
     */
    public function orderGenerate(){
        // test if still in order time range
        if(!$this->checkTime()){
            return redirect('marketcontroller/showDailyMenu/timelimit');
        }
        // check if phone number is valid
        if($this->form_validation->run() == FALSE){
            return redirect('marketcontroller/showDailyMenu/wrongphone');
        }
        // check if user has ordered before within the same day
        if(!$this->ifOrderedToday()){
            return redirect('marketcontroller/showDailyMenu/orderlimit');
        }

        // if user didn't enter phonenumber or choose a dish befor making an order
        // order won't be generated
        if(empty($_POST['uphone'])||empty($_POST['fid'])) {

            return redirect('marketcontroller/showDailyMenu/nofulfill');
        }else{
            // get posted user's  phone number
            // no matter used had a phone number before or not
            // this will be used to update user's account's related phone number
            $uphone = $this->input->post('uphone');
            $_SESSION['uphone'] = $uphone;
            $orderItemId = $this->input->post('fid');

            $uid = $_SESSION['uid'];
            $odate = date('Y-m-d H:i:s');
            $fordate = date('Y-m-d',strtotime('+1 day'));

            $this->load->model('order');
            $orderId = $this->order->userOrder($uid,$_SESSION['cid'],$odate,$fordate,$orderItemId,$_SESSION['uphone']);

            $_SESSION['orderId']= $orderId;

            return redirect('marketcontroller/succeedOrdered');
        }
    }


    /*
     * generate order for vipuser
     */
    public function vipOrderGenerate(){
        // if in order time-range then generate vip order
        if(!$this->checkTime()){
            // out of order time range, then load timeout page
            return $this->load->view('timeout');
        }

        unset($_SESSION['POST']);
        $_SESSION['POST'] = $_POST;

        if(empty($_POST['password'])){ //user didn't type in password
            return redirect('marketcontroller/showSideDish/nopw');
        }
        //1. check if the password is match or not by market moder's method validatePassword()
        $this->load->model('market');
        $passwordStatus = $this->market->validatePassword($_SESSION['vipid'],$this->input->post('password'));

        if(!$passwordStatus){// wrong password
            return redirect('marketcontroller/showSideDish/wrongpw');
        }

        // user did enter password
        $uid = $_SESSION['uid'];
        $odate = date('Y-m-d H:i:s');

        // get user type for getting different order time range
        // and show different pickup date based on order time;

        $userType = 'vip';
        $this->load->model('market');
        $orderTimeRange = $this->market->orderTimeRange($userType);
        $time = date('H:i:s');
        if($time>=$orderTimeRange['orderStart']){
            $fordate = date('Y-m-d',strtotime('+1 day'));
        }elseif($time<=$orderTimeRange['orderEnd']){
            $fordate = date('Y-m-d');
        }

        // begin to calculate total cost
        $totalCost_beforTax = 0;
        //for posted food
        $foodList = array();
        for($i = 1; $i <= 3; $i++){
            if(isset($_POST["amt$i"])){
                //update totalcost
                $totalCost_beforTax += $_SESSION["food$i"]['price']*$_POST["amt$i"];
                //update foodList
                for($j=1;$j<=$_POST["amt$i"];$j++){
                    $foodList[] = $_SESSION["food$i"]['id'];
                }
            }
        }

        // for posted side dish
        $sideDishList = array();
        for($k = 1;$k <= 4; $k++){
            if(isset($_POST["sd$k"])){
                // update sidedishlist
                $sideDishList[] = $_SESSION["sidedish$k"]['id'];

                //update total cost
                $totalCost_beforTax += $_SESSION["sidedish$k"]['price'];
            }
        }
        // using user's vipid to get vip user's vip card's balance to show
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($_SESSION['vipid']);
        $balance = $vipCard->vbalance;

        if($balance<round($totalCost_beforTax*1.13,2)){// vipcard is not enough to pay order
            if(!isset($_POST['by_cash'])){
                return redirect('marketcontroller/showSideDish');
            }
            $this->load->model('order');
            $orderId = $this->order->vipOrderByCash($uid,$_SESSION['vipid'],$_SESSION['cid'],$odate,$fordate,$foodList,$sideDishList,$totalCost_beforTax);
        }else{
            // generate order
            $this->load->model('order');
            $orderId = $this->order->vipOrderByCard($uid,$_SESSION['vipid'],$_SESSION['cid'],$odate,$fordate,$foodList,$sideDishList,$totalCost_beforTax);
        }

        // store order's id
        if($orderId){ // create order successfully
            $_SESSION['orderId'] = $orderId;
            // show order
            return redirect('marketcontroller/succeedOrdered');
        }else{
            return redirect('marketcontroller/showSideDish');
        }
    }


    /*
     * time check for user order dishes
     */
    public function checkTime(){
        $time = date('H:i:s'); //get timestamp for check if still in order time-range
        // get user type
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
            // get order time range
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType);
        }else{
            $userType = 'user';
            // get order time range
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType);
        }
        if($orderTimeRange['orderStart']<=$orderTimeRange['orderEnd']){
            $result = $time>=$orderTimeRange['orderStart']&&$time<=$orderTimeRange['orderEnd'];
        }else{
            $result = $time>=$orderTimeRange['orderStart']||$time<=$orderTimeRange['orderEnd'];
        }
        if($result){
            return true;
        } else{
            return false;
        }

    }

    /*
     * order Successfully created page
     */
    public function succeedOrdered(){
        // get campus address using session['cid]
        $this->load->model('market');
        $data['orderNumber'] = $_SESSION['orderId'];
        $campus = $this->market->getCampusById($_SESSION['cid']);
        $data['address'] = $campus->caddr;

        // get user type for getting different order time range
        // and show different pickup date based on order time;
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType);
            $time = date('H:i:s');
            if($time>=$orderTimeRange['orderStart']){
                $data['date'] = date('m月d日',strtotime('+1 day'));
            }elseif($time<=$orderTimeRange['orderEnd']){
                $data['date'] = date('m月d日');
            }
        }
        // for non-vip user,the confirm page will show pickup date
        //as the next day of order's create date
        else{
            $userType = 'user';
            $this->load->model('market');
            $data['date'] = date('m月d日',strtotime('+1 day'));
        }

        // get user's pickup time range based on user's type

        $pickupTimeRange = $this->market->getPickupTime($userType);
        $data['timestart'] = $pickupTimeRange['pickupStart'];
        $data['timeend'] = $pickupTimeRange['pickupEnd'];

        $this->load->view('ordersuccess',$data);
        session_destroy();
    }
    // check if user has already ordered before within the same day
    public function ifOrderedToday(){
        if(isset($_SESSION['vipid'])){
            return false;
        }
        // find order start time
        $userType = 'user';
        $this->load->model('market');
        $orderTimeRange = $this->market->orderTimeRange($userType);
        $orderStart = $orderTimeRange['orderStart'];
        // get today's start time
        $start = date("Y-m-d $orderStart");
        $now = date('Y-m-d H:i:s');
        //find if user has ordered today
        $this->load->model('order');
        return $this->order->orderToday($_SESSION['uid'],$now,$start);
    }
}
