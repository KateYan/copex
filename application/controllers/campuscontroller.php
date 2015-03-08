<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/30/2015
 * Time: 12:13 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campuscontroller extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userOrderStart', 'userOrderStart', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('userOrderEnd', 'userOrderEnd', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('userPickupStart', 'userPickupStart', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('userPickupEnd', 'userPickupEnd', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('vipOrderStart', 'vipOrderStart', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('vipOrderEnd', 'vipOrderEnd', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('vipPickupStart', 'vipPickupStart', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
        $this->form_validation->set_rules('vipPickupEnd', 'vipPickupEnd', 'trim|required|/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/');
    }

    //show campus panel
    public function showCampusPanel(){
        // campus list data
        $this->load->model('market');
        $data['campus'] = $this->market->getCampusList();

        $data['title'] = "Copex | 校区管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/campusPanel',$data);
        $this->load->view('partials/adminFooter');
    }


    // show editing campus page
    public function showCampusDetail($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "请按照提示输入正确的校区信息！",
            'success' => "修改已成功!",
            'delerror' => "请选中餐厅再删除！",
            'delPlaceError' => "请选中取餐地点再删除！",
            'nodelete' => "有该校区的订单还未完成，不能删除！",
            'deletesuccess' => "删除配餐餐厅成功！",
            'delPlaceSuccess' => "删除取餐地址成功！",
            'addsuccess' => "添加新校区成功，您可以继续对它进行编辑！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        // if the page will be loaded directly by choosing one diner id from dinerPanel
        if(isset($_GET['campusId'])){
            $this->load->model('market');
            $this->market->findCampus($_GET['campusId']);
        }

        if(isset($_SESSION['campus'])){
            $campusId = $_SESSION['campus']['cid'];
            unset($_SESSION['campus']);
            $this->load->model('market');
            $this->market->findCampus($campusId);
        }

        $data['title'] = "Copex | 校区详情";
        // find campus for diner to add
        $this->load->model('market');
        $data['diners'] = $this->market->getDinerList();
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/campusDetail',$data);
        $this->load->view('partials/adminFooter');
    }

    // Edit campus
    public function editCampus(){
        // check if post data are empty
        if(empty($_POST['cname'])||empty($_POST['caddr'])){
            return redirect('campuscontroller/showCampusDetail/wrong');
        }

        // update campus information into db
        $columnName = array("cname","caddr");
        $value['cname'] = $this->input->post('cname');
        $value['caddr'] = $this->input->post('caddr');

        $this->load->model('market');
        $this->market->updateCampus($_POST['cid'],$columnName,$value);

        // using posted added diner id to create new coperation line for campus
        // get number of all campus
        $this->load->model('market');
        $diners = $this->market->getDinerList();
        $num_diner = count($diners);
        $addDiner = array();
        for($i=0;$i<$num_diner;$i++){
            if(isset($_POST["add_diner$i"])){
                $addDiner[] = $this->input->post("add_diner$i");
            }
        }

        if(!empty($addDiner)){
            // create coperation line;
            $this->load->model('coperationline');
            $this->coperationline->createLineByCampus($_POST['cid'],$addDiner);
        }
        // update diner session
        $campusId = $_SESSION['campus']['cid'];
        unset($_SESSION['campus']);
        $this->load->model('market');
        $this->market->findCampus($campusId);

        return redirect('campuscontroller/showCampusDetail/success');
    }

    // delete support diner
    public function removeSupportDiner(){
        if(empty($_POST)){
            return redirect('campuscontroller/showCampusDetail/delerror');
        }
        // using posted delete campus id to create new coperation line for diner
        // get number of all campus
        $this->load->model('market');
        $diners = $this->market->getDinerList();
        $num_diner = count($diners);
        $removeDiner = array();

        for($i=0;$i<$num_diner;$i++){
            if(isset($_POST["diner$i"])){
                $removeDiner[] = $this->input->post("diner$i");
            }
        }
        // delete selected support campus from diner
        if(!empty($removeDiner)){
            // delete coperation line;
            $this->load->model('coperationline');
            $this->coperationline->deleteLineByCampus($_SESSION['campus']['cid'],$removeDiner);
            // update campus session
            $campusId = $_SESSION['campus']['cid'];
            unset($_SESSION['campus']);
            $this->load->model('market');
            $this->market->findCampus($campusId);
        }
        return redirect('campuscontroller/showCampusDetail/deletesuccess');
    }

    // delete pickup place
    public function removePickupPlace(){
        if(empty($_POST['place'])){
            return redirect('campuscontroller/showCampusDetail/delPlaceError');
        }

        // using posted delete place id
        // remove place and basic rule
        $this->load->model('market');
        $this->market->deletePickupPlace($_POST['place']);

        return redirect('campuscontroller/showCampusDetail/delPlaceSuccess');
    }

    // show add new pickup place
    public function showAddPickupPlace($errorCode = null){

        // check if there is error code
        $eMsg = array(
            'noName' => "请输入取餐地点名称或代号",
            'noAddress' => "具体取餐地址不能为空",
            'success' => "成功添加取餐点！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $data['title'] = "Copex | 添加取餐地点";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newPickupPlace',$data);
        $this->load->view('partials/adminFooter');
    }

    // add pickup place for campus
    public function addPickupPlace(){
//        var_dump($_POST);
//        die();
        if(empty($_POST['placeName'])){
            return redirect('campuscontroller/showAddPickupPlace/noName');
        }

        if(empty($_POST['placeAddr'])){
            return redirect('campuscontroller/showAddPickupPlace/noAddress');
        }

        $this->load->model('market');
        $placeID = $this->market->addPickupPlaceForCampus($_POST['cid'],$_POST['placeName'],$_POST['placeAddr']);

        if($placeID){
            $_SESSION['place'] = $this->market->getPickupTimeRangeByPlace($placeID);
            return redirect('basiccontroller/showAddPickupTime');
        }

    }

    // show add new campus
    public function showAddCampus($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "校区名与地址不可为空！",
            'timewrong' => "请输入合法的24小时制时间。"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $data['title'] = "Copex | 添加校区";
        // find campus for diner to add
        $this->load->model('market');
        $data['diner'] = $this->market->getDinerList();
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newCampus',$data);
        $this->load->view('partials/adminFooter');
    }

    // add new campus
    public function addCampus(){
        // check if all input are fit the validation rules
        if($this->form_validation->run()==FALSE){
            return redirect('campuscontroller/showAddCampus/timewrong');
        }

        // store time setting
        $times = array($_POST['userOrderStart'],$_POST['userOrderEnd'],$_POST['userPickupStart'],$_POST['userPickupEnd'],$_POST['vipOrderStart'],$_POST['vipOrderEnd'],$_POST['vipPickupStart'],$_POST['vipPickupEnd']);

        // check if all input are fit the validation rules
        if(empty($_POST['cname'])||empty($_POST['caddr'])){
            return redirect('campuscontroller/showAddDiner/wrong');
        }
        // store campus information into db
        $value['cname'] = $this->input->post('cname');
        $value['caddr'] = $this->input->post('caddr');

        $this->load->model('market');
        $campusId = $this->market->newCampus($value,$times);// this method will create new campus and return diner's id

        // using posted added diner id to create new coperation line for campus
        // get number of all campus
        $this->load->model('market');
        $diner = $this->market->getDinerList();
        $num_diner = count($diner);
        $addDiner = array();
        for($i=0;$i<$num_diner;$i++){
            if(isset($_POST["add_diner$i"])){
                $addDiner[] = $this->input->post("add_diner$i");
            }
        }
        if(!empty($addDiner)){
            // create coperation line;
            $this->load->model('coperationline');
            $this->coperationline->createLineByCampus($campusId,$addDiner);
        }
        // update diner session
        if(isset($_SESSION['campus'])){
            unset($_SESSION['campus']);
        }
        $this->load->model('market');
        $this->market->findCampus($campusId);
        // add diner successful and return to see it's detail
        return redirect("campuscontroller/showCampusDetail/addsuccess");
    }

    // delete campus
    public function deleteCampus(){
        if(!isset($_SESSION['campus']['cid'])){
            return redirect('campuscontroller/showCampusPanel');
        }
        // check  campous status
        $this->load->model('market');
        if($this->market->checkCampusStatus($_SESSION['campus']['cid'])){
            return redirect('campuscontroller/showCampusDetail/nodelete');
        }
        $this->market->deleteCampus($_SESSION['campus']['cid']);

        return redirect('campuscontroller/showCampusPanel');
    }

    // time validate
    public function validateTimeSetting($time){

        $pattern = "/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/";
        if(preg_match($pattern,$time)){
            return true;
        }
        return false;
    }

    //
    public function goback(){
        if(isset($_SESSION['campus'])){
            unset($_SESSION['campus']);
        }

        if(isset($_SESSION['place'])){
            unset($_SESSION['place']);
        }


        return redirect('campuscontroller/showCampusPanel');
    }
}