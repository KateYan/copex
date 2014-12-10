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

        // create session to store all three dishes' information
        $_SESSION['food1-name'] = $data['recomdItem']->fname;
        $_SESSION['food1-price'] = $data['recomdItem']->fprice;
        $_SESSION['food2-name'] = $data['saleItem'][0]->fname;
        $_SESSION['food2-price'] = $data['saleItem'][0]->fprice;
        $_SESSION['food3-name'] = $data['saleItem'][1]->fname;
        $_SESSION['food3-price'] = $data['saleItem'][1]->fprice;
//
//        var_dump($_SESSION['food1-price']);


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
        // 1.given a start value of total cost
        $totalcost = 0;
        // 2.given food-id-list as an array to be updated later
        // $foodList will be stored as session for generating order later
        $foodList = array();
        // 3.given ordered food information array to be updated later
        // $data['orderedFood'] is used to show ordered food information in sidedish page's lower list
        $data['orderedFood'] = array();

        // if user chosed first menuitem, get the posted id and amount
        if(true){ //if(isset($_POST['fid1']))
            $fid1 = '10003';//$this->input->post('fid1');
            $amount1 = '2';//$this->input->post('amount1');

            //get costs of the food that user just chose from vip-menu
            $cost1 = $_SESSION['food1-price'] * $amount1;

            // store user ordered food's name,qty and total cost as an array
            $food1 = array('name'=>$_SESSION['food1-name'],'qty'=>$amount1,'cost'=>$cost1);

            //update totalcost
            $totalcost+=$cost1;
            //update foodList
            for($i = 0;$i<$amount1;$i++){
                $foodList[] = $fid1;
            }
            //update food information array
            $data['orderedFood'][] = $food1;
        }

        // if user chosed second menuitem, get the posted id and amount
        if(true){
            $fid2 = '10001'; //$this->input->post('fid2');
            $amount2 = '1'; //$this->input->post('amount2');

            //get costs of the food that user just chose from vip-menu
            $cost2 = $_SESSION['food2-price']  * $amount2;

            // store user ordered food's name,qty and total cost as an array
            $food2 = array('name'=>$_SESSION['food2-name'],'qty'=>$amount2,'cost'=>$cost2);

            //update totalcost
            $totalcost+=$cost2;
            //update foodList
            for($i = 0;$i<$amount2;$i++){
                $foodList[] = $fid2;
            }
            //update food information array
            $data['orderedFood'][] = $food2;
        }

        // if user chosed third menuitem, get the posted id and amount
        if(isset($_POST['fid3'])){
            $fid3 = $this->input->post('fid3');
            $amount3 = $this->input->post('amount3');

            //get costs of the food that user just chose from vip-menu
            $cost3 = $_SESSION['food3-price']  * $amount3;

            // store user ordered food's name,qty and total cost as an array
            $food3 = array('name'=>$_SESSION['food3-name'],'qty'=>$amount3,'cost'=>$cost3);

            //update totalcost
            $totalcost+=$cost3;
            //update foodList
            for($i = 0;$i<$amount3;$i++){
                $foodList[] = $fid3;
            }
            //update food information array
            $data['orderedFood'][] = $food3;
        }

        // array $foodList is stored as session for generating vip-order later
        $_SESSION['foodList'] = $foodList;



        // initiate ordered sidedish id-list array and information array
        $sideDishList = array();
        // $data['orderedSidedish'] will be used to show ordered sidedishes' information in sidedish page's lower list area
        $data['orderedSidedish'] = array();

        // if user also chosed some side dishes, get the information of them
        if(true){// for first side dish
            $sid1 ='50001'; //$this->input->post('sid1');

            // store user ordered sidedish's name,qty and cost as an array
            $sidedish1 = array('name'=>$_SESSION['sidedish1-name'],'qty'=>'1','cost'=>$_SESSION['sidedish1-price']);

            // update ordered sidedish's id list for generating order later
            $sideDishList[] = $sid1;
            // update ordered sidedish's information array
            $data['orderedSidedish'][] = $sidedish1;
            //update totalcost
            $totalcost+=$_SESSION['sidedish1-price'];
        }

        if(isset($_POST['sid2'])){// for second side dish
            $sid2 = $this->input->post('sid2');

            // store user ordered sidedish's name,qty and cost as an array
            $sidedish2 = array('name'=>$_SESSION['sidedish2']->sname,'qty'=>'1','cost'=>$_SESSION['sidedish2']->sprice);

            // update ordered sidedish's id list for generating order later
            $sideDishList[] = $sid2;
            // update ordered sidedish's information array
            $data['orderedSidedish'][] = $sidedish2;
            //update totalcost
            $totalcost+=$_SESSION['sidedish2']->sprice;
        }

        if(isset($_POST['sid3'])){// for third side dish
            $sid3 = $this->input->post('sid3');

            // store user ordered sidedish's name,qty and cost as an array
            $sidedish3 = array('name'=>$_SESSION['sidedish3']->sname,'qty'=>'1','cost'=>$_SESSION['sidedish3']->sprice);

            // update ordered sidedish's id list for generating order later
            $sideDishList[] = $sid3;
            // update ordered sidedish's information array
            $data['orderedSidedish'][] = $sidedish3;
            //update totalcost
            $totalcost+=$_SESSION['sidedish3']->sprice;
        }

        if(isset($_POST['sid4'])){// for third side dish
            $sid4 = $this->input->post('sid4');

            // store user ordered sidedish's name,qty and cost as an array
            $sidedish4 = array('name'=>$_SESSION['sidedish4']->sname,'qty'=>'1','cost'=>$_SESSION['sidedish4']->sprice);

            // update ordered sidedish's id list for generating order later
            $sideDishList[] = $sid4;
            // update ordered sidedish's information array
            $data['orderedSidedish'][] = $sidedish4;
            //update totalcost
            $totalcost+=$_SESSION['sidedish4']->sprice;
        }

        // array $sideDishList is stored as session for generating vip-order later
        $_SESSION['sideDishList'] = $sideDishList;
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
//        var_dump($_SESSION['sidedish1-price']);
    }

    /*
     * generate order for non-vip user
     */
    public function orderGenerate(){
        $uid = $_SESSION['uid'];
        $odate = date('Y-m-d');

        //for non-vip user generating order
        //load model "order"
        $this->load->model('order');

        $orderItemId = $this->input->post('fid');
        $order = $this->order->userOrder($uid,$_SESSION['cid'],$odate,$orderItemId);

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
        //for vip user generating order
        //1. check if the password is match or not by user method validatePassword()
        if(validatePassword($_SESSION['vipid'],$this->input->post('password'))){
            // check if the balance is enouth to pay for all the dishes just ordered
            if($_SESSION['balance']>=$_SESSION['totalcost']){ //user will use vipcard to pay for the order
                // create new vip order for user
                $this->load->model('order');
                $ispaid = 1;
                $order = $this->order->vipOrder($uid,$_SESSION['cid'],$odate,$_SESSION['food'],$_SESSION['sidedish'],$_SESSION['totalcost'],$ispaid);
            }
            echo "not enough balance!!!";//balance is not enough to pay
            return false;
        } else{
            echo "error!!!!!!";//entered not matched password
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
        $pickupRule = $this->rules->getPickupTime('pickupTime',$data['date']);
        $data['timestart'] = $pickupRule->timestart;
        $data['timeend'] = $pickupRule->timeend;

        $this->load->view('ordersuccess',$data);

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
