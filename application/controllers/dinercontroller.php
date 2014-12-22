<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/21/2014
 * Time: 2:46 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dinercontroller extends MY_Controller{

    // set validation rules
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('dname','DinerName','trim|required');
        $this->form_validation->set_rules('dphone','DinerPhone','trim|required|integer|numeric|exact_length[10]');
        $this->form_validation->set_rules('demail','DinerEmail','trim|required|valid_email');
        $this->form_validation->set_rules('daddr','DinerAddress','trim|required');
    }

    // show diner panel
    public function showDinerManage(){
        $data['title'] = "Copex | 餐厅管理";
        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('dinerManage',$data);
        $this->load->view('partials/adminFooter');
    }
    // show diner's detail for editting
    public function showDinerDetail($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "请按照提示输入正确的餐厅编辑信息！",
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = $eMsg["$errorCode"];
        }


        // if the page will be loaded directly by choosing one diner id from dinerPanel
        if(isset($_GET['dinerId'])){
            $this->load->model('diner');
            $diner = $this->diner->findDiner($_GET['dinerId']);
            $_SESSION['diner'] = $diner;
        }

//        var_dump($_SESSION['diner']);
//        die();
        $data['title'] = "Copex | 餐厅详情";
        // find campus for diner to add
        $this->load->model('market');
        $data['campus'] = $this->market->getCampusList();
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('dinerDetail',$data);
        $this->load->view('partials/adminFooter');

    }

    // save edit new info
    public function editDiner(){
        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            $this->load->model('diner');
            return redirect('dinercontroller/showDinerDetail/wrong');
        }
        var_dump($_POST);
        echo count($_POST);

    }
}