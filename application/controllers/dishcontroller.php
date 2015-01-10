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
    public function showDishPanel($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'fooddeleted' => "删除主食成功！",
            'sidedeleted' => "删除小食成功！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
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
            'success' => "修改成功！",
            'inuse' => "该主食正在使用，不可直接删除！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

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

        if(empty($_POST)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
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

    // show details of a specific side dish
    public function showSideDetail($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "菜名和价格不可为空！价格不能超过$100",
            'success' => "修改成功！",
            'inuse' => "该小食正在使用，不可直接删除！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

//        var_dump($_SESSION['side']);
//        die();
        $data['title'] = "Copex | 编辑菜品";

        // clean the session and get foodId
        if(isset($_GET['sideId'])){
            $sideId = $_GET['sideId'];
            if(isset($_SESSION['side'])){
                unset($_SESSION['side']);
            }
        }elseif(isset($_SESSION['side'])){
            $sideId = $_SESSION['side']->sid;
            unset($_SESSION['side']);
        }

        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();

        // find side dish's information and store as session
        $this->load->model('market');
        if($this->market->getSidedishById($sideId)){
            $_SESSION['side'] = $this->market->getSidedishById($sideId);
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/sideDishDetail',$data);
        $this->load->view('partials/adminFooter');
    }

    // edit food information
    public function editSideDish(){

        if(empty($_POST)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            return redirect('dishcontroller/showSideDetail/wrong');
        }

        // update Food information into db
        $value = array();
        $columnName = array("sid","sname","sprice","spicture","sdes");
        $value['sid'] = $this->input->post('dishId');
        $value['sname'] = $this->input->post('dishName');
        $value['sprice'] = $this->input->post('dishPrice');
        $value['spicture'] = $this->input->post('dishPicture');
        $value['sdes'] = $this->input->post('dishDes');
        if($this->input->post('newDiner')){
            $columnName[]="did";
            $value['did'] = $this->input->post('newDiner');
        }

        $this->load->model('market');
        $this->market->updateSideDish($columnName,$value);

        return redirect('dishcontroller/showSideDetail/success');
    }

    // upload file
    public function uploadFood(){
//        var_dump($_POST);
//        die();

        $this->load->model('pictureupload');
        if($this->input->post('picture')){
            $picture = $this->pictureupload->do_upload();
            if(!isset($picture->file_name)){
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
                $_SESSION['error'] = $picture;
            }else{
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
            }

            if(isset($_SESSION['upload'])){
                unset($_SESSION['upload']);
            }

            $_SESSION['upload'] = $picture->file_name;
//            echo $_SESSION['upload']->file_name;
//            die();
            return redirect('dishcontroller/showFoodDetail');
        }
        return redirect('dishcontroller/showFoodDetail/wrong');

    }

    public function undoFood(){
        if(isset($_SESSION['upload'])){
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }
        return redirect('dishcontroller/showFoodDetail');
    }

    // upload file
    public function uploadSideDish(){

        $this->load->model('pictureupload');
        if($this->input->post('picture')){
            $picture = $this->pictureupload->do_upload_sidedish();

            if(!isset($picture->file_name)){
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
                $_SESSION['error'] = $picture;
            }else{
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
            }

            if(isset($_SESSION['upload'])){
                unset($_SESSION['upload']);
            }

            $_SESSION['upload'] = $picture->file_name;
            return redirect('dishcontroller/showSideDetail');
        }
        return redirect('dishcontroller/showSideDetail/wrong');

    }

    public function undoSideDish(){
        if(isset($_SESSION['upload'])){
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }
        return redirect('dishcontroller/showSideDetail');
    }

    // show  add food
    public function showAddFood($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "菜名和价格,图片不可为空！价格不能超过$100",
            'success' => "添加成功！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();

        $data['title'] = "Copex | 添加菜品";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newFood',$data);
        $this->load->view('partials/adminFooter');
    }

    // new food upload
    // upload file
    public function upload_1(){

        $this->load->model('pictureupload');
        if($this->input->post('picture')){

            $picture = $this->pictureupload->do_upload();
            if(!isset($picture->file_name)){
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
                $_SESSION['error'] = $picture;
            }else{
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
            }

            if(isset($_SESSION['upload'])){
                unset($_SESSION['upload']);
            }

            $_SESSION['upload'] = $picture->file_name;
            return redirect('dishcontroller/showAddFood');
        }
        return redirect('dishcontroller/showAddFood/wrong');

    }

    // add new food
    public function newFood(){
//        var_dump($_POST);
//        die();
        if(!isset($_POST)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            return redirect('dishcontroller/showAddFood/wrong');
        }
        // store food information into db
        $value = array();
        $columnName = array("fname","fprice","fpicture","fdes","did");
        $value['fname'] = $this->input->post('dishName');
        $value['fprice'] = $this->input->post('dishPrice');
        $value['fpicture'] = $this->input->post('dishPicture');
        $value['fdes'] = $this->input->post('dishDes');
        $value['did'] = $this->input->post('newDiner');


        $this->load->model('market');
        $foodId = $this->market->newFood($columnName,$value);

        return redirect("dishcontroller/showFoodDetail?foodId=$foodId");
    }

    // add new side dish
    // show  add side dish
    public function showAddSideDish($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "菜名和价格,图片不可为空！价格不能超过$100",
            'success' => "添加成功！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        // find all diners
        $this->load->model('diner');
        $data['diners'] = $this->diner->allDiners();

        $data['title'] = "Copex | 添加菜品";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newSideDish',$data);
        $this->load->view('partials/adminFooter');
    }

    // new food upload
    // upload file
    public function upload_2(){

        $this->load->model('pictureupload');
        if($this->input->post('picture')){

            $picture = $this->pictureupload->do_upload_sidedish();
            if(!isset($picture->file_name)){
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
                $_SESSION['error'] = $picture;
            }else{
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
            }

            if(isset($_SESSION['upload'])){
                unset($_SESSION['upload']);
            }

            $_SESSION['upload'] = $picture->file_name;
            return redirect('dishcontroller/showAddSideDish');
        }
        return redirect('dishcontroller/showAddSideDish/wrong');

    }

    // add new food
    public function newSideDish(){
//        var_dump($_POST);
//        die();
        if(!isset($_POST)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            return redirect('dishcontroller/showAddSideDish/wrong');
        }
        // store food information into db
        $value = array();
        $columnName = array("sname","sprice","spicture","sdes","did");
        $value['sname'] = $this->input->post('dishName');
        $value['sprice'] = $this->input->post('dishPrice');
        $value['spicture'] = $this->input->post('dishPicture');
        $value['sdes'] = $this->input->post('dishDes');
        $value['did'] = $this->input->post('newDiner');


        $this->load->model('market');
        $sideId = $this->market->newSideDish($columnName,$value);

        return redirect("dishcontroller/showSideDetail?sideId=$sideId");
    }

    public function goback(){
        if(isset($_SESSION['food'])){
            unset($_SESSION['food']);
        }

        if(isset($_SESSION['side'])){
            unset($_SESSION['side']);
        }

        if(isset($_SESSION['upload'])){
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        return redirect('dishcontroller/showDishPanel');
    }

    // delete food
    public function deleteFood(){
        if(!isset($_SESSION['food']->fid)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if this food is in use
        $this->load->model('menuitem');

        if($this->menuitem->checkFoodStatus($_SESSION['food']->fid)){
            $this->menuitem->deleteFood($_SESSION['food']->fid);
            return redirect('dishcontroller/showDishPanel/fooddeleted');
        }
        return redirect('dishcontroller/showFoodDetail/inuse');
    }

    // delete food
    public function deleteSideDish(){
        if(!isset($_SESSION['side']->sid)){
            return redirect('dishcontroller/showDishPanel');
        }

        // check if this food is in use
        $this->load->model('menuitem');

        if($this->menuitem->checkSideDishStatus($_SESSION['side']->sid)){
            $this->menuitem->deleteSideDish($_SESSION['side']->sid);
            return redirect('dishcontroller/showDishPanel/sidedeleted');
        }
        return redirect('dishcontroller/showSideDetail/inuse');
    }
}