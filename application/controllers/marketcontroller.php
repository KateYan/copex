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
        
        $this->form_validation->set_rules('uphone','Phone','trim|required|integer|numeric|exact_length[10]');
//        $this->form_validation->set_rules('pickupplace','Place','trim|required');
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
//            'nopickupplace' => "请输入取餐地点", // non-vip
            'timelimit' => "超过订餐时间！",
            'outofinventory' => "您选的菜今天已经被全部预定了~",
//            'noDrink' => "您选择的饮料今天已经卖光了哦~",
            'noenoughfood0' => "菜单上的第一个菜已经被预定光了！",
            'noenoughfood1' => "菜单上的第二个菜已经被预定光了！",
            'noenoughfood2' => "菜单上的第三个菜已经被预定光了！",
            'nosidedish0' => "第一个小食被预定光了！",
            'nosidedish1' => "第二个小食被预定光了！",
            'nosidedish2' => "第三个小食被预定光了！",
            'nosidedish3' => "第四个小食被预定光了！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
//            $data["eMsg"] = $eMsg["$errorCode"];
        }

        // header date change time setting
        $time = date('H:i:s');
        if($time>='00:00:00'&&$time<'13:00:00'){
            $data['date'] = date('m月d日');
            $day = date('Y-m-d');
        }else{
            $data['date'] = date('m月d日',strtotime('+1 day'));
            $day = date('Y-m-d',strtotime('+1 day'));
        }

        $data['weekDay'] = $this->weekDay($day);
        $data['title'] = '午餐菜单';
        $data['uphone'] = $_SESSION['uphone'];

        //using cid and date to find menuitems
        $this->load->model('menuitem');
        $data['recomdItem'] = $this->menuitem->recomdItem($_SESSION['cid']);
        $data['saleItem'] = $this->menuitem->saleItem($_SESSION['cid']);

        // get drink side dish
        $data['drinks'] = $this->menuitem->drinks($_SESSION['cid']);

        // create session to store all three food's information
        $this->menuitem->storeFoodInSession($data['recomdItem'],$data['saleItem']);

        //show campus name for user to switch favor-campus
        $this->load->model('market');
        $campus = $this->market->getCampusById($_SESSION['cid']);
        $data['cname'] = $campus->cname;
        $data['caddr'] = $campus->caddr;

        // using the cid to get all the pickup places of this campus
        $data['places'] = $this->market->getPickupPlacesByCampus($_SESSION['cid']);

        // get user type for getting different order time range
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
        }else{
            $userType = 'user';
        }

        // get orderTimeRange
        $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);
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
            'nopw' => "支付密码不能为空哦",
            'wrongpw'=> "您输入的密码不正确",
            'timelimit' => "超时了！",
            'nopickupplace' => "您还没有选择取餐地点"
        );
        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        // show inventory error message
        if(isset($_GET['nofood'])){
            $this->load->model('market');
            $nofood = $this->market->getFoodById($_GET['nofood']);
            $data['nofood'] = $nofood->fname;
        }
        if(isset($_GET['nosidedish'])){

            $this->load->model('market');
            $nosidedish = $this->market->getSidedishById($_GET['nosidedish']);
            $data['nosidedish'] = $nosidedish->sname;
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

        for ($i = 1; $i <= 6; $i++) {
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

        $userType = 'user';
        // get orderTimeRange
        $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);
        $data['orderStart'] = $orderTimeRange['orderStart'];
        $data['orderEnd'] = $orderTimeRange['orderEnd'];

        // using the cid to get all the pickup places of this campus
        $this->load->model('market');
        $data['places'] = $this->market->getPickupPlacesByCampus($_SESSION['cid']);


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
        if(!$this->checkTime($_SESSION['cid'])){
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
            $orderItemId = array('food' => $this->input->post('fid'));
            if(isset($_POST['drink'])){
                $orderItemId['drink'] = $this->input->post('drink');
            }

            // check inventory
            $this->load->model('order');
            $amount = 1;
            // check food's inventory
            if(!$this->order->checkFoodInventory($_SESSION['cid'],$orderItemId['food'],$amount)){
                return redirect('marketcontroller/showDailyMenu/outofinventory');
            }
            // check drink's inventory
            if(!empty($_POST['drink'])){
                if(!$this->order->checkSidedishInventory($_SESSION['cid'],$orderItemId['drink'],$amount)){
                    return redirect('marketcontroller/showDailyMenu/noDrink');
                }
            }

            // generate fordate
            // find order start time
            $userType = 'user';
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);

            $uid = $_SESSION['uid'];
            $odate = date('Y-m-d H:i:s');
            if($orderTimeRange['orderStart']<$orderTimeRange['orderEnd']){
                $fordate = date('Y-m-d',strtotime('+1 day'));
            }else{
                $fordate = date('Y-m-d');
            }


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
        if (!$this->checkTime($_SESSION['cid'])) {
            // out of order time range, show time alert
            return redirect('marketcontroller/showSideDish/timelimit');
        }

        unset($_SESSION['POST']);
        $_SESSION['POST'] = $_POST;


        // use campus' id to check if it has pickup place
        // 1. if it does have, check if there is posted pickup place
        $this->load->model('market');
        $places = $this->market->getPickupPlacesByCampus($_SESSION['cid']);
        if(!empty($places)){ // the campus does have pickup place
            if (!isset($_POST['pickupplace'])) { // vip user didn't choose pickup place
                return redirect('marketcontroller/showSideDish/nopickupplace');
            }

            $pickupPlace = $this->input->post('pickupplace');

        }else{
            $pickupPlace = NULL;
        }

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
        $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);
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
        $foodItem = array();// used for inventory checking
        for($i = 1; $i <= 3; $i++){
            if(isset($_POST["amt$i"])){
                //update totalcost
                $totalCost_beforTax += $_SESSION["food$i"]['price']*$_POST["amt$i"];
                //update foodList
                for($j=1;$j<=$_POST["amt$i"];$j++){
                    $foodList[] = $_SESSION["food$i"]['id'];
                }
                // create array for inventory check
                $foodId = $_SESSION["food$i"]['id'];
                $foodAmount = $_POST["amt$i"];
                $foodItem[] = array('id'=>$foodId,'amount'=>$foodAmount,'price'=>$_SESSION["food$i"]['price']);
            }
        }

        // for posted side dish
        $sideDishList = array();
        $sideDishItem = array();
        for($k = 1;$k <= 6; $k++){
            if(isset($_POST["sd$k"])){
                // update sidedishlist
                $sideDishList[] = $_SESSION["sidedish$k"]['id'];

                //update total cost
                $totalCost_beforTax += $_SESSION["sidedish$k"]['price'];
                // create array for inventory check
                $sideDishId = $_SESSION["sidedish$k"]['id'];
                $sideDishAmount = 1;
                $sideDishItem[] = array('id'=>$sideDishId,'amount'=>$sideDishAmount,'price'=>$_SESSION["sidedish$k"]['price']);
            }
        }

        //check inventory both food and sidedish
        $this->load->model('order');
        // first check food inventory
        $num_food = count($foodItem);
        for($i = 0; $i < $num_food; $i++){
            if(!$this->order->checkFoodInventory($_SESSION['cid'],$foodItem[$i]['id'],$foodItem[$i]['amount'])){
                $nofood = $foodItem[$i]['id'];
                return redirect("marketcontroller/showSideDish?nofood=$nofood");
            }
        }
        // then check sidedish inventory
        $num_sidedish = count($sideDishItem);
        for($i = 0; $i < $num_sidedish; $i++){
            if(!$this->order->checkSidedishInventory($_SESSION['cid'],$sideDishItem[$i]['id'],$sideDishItem[$i]['amount'])){
                $nosidedish = $sideDishItem[$i]['id'];
                return redirect("marketcontroller/showSideDish?nosidedish=$nosidedish");
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
            $orderId = $this->order->vipOrderByCash($uid,$_SESSION['vipid'],$_SESSION['cid'],$pickupPlace,$odate,$fordate,$foodList,$sideDishList,$totalCost_beforTax);
        }else{
            // generate order
            $this->load->model('order');
            $orderId = $this->order->vipOrderByCard($uid,$_SESSION['vipid'],$_SESSION['cid'],$pickupPlace,$odate,$fordate,$foodItem,$sideDishItem,$totalCost_beforTax);
        }

        // store order's id
        if($orderId){ // create order successfully
            $_SESSION['orderId'] = $orderId;

            // update history
            $this->load->model('user');
            $minusBalance = 0 - round($totalCost_beforTax*1.13,2);
            $newBalance = $balance - round($totalCost_beforTax*1.13,2);
            $this->user->vipHistoryRecord($uid,$balance,$minusBalance,$newBalance);
            // show order
            return redirect('marketcontroller/succeedOrdered');
        }else{
            return redirect('marketcontroller/showSideDish');
        }
    }


    /*
     * time check for user order dishes
     */
    public function checkTime($cid){
        $time = date('H:i:s'); //get timestamp for check if still in order time-range
        // get user type
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
            // get order time range
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType,$cid);
        }else{
            $userType = 'user';
            // get order time range
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType,$cid);
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
        $campus = $this->market->getCampusById($_SESSION['cid']);

        // find out pickup place and pickup time range by using $_SESSION['orderId']
        $this->load->model('order');
        $data['order'] = $this->order->getOrderDetailById($_SESSION['orderId']);

        // get user type for getting different order time range
        // and show different pickup date based on order time;

        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
            $this->load->model('market');
            $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);
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

        if(empty($data['order']['order']->placeAddr)){
            // get user's pickup time range based on user's type
            $pickupTimeRange = $this->market->getPickupTime($userType,$_SESSION['cid']);
            $data['timestart'] = $pickupTimeRange['pickupStart'];
            $data['timeend'] = $pickupTimeRange['pickupEnd'];
        }else{
            $this->load->model('market');
            $pickupPlace = $this->market->getPickupTimeRangeByPlace($data['order']['order']->placeID);
            $data['timestart'] = $pickupPlace->userPickupStart;
            $data['timeend'] = $pickupPlace->userPickupEnd;
        }

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
        $orderTimeRange = $this->market->orderTimeRange($userType,$_SESSION['cid']);
        $orderStart = $orderTimeRange['orderStart'];
        // get today's start time
        $start = date("Y-m-d $orderStart");
        $now = date('Y-m-d H:i:s');
        //find if user has ordered today
        $this->load->model('order');
        return $this->order->orderToday($_SESSION['uid'],$now,$start);
    }

    // get weekday
    public function weekDay($date){
        $day = date("w",strtotime($date));
        if($day=="0"){
            $weekDay = " 周日";
        }elseif($day=="1"){
            $weekDay = " 周一";
        }elseif($day=="2"){
            $weekDay = " 周二";
        }elseif($day=="3"){
            $weekDay = " 周三";
        }elseif($day=="4"){
            $weekDay = " 周四";
        }elseif($day=="5"){
            $weekDay = " 周五";
        }elseif($day=="6"){
            $weekDay = " 周六";
        }

        return $weekDay;
    }
}
