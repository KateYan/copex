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
        var_dump($_POST);
        die();
        if(!$this->input->post('diner')){
            return redirect('dishcontroller/showDishPanel');
        }

        // find food that need to prepare
        // get orderTimeRange
        $userType = 'vip';
        $orderTimeRange = $this->market->orderTimeRange($userType);
        $orderStart = $orderTimeRange['orderStart'];
        $orderEnd = date("00:00:00");
        $time = date('H:i:s');
        if($time >= $orderEnd && $time< $orderStart){
            $date = date("Y-m-d");
        }

        $this->load->model('order');
        $this->order->getOrderItem($this->input->post('diner'));

    }

}