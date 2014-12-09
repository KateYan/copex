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
        $data['recomdItem'] = $this->menuitem->recomdItem($_SESSION['cid'],$data['date']);
        $data['saleItem'] = $this->menuitem->saleItem($_SESSION['cid'],$data['date']);

        //show campus name for user to switch favor-campus
        $this->load->model('market');
        $campus = $this->market->getCampusById($_SESSION['cid']);
        $data['cname'] = $campus->cname;

        $this->load->view('partials/header',$data);
        //if user is vip->he has vipid session then load vipmenu
        if(isset($_SESSION['vipid'])){
            $this->load->view('vipmenu',$data);
            return false;
        }
        $this->load->view('menu',$data);
    }

    /*
     * show sidedish option for vipuser
     */
    public function showSideDish(){

        //forbid non-vip user to see sidedish page
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
        // given a start value of total cost
        $totalcost = 0;
        // get dishes information that posted from vipmenu
        // if user chosed first menuitem, get the posted id and amount
        if(true){ //if(isset($_POST['fid1']))
            $fid1 = '10001';//$this->input->post('fid1');
            $amount1 = '1';//$this->input->post('amount1');
            // creat an arry to store amount of the food's fid
            $food1 = array();
            for($i = 0;$i<$amount1;$i++){
                $food1[$i] = $fid1;
            }

            //get names and costs of the food that user just chose from vip-menu
            $this->load->model('market');
            $Item1 = $this->market->getFoodById($fid1);
            $cost1 = $Item1->fprice * $amount1;
            $totalcost+=$cost1;//update totalcost

            // store user ordered food's name,qty and total cost as an array
            $order1 = array('name'=>$Item1->fname,'qty'=>$amount1,'cost'=>$cost1);

        }else{ //if user didn't order this food, set the id array as empty array
            $food1= array();
            $order1 = array();
        }

        // if user chosed second menuitem, get the posted id and amount
        if(true){
            $fid2 = '10004'; //$this->input->post('fid2');
            $amount2 = '3'; //$this->input->post('amount2');
            // creat an arry to store amount of the food's fid
            $food2 = array();
            for($i = 0;$i<$amount2;$i++){
                $food2[$i] = $fid2;
            }

            //get names and costs of the food that user just chose from vip-menu
            $this->load->model('market');
            $Item2 = $this->market->getFoodById($fid2);
            $cost2 = $Item2->fprice * $amount2;
            $totalcost+=$cost2;//update totalcost

            // store user ordered food's name,qty and total cost as an array
            $order2 = array('name'=>$Item2->fname,'qty'=>$amount2,'cost'=>$cost2);

        }else{ //if user didn't order this food, set the id array as empty array
            $food2 = array();
            $order2 = array();
        }

        // if user chosed third menuitem, get the posted id and amount
        if(false){
            $fid3 = $this->input->post('fid3');
            $amount3 = $this->input->post('amount3');
            // creat an arry to store amount of the food's fid
            $food3 = array();
            for($i = 0;$i<$amount3;$i++){
                $food3[$i] = $fid3;
            }

            //get names and costs of the food that user just chose from vip-menu
            $this->load->model('market');
            $Item3 = $this->market->getFoodById($fid3);
            $cost3 = $Item3->fprice * $amount3;
            $totalcost+=$cost3;//update totalcost

            // store user ordered food's name,qty and total cost as an array
            $order3 = array('name'=>$Item3->fname,'qty'=>$amount3,'cost'=>$cost3);

        }else{ //if user didn't order this food, set the id array as empty array
            $food3= array();
            $order3 = array();
        }

        // get all above information array into food array
        // session food array is used for later generating vip-order
        $_SESSION['food'] = array_merge($food1,$food2,$food3);

        // for sidedish page to show food user just ordered
        $data['orderedFood'] = array('order1'=>$order1,'order2'=>$order2,'order3'=>$order3);

        // if user also chosed some side dishes, get the information of them
        if(isset($_POST['sid1'])){// for first side dish
            $sid1 = $this->input->post('sid1');
            $this->load->model('market');
            $sdish1 = $this->market->getSidedishById($sid1);
            $sideorder1 = array('name'=>$sdish1->sname,'qty'=>'1','cost'=>$sdish1->sprice);
            $totalcost+=$sdish1->sprice;//update totalcost
        }else{//if user didn't order this sidedish, set the id  and information array as empty
            $sid1 = '';
            $sideorder1 = array();
        }

        if(isset($_POST['sid2'])){// for second side dish
            $sid2 = $this->input->post('sid2');
            $this->load->model('market');
            $sdish1 = $this->market->getSidedishById($sid2);
            $sideorder2 = array('name'=>$sdish2->sname,'qty'=>'1','cost'=>$sdish2->sprice);
            $totalcost+=$sdish2->sprice;//update totalcost
        }else{//if user didn't order this sidedish, set the id  and information array as empty
            $sid2 = '';
            $sideorder2 = array();
        }

        if(true){// for third side dish
            $sid3 = '50003';//$this->input->post('sid3');
            $this->load->model('market');
            $sdish3 = $this->market->getSidedishById($sid3);
            $sideorder3 = array('name'=>$sdish3->sname,'qty'=>'1','cost'=>$sdish3->sprice);
            $totalcost+=$sdish3->sprice;//update totalcost
        }else{//if user didn't order this sidedish, set the id  and information array as empty
            $sid3 = '';
            $sideorder3 = array();
        }

        if(isset($_POST['sid4'])){ // for fourth side dish
            $sid4 = $this->input->post('sid4');
            $this->load->model('market');
            $sdish4 = $this->market->getSidedishById($sid4);
            $sideorder4 = array('name'=>$sdish4->sname,'qty'=>'1','cost'=>$sdish4->sprice);
            $totalcost+=$sdish4->sprice;//update totalcost
        }else{//if user didn't order this sidedish, set the id  and information array as empty
            $sid4 = '';
            $sideorder4 = array();
        }

        //get session of ordered sidedishes's id as an array
        $_SESSION['sidedish'] = array_filter(array($sid1,$sid2,$sid3,$sid4));
        $data['orderedSidedish'] = array('sideorder1'=>$sideorder1,'sideorder2'=>$sideorder2,'sideorder3'=>$sideorder3,'sideorder4'=>$sideorder4);

        // get the total cost of all the dishes user just ordered
        $data['totalcost'] = $totalcost;

        // using user's vipid to get vip user's vip card's balance to show
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($_SESSION['vipid']);
        $data['balance'] = $vipCard->vbalance;

        // get needed session ready for generating order
        // 1. total cost
        // 2. vipcard's balance
        // 3. food and sidedishes's id list -> set bebore already
        // 4. vipcard's password
        $_SESSION['totalcost'] = $totalcost;
        $_SESSION['balance'] = $vipCard->vbalance;
        $_SESSION['password'] = $vipCard->vpassword;

        $this->load->model('market');
        $data['sideDish'] = $this->market->getSideDish($_SESSION['cid']);
        $data['title'] = '精选小食';
        $this->load->view('partials/header',$data);
        $this->load->view('sidedish',$data);
    }

    /*
     * generate order for non-vip user
     */
    public function orderGenerate(){
        $uid = $_SESSION['uid'];
        $odate = date('Y-m-d');

        //for non-vip user generating order
        if(!isset($_SESSION['vipid'])){
            //load model "order"
            $this->load->model('order');

            $orderItemId = $this->input->post('fid');
            $order = $this->order->userOrder($uid,$_SESSION['cid'],$odate,$orderItemId);
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
        $pickupRule = $this->rules->getPickupTime('pickupTime',$data['date']);
        $data['timestart'] = $pickupRule->timestart;
        $data['timeend'] = $pickupRule->timeend;

        $this->load->view('ordersuccess',$data);

    }


    /*
     * generate order for vipuser
     */
    public function vipOrderGenerate(){
        $uid = $_SESSION['uid'];
        $odate = date('Y-m-d');

        //load model "order"
        $this->load->model('order');
        if(isset($_SESSION['vipid'])){
            //for vip user generating order
            //1. check if the password is match or not by user method validatePassword()
            if(validatePassword($_SESSION['vipid'],$this->input->post('password'))){
                // check if the balance is enouth to pay for all the dishes just ordered
                if($_SESSION['balance']>=$_SESSION['totalcost']){
                    // create new vip order for user
                    $this->load->model('order');
                    $order = $this->order->vipOrder($uid,$_SESSION['cid'],$odate,$_SESSION['food'],$_SESSION['sidedish'],$_SESSION['totalcost']);
                }
                echo "not enough balance!!!";//balance is not enough to pay
                return false;
            }
            echo "error!!!!!!";//entered not match password
            return false;
        }
    }

    // using user's vipid to find his vipcard's password,
    // if the input password is not equal to the one get from database, return false
    // if they are same to each other then return true
    private function validatePassword($vipid,$password){
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($vipid);
        if($password==$vipCard->vpassword){
            return true;
        }
        return false;
    }
}
