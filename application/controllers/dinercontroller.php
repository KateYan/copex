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
    public function showDinerManage($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'deletesuccess' => "成功删除餐厅!"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

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
            'success'=>"修改已成功!",
            'delerror'=>"请选中校区再删除！",
            'deletesuccess'=>"删除校区成功！",
            'addsuccess'=>"添加新餐厅成功，您可以继续对它进行编辑！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        // if the page will be loaded directly by choosing one diner id from dinerPanel
        if(isset($_GET['dinerId'])){
            $this->load->model('diner');
            $this->diner->findDiner($_GET['dinerId']);
        }

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
            return redirect('dinercontroller/showDinerDetail/wrong');
        }
        // update diner information into db
        $columnName = array("dname","contact","dphone","demail","daddr","dinfo");
        $value['dname'] = $this->input->post('dname');
        $value['contact'] = $this->input->post('contact');
        $value['dphone'] = $this->input->post('dphone');
        $value['demail'] = $this->input->post('demail');
        $value['daddr'] = $this->input->post('daddr');
        $value['dinfo'] = $this->input->post('dinfo');

        $this->load->model('diner');
        $this->diner->updateDiner($_POST['did'],$columnName,$value);

        // using posted added campus id to create new coperation line for diner
        // get number of all campus
        $this->load->model('market');
        $campus = $this->market->getCampusList();
        $num_campus = count($campus);
        $addCampus = array();
        for($i=0;$i<$num_campus;$i++){
            if(isset($_POST["add_campus$i"])){
                $addCampus[] = $this->input->post("add_campus$i");
            }
        }

        if(!empty($addCampus)){
            // create coperation line;
            $this->load->model('diner');
            $this->diner->createLine($_POST['did'],$addCampus);
        }
        // update diner session
        $dinerId = $_SESSION['diner']['did'];
        unset($_SESSION['diner']);
        $this->load->model('diner');
        $this->diner->findDiner($dinerId);

        return redirect('dinercontroller/showDinerDetail/success');
    }

    // delete existing support campus
    public function deleteSupportCampus(){
        if(empty($_POST)){
            return redirect('dinercontroller/showDinerDetail/delerror');
        }
        // using posted delete campus id to create new coperation line for diner
        // get number of all campus
        $this->load->model('market');
        $campus = $this->market->getCampusList();
        $num_campus = count($campus);
        $deleteCampus = array();

        for($i=0;$i<$num_campus;$i++){
            if(isset($_POST["campus$i"])){
                $deleteCampus[] = $this->input->post("campus$i");
            }
        }
        // delete selected support campus from diner
        if(!empty($deleteCampus)){
            // delete coperation line;
            $this->load->model('diner');
            $this->diner->deleteLine($_SESSION['diner']['did'],$deleteCampus);
            // update diner session
            $dinerId = $_SESSION['diner']['did'];
            unset($_SESSION['diner']);
            $this->load->model('diner');
            $this->diner->findDiner($dinerId);
        }
        return redirect('dinercontroller/showDinerDetail/deletesuccess');
    }

    // show add diner page
    public function showAddDiner($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "请按照提示添加正确的餐厅信息！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $data['title'] = "Copex | 添加餐厅";
        // find campus for diner to add
        $this->load->model('market');
        $data['campus'] = $this->market->getCampusList();
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('newDiner',$data);
        $this->load->view('partials/adminFooter');
    }

    // add new diner information into database
    public function addDiner(){
        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            return redirect('dinercontroller/showAddDiner/wrong');
        }
        // store diner information into db
        $value = $_POST;

        $this->load->model('diner');
        $dinerId = $this->diner->newDiner($value);// this method will create new diner and return diner's id

        // using posted added campus id to create new coperation line for diner
        // get number of all campus
        $this->load->model('market');
        $campus = $this->market->getCampusList();
        $num_campus = count($campus);
        $addCampus = array();
        for($i=0;$i<$num_campus;$i++){
            if(isset($_POST["add_campus$i"])){
                $addCampus[] = $this->input->post("add_campus$i");
            }
        }
        if(!empty($addCampus)){
            // create coperation line;
            $this->load->model('diner');
            $this->diner->createLine($dinerId,$addCampus);
        }
        // update diner session
        if(isset($_SESSION['diner'])){
            unset($_SESSION['diner']);
        }
        $this->load->model('diner');
        $this->diner->findDiner($dinerId);
        // add diner successful and return to see it's detail
        return redirect("dinercontroller/showDinerDetail/addsuccess");
    }

    // delete diner
    public function deleteDiner(){
        if(!isset($_SESSION['diner']['did'])){
            return redirect('dinercontroller/showDinerManage');
        }
        $this->load->model('diner');
        $this->diner->deleteDiner($_SESSION['diner']['did']);

        return redirect('dinercontroller/showDinerManage/deletesuccess');
    }

}