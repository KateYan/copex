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
        if(!isset($_SESSION['uid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
    }
    /* load model "menuitem" and using its method recommend() and saleitem()
     * to find validate menuitem
     * for loading vipusers or non-vip users' menu
     */
    public function showDailyMenu(){
        $this->load->model('menuitem');
        $data['date'] = date('Y-m-d');
        $data['title'] = '午餐菜单';
        $data['uphone'] = $_SESSION['uphone'];

        //using cid and date to find menuitems
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
    public function showSideDish(){

        //forbid non-vip user to see sidedish page
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
        // 1.given a start value of total cost
        $totalCost = 0;
        // 2.given food-id-list as an array to be updated later
        // $foodList will be stored as session for generating order later
        $foodList = array();
        // 3.given ordered food information array to be updated later
        // $data['orderedFood'] is used to show ordered food information in sidedish page's lower list
        $data['orderedDishes'] = array();

        for ($i = 1; $i <= 3; $i++) {
            $amt = $this->input->post("amt$i");
            if($amt > 0 && $amt <= 50){
                $fid = $_SESSION["food$i"]['id'];
                $name = $_SESSION["food$i"]['name'];
                $cost = $_SESSION["food$i"]['price'] * $amt;
                $totalCost += $cost;

                //update foodList
                for($j = 0; $j<$amt; $j++){
                    $foodList[] = [$fid, 0];
                }
                $data['orderedDishes'][] = array('inputName'=>"amt$i", 'name'=>$name,'qty'=>$amt,'cost'=>$cost);
            }
        }

        //For sidedishes:

        $this->load->model('menuitem');
        $data['sideDish'] = $this->menuitem->getSideDish($_SESSION['cid']);

        if (empty($_SESSION["sidedish1"])) {
            // store sidedish's session
            $this->menuitem->storeSidedishInSession($data['sideDish']);
        }


        for ($i = 1; $i <= 4 ; $i++) {
            if($this->input->post("sd$i")){
                $sid = $_SESSION["sidedish$i"]['id'];
                $name = $_SESSION["sidedish$i"]['name'];
                $cost = $_SESSION["sidedish$i"]['price'];
                $foodList[] = [$fid, 1];
                $data['orderedDishes'][] = array('inputName'=>"sd$i", 'name'=>$name,'qty'=> '1' ,'cost'=>$cost);
                $totalCost += $cost;
            }
        }

        // get the total cost of all the dishes user just ordered
        $data['totalcost'] = $totalCost;

        // using user's vipid to get vip user's vip card's balance to show
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($_SESSION['vipid']);
        $data['balance'] = $vipCard->vbalance;

        // get needed session ready for generating order
        // 1. total cost
        // 2. vipcard's balance
        // 3. food and sidedishes's id list -> set bebore already
        // 4. vipcard's password
        $_SESSION['totalcost'] = $totalCost;
        $_SESSION['balance'] = $vipCard->vbalance;
        $_SESSION['foodList'] = $foodList;


        $data['title'] = '精选小食';
        $this->load->view('partials/header',$data);
        $this->load->view('sidedish',$data);
    }

    /*
     * generate order for non-vip user
     */
    public function orderGenerate(){
        // test if still in order time range
        if($this->checkTime()){
            // if user didn't enter phonenumber or choose a dish befor making an order
            // order won't be generated
            if(empty($_POST['uphone'])||empty($_POST['fid'])) {

                return redirect('marketcontroller/showDailyMenu');
            }else{
                // get posted user's  phone number
                // no matter used had a phone number before or not
                // this will be used to update user's account's related phone number
                $uphone = $this->input->post('uphone');
                $orderItemId = $this->input->post('fid');

                $uid = $_SESSION['uid'];
                $odate = date('Y-m-d');

                $this->load->model('order');
                $order = $this->order->userOrder($uid,$_SESSION['cid'],$odate,$orderItemId,$uphone);

                $data['orderNumber'] = $order->oid;
                $data['date'] = $order->odate;

                // get campus address using session['cid]
                $this->load->model('market');
                $campus = $this->market->getCampusById($order->cid);
                $data['address'] = $campus->caddr;

                // get user's pickup time range by getting an rule object
                // from 'rules' class using it's name and date
                $this->load->model('rules');
                $pickupRule = $this->rules->getPickupTime('pickupTime',$data['date']);
                $data['timestart'] = $pickupRule->timestart;
                $data['timeend'] = $pickupRule->timeend;

                $this->load->view('ordersuccess',$data);
                return true;
            }
        }
        return redirect('marketcontroller/showDailyMenu');
    }


    /*
     * generate order for vipuser
     */
    public function vipOrderGenerate(){
        // if in order time-range then generate vip order
        if($this->checkTime()){
            // check if user typed in password or not
            if(!empty($_POST['password'])){  // user did enter password
                $uid = $_SESSION['uid'];
                $odate = date('Y-m-d');
                $this->load->model('order');

                //1. check if the password is match or not by market moder's method validatePassword()
                $this->load->model('market');
                $password = $this->market->validatePassword($_SESSION['vipid'],$this->input->post('password'));
                if($password){
                    // check if the balance is enouth to pay for all the dishes just ordered
                    if($_SESSION['balance']>=$_SESSION['totalcost']){ //user will use vipcard to pay for the order
                        // create new vip order for user
                        $this->load->model('order');
                        $ispaid ='1';
                        $balance = $_SESSION['balance'] - $_SESSION['totalcost'];
                        $order = $this->order->vipOrder($uid,$_SESSION['cid'],$odate,$_SESSION['foodList'],$_SESSION['sideDishList'],$_SESSION['totalcost'],$ispaid,$balance);
                    }else{
                        echo "not enough balance!!!";//balance is not enough to pay
                        return false;
                    }
                } else{
                    echo "password error!";//entered not matched password
                    return false;
                }
                // get order's number and date for showing order page
                $data['orderNumber'] = $order->oid;
                $data['date'] = $order->odate;

                // get campus address using session['cid]
                $this->load->model('market');
                $campus = $this->market->getCampusById($order->cid);
                $data['address'] = $campus->caddr;

                // get user's pickup time range by getting an rule object
                // from 'rules' class using it's name and date
                $this->load->model('rules');
                $pickupRule = $this->rules->getPickupTime('vipPickupTime',$data['date']);
                $data['timestart'] = $pickupRule->timestart;
                $data['timeend'] = $pickupRule->timeend;

                $this->load->view('ordersuccess',$data);
                return true;
            }
            return redirect('marketcontroller/showSideDish');
        }

        // out of order time range, then load timeout page
        $this->load->view('timeout');

    }


    /*
     * time check for user order dishes
     */
    public function checkTime(){
        $time = date('H:i:s'); //get timestamp for check if still in order time-range
        // get user type
        if(!empty($_SESSION['vipid'])){
            $userType = 'vip';
        }else{
            $userType = 'user';
        }
        // get order time range
        $this->load->model('market');
        $orderTimeRange = $this->market->orderTimeRange($userType);

        if($time>=$orderTimeRange['orderStart']&&$time<=$orderTimeRange['orderEnd']){
            return true;
        }
        else{
            return false;
        }

    }

}
