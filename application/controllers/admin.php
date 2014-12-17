<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/16/2014
 * Time: 9:44 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller{

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