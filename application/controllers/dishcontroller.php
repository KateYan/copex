<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 10:17 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dishcontroller extends MY_Controller{

    // set validation rules
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('dishName','dishName','trim|required');
        $this->form_validation->set_rules('dishPrice','dishPrice','trim|required|numeric|greater_than[0]|less_than[100]');

    }

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
            'wrong' => "菜名和价格不可为空！价格不能超过$100",
            'success' => "修改成功！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
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

        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();

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
//        var_dump($_POST);
//        die();
        if(empty($_POST)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            echo "Eroor";
            die();
            return redirect('dishcontroller/showFoodDetail/wrong');
        }

        // update Food information into db
        $value = array();
        $columnName = array("fid","fname","fprice","fpicture","fdes");
        $value['fid'] = $this->input->post('dishId');
        $value['fname'] = $this->input->post('dishName');
        $value['fprice'] = $this->input->post('dishPrice');
        $value['fpicture'] = $this->input->post('dishPicture');
        $value['fdes'] = $this->input->post('dishDes');
        if($this->input->post('newDiner')){
            $columnName[]="did";
            $value['did'] = $this->input->post('newDiner');
        }

        $this->load->model('market');
        $this->market->updateFood($columnName,$value);

        return redirect('dishcontroller/showFoodDetail/success');
    }
    // upload file
    public function upload(){

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'FALSE';
        $config['max_size'] = '204800';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);
        // check if upload successfully
        if ($this->upload->do_upload('picture')) { //success
            $upload = array('upload_data' =>$this->upload->data()); //store picture's info
            if(isset($_SESSION['upload'])){
                unset($_SESSION['upload']);
            }
            $_SESSION['upload'] = $upload;

            return redirect('dishcontroller/showFoodDetail');
        } else { //upload failed
            $error = array('error' =>$this->upload->display_errors());//store error info
            var_dump($error); //打印错误信息
        }
    }

    public function undo(){
        if(isset($_SESSION['upload'])){
            unset($_SESSION['upload']);
        }
        return redirect('dishcontroller/showFoodDetail');
    }
}