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
            'success'=>"修改已成功!",
            'delerror'=>"请选中校区再删除！",
            'deletesuccess'=>"删除校区成功！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        // if the page will be loaded directly by choosing one diner id from dinerPanel
        if(isset($_GET['dinerId'])){
            $this->load->model('diner');
            $diner = $this->diner->findDiner($_GET['dinerId']);
            $_SESSION['diner'] = $diner;
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
            if(isset($_POST["more_campus$i"])){
                $addCampus[] = $this->input->post("more_campus$i");
                // add cid, cname session
                $_SESSION['diner']['cid'][] = $this->input->post("more_campus$i");
                $this->load->model('market');
                $campus = $this->market->getCampusById($_POST["more_campus$i"]);
                $_SESSION['diner']['cname'][] = $campus->cname;
            }
        }

        if(!empty($addCampus)){
            // create coperation line;
            $this->load->model('diner');
            $this->diner->createLine($_POST['did'],$addCampus);
        }
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
//                // unset delete cid and cname session
//                $num = $_SESSION['diner']['cid'];
//                for($j = 0;$j<$num; $j++){
//                    if($_SESSION['diner']['cid'][$j] == $_POST["campus$i"]){
//                        unset($_SESSION['diner']['cid'][$j]);
//                        unset($_SESSION['diner']['cname'][$j]);
//                    }
//                }
            }
        }
        var_dump($_SESSION['diner']);
        die();
        if(!empty($deleteCampus)){
            // delete coperation line;
            $this->load->model('diner');
            $sql = $this->diner->deleteLine($_SESSION['diner']['did'],$deleteCampus);
        }
        return redirect('dinercontroller/showDinerDetail/deletesuccess');
    }
}