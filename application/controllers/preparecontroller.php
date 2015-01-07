<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/3/2015
 * Time: 6:02 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preparecontroller extends MY_Controller{

    // show panel
    public function showDinerDishPanel(){
        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();
        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dinerDishPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show all dishes this diner need to prepare
    public function showDinerDishes(){
        if(!$this->input->post('diner')){
            return redirect('preparecontroller/showDinerDishPanel');
        }

        // find diner's name
        $this->load->model('diner');
        if(isset($_POST['diner'])){
            $dinerId = $_POST['diner'];
            if(isset($_SESSION['prepare'])){
                unset($_SESSION['prepare']);
            }
            $this->diner->findDiner($this->input->post('diner'));
        }else{
            $dinerId = $_SESSION['diner']['did'];
        }

//        var_dump($_SESSION['diner']);
//        die();

        // find food that need to prepare
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

        $this->load->model('order');
        if($this->order->getOrderItem($dinerId,$date)){
            $prepare_item = $this->order->getOrderItem($dinerId,$date);

//            $_SESSION['prepare_item'] = $prepare_item;

            // compare each food and add them up
            $food = $prepare_item['food'];
            $container1 = array();
            $foodList = array();

            foreach ($food as $item) {
                $key = $item->fid . '_' . $item->fname;
                if (empty($container1[$key])) {
                    $container1[$key] = $item->amount;
                }
                else {
                    $container1[$key] += $item->amount;
                }
            }
            foreach ($container1 as $key => $item) {
                list($fid, $fname) = explode('_', $key);
                $foodList[] = array('fid' => $fid, 'fname' => $fname, 'amount' => $item);
            }


            // compare each sidedish and add them up
            $side = $prepare_item['side'];
            $container2 = array();
            $sideList = array();

            foreach ($side as $item) {
                $key = $item->sid . '_' . $item->sname;
                if (empty($container2[$key])) {
                    $container2[$key] = $item->amount;
                }
                else {
                    $container2[$key] += $item->amount;
                }
            }
            foreach ($container2 as $key => $item) {
                list($sid, $sname) = explode('_', $key);
                $sideList[] = array('sid' => $sid, 'sname' => $sname, 'amount' => $item);
            }

            $_SESSION['prepare']['foodList'] = $foodList;
            $_SESSION['prepare']['sideList'] = $sideList;
        }
//        var_dump($prepare_item);
//        var_dump($_SESSION['prepare']);

//        die();

        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dishes_diner',$data);
        $this->load->view('partials/adminFooter');

    }

    // show choose campus
    public function showChooseCampus(){
        $this->load->model('market');
        $data['campusList'] = $this->market->getCampusList();

        $data['title'] = "Copex | 选择备餐校区";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/distribution_choose_campus',$data);
        $this->load->view('partials/adminFooter');
    }

    // show distrubution list for print
    public function showDistribution(){
//        var_dump($_SESSION['prepare_item']);
//        var_dump($_SESSION['diner']);
//        die();
        if(!isset($_POST['campus'])||!isset($_SESSION['diner'])){
            return redirect('preparecontroller/showDinerDishPanel');
        }

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


        // get campus order item
        $campusId = $_POST['campus'];
        $this->load->model('market');
        $campus = $this->market->getCampusById($campusId);

        $this->load->model('order');
        if ($this->order->getOrderItemByCampus($_SESSION['diner']['did'],$campus->cid, $date)) {
            $prepare_campus_item = $this->order->getOrderItemByCampus($_SESSION['diner']['did'], $campus->cid, $date);

            //create session
            $_SESSION['prepare_campus_item'] = $prepare_campus_item;

            // compare each food and add them up
            $food = $prepare_campus_item['food'];
            $container1 = array();
            $foodList = array();

            foreach ($food as $item) {
                $key = $item->fid . '_' . $item->fname;
                if (empty($container1[$key])) {
                    $container1[$key] = $item->amount;
                }
                else {
                    $container1[$key] += $item->amount;
                }
            }
            foreach ($container1 as $key => $item) {
                list($fid, $fname) = explode('_', $key);
                $foodList[] = array('fid' => $fid, 'fname' => $fname, 'amount' => $item);
            }


            // compare each sidedish and add them up
            $side = $prepare_campus_item['side'];
            $container2 = array();
            $sideList = array();

            foreach ($side as $item) {
                $key = $item->sid . '_' . $item->sname;
                if (empty($container2[$key])) {
                    $container2[$key] = $item->amount;
                }
                else {
                    $container2[$key] += $item->amount;
                }
            }
            foreach ($container2 as $key => $item) {
                list($sid, $sname) = explode('_', $key);
                $sideList[] = array('sid' => $sid, 'sname' => $sname, 'amount' => $item);
            }

            $campusList = array('cid'=>$campus->cid,'cname'=>$campus->cname,'foodList'=>$foodList,'sideList'=>$sideList);
        }

//        var_dump($prepare_campus_item);
//        var_dump($campusList);
//        die();

        $_SESSION['campusList'] = $campusList;

        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/campus_distribution',$data);
        $this->load->view('partials/adminFooter');
    }

    //show order distribution list for print
    public function showOrderDistribution(){

        if(!isset($_SESSION['prepare_campus_item'])||!isset($_SESSION['diner'])){
            return redirect('preparecontroller/showDinerDishPanel');
        }
//        var_dump($_SESSION['prepare_campus_item']);
//        die();

        $data['foodList'] = $_SESSION['prepare_campus_item']['food'];
        $data['sideList'] = $_SESSION['prepare_campus_item']['side'];
//        unset($_SESSION['prepare_item']);
//        unset($_SESSION['dname']);

//        var_dump($data['prepare_item']);
//        die();

        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/diner_distribution',$data);
        $this->load->view('partials/adminFooter');
    }

    // go back to panel
    public function goback(){
        if(isset($_SESSION['prepare'])){
            unset($_SESSION['prepare']);
        }
        if(isset($_SESSION['prepare_item'])){
            unset($_SESSION['prepare_item']);
        }
        if(isset($_SESSION['diner'])){
            unset($_SESSION['diner']);
        }
        if(isset($_SESSION['campusList'])){
            unset($_SESSION['campusList']);
        }

        return redirect('preparecontroller/showDinerDishPanel');
    }

}