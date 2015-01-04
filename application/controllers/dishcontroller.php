<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/3/2015
 * Time: 6:02 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dishcontroller extends MY_Controller{

    // show panel
    public function showDishPanel(){
        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();
        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dishPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show all dishes this diner need to prepare
    public function showDishes(){
        if(!$this->input->post('diner')){
            return redirect('dishcontroller/showDishPanel');
        }

        // find diner's name
        $this->load->model('diner');
        $this->diner->findDiner($this->input->post('diner'));
        $data['diner'] = $_SESSION['diner'];
        unset($_SESSION['diner']);
        $_SESSION['dname'] = $data['diner']['dname'];

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
        if(!$this->order->getOrderItem($this->input->post('diner'),$date)){

        }
        $prepare_item = $this->order->getOrderItem($this->input->post('diner'),$date);
        $_SESSION['prepare_item'] = $prepare_item;
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

        $data['foodList'] = $foodList;
        $data['sideList'] = $sideList;

        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dishes_diner',$data);
        $this->load->view('partials/adminFooter');

    }

    // show distrubution list for print
    public function showDistribution(){
        if(!isset($_SESSION['prepare_item'])){
            return redirect('dishcontroller/showDishPanel');
        }
        if(!isset($_SESSION['dname'])){
            return redirect('dishcontroller/showDishPanel');
        }
        $data['prepare_item'] = $_SESSION['prepare_item'];
        $data['dname'] = $_SESSION['dname'];
        unset($_SESSION['prepare_item']);
        unset($_SESSION['dname']);

//        var_dump($data['prepare_item']);
//        die();

        $data['title'] = "Copex | 备餐管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/diner_distribution',$data);
        $this->load->view('partials/adminFooter');
    }

}