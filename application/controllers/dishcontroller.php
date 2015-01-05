<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 10:17 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dishcontroller extends MY_Controller{

    // show panel
    public function showDishPanel(){
        // get all dishes
        // 1. get food list from database
        $this->load->model('market');
        $data['food'] = $this->market->getAllFood();

        // 2. get sidedish list from database
        $this->load->model('market');
        $data['sideDish'] = $this->market->getAllSideDish();

        $data['title'] = "Copex | 菜品管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dishPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show details of a specific food
    public function showFoodDetail($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'pswnotmatch' => "两次输入密码不同！请再次输入",
            'pswmiss' => "只有输入两次新密码才能重置支付密码！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = $eMsg["$errorCode"];
        }

//        var_dump($_SESSION['food']);
//        die();
        $data['title'] = "Copex | 编辑菜品";

        // clean the session and get foodId
        if(isset($_GET['foodId'])){
            $foodId = $_GET['foodId'];
            if(isset($_SESSION['food'])){
                unset($_SESSION['food']);
            }
        }elseif(isset($_SESSION['food'])){
            $foodId = $_SESSION['food']->fid;
            unset($_SESSION['food']);
        }
        // find food's information and store as session
        $this->load->model('market');
        if($this->market->getFoodById($foodId)){
            $_SESSION['food'] = $this->market->getFoodById($foodId);
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/foodDetail',$data);
        $this->load->view('partials/adminFooter');
    }

    // edit food information
    public function editFood(){
        var_dump($_POST);
        die();
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'FALSE';
        $config['max_size'] = '0';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);
    }
    // upload file
    public function upload(){

    }
}