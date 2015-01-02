<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/22/2014
 * Time: 5:24 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Basiccontroller extends MY_Controller{

        // show basic rules' manage panel
        public function showBasicManage(){
            $userType= array();
            $timeRange = array();
            // get time rule from databse
            // non-vip
            $userType_0 = "user";
            $userType[] = $userType_0;
            $this->load->model('market');
            $timeRange[] = $this->market->getTimeRange($userType_0);

            //vip
            $userType_1 = "vip";
            $userType[] = $userType_1;
            $this->load->model('market');
            $timeRange[] = $this->market->getTimeRange($userType_1);

            $timeSetting = array('userType'=>$userType,'timeRange'=>$timeRange);
            $data['rule'] = $timeSetting;

            // campus list data
            $this->load->model('market');
            $data['campus'] = $this->market->getCampusList();

            $data['title'] = "Copex | 基本管理";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/basicPanel',$data);
            $this->load->view('partials/adminFooter');
        }

        // show editing time range page
        public function showEditTime($errorCode = null){
            // check if there is error code
            $eMsg = array(
                'pstartwrg' => "取餐起始时间错误！",
                'pendwrg' => "取餐结束时间错误！",
                'ostartwrg' => "下单起始时间错误！",
                'oendwrg' => "下单结束时间错误！"
            );

            if(!empty($errorCode) && isset($eMsg["$errorCode"])){
                $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
            }

            // check if this controller is loaded from basic panel
            if(isset($_GET['userType'])){
                // unset session first
                if(isset($_SESSION['rule'])){
                    unset($_SESSION['rule']);
                }
                // set user type
                $userType = $_GET['userType'];
            }else{
                if(!isset($_SESSION['rule'])){
                    return redirect('basiccontroller/showBasicManage');
                }
                $userType = $_SESSION['rule']['userType'];
            }

            $this->load->model('market');
            $timeRange= $this->market->getTimeRange($userType);

            $ruleDetail = array('userType'=>$userType,'timeRange'=>$timeRange);

            // store session
            $_SESSION['rule'] = $ruleDetail;
            
            $data['title'] = "Copex | 时间限制管理";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/editBasicTime',$data);
            $this->load->view('partials/adminFooter');
        }

        // edit new time setting
        public function editTime(){
            if(!$this->validateTimeSetting($_POST['pickup-start'])){
                return redirect('basiccontroller/showEditTime/pstartwrg');
            }

            if(!$this->validateTimeSetting($_POST['pickup-end'])){
                return redirect('basiccontroller/showEditTime/pendwrg');
            }

            if(!$this->validateTimeSetting($_POST['order-start'])){
                return redirect('basiccontroller/showEditTime/ostartwrg');
            }

            if(!$this->validateTimeSetting($_POST['order-end'])){
                return redirect('basiccontroller/showEditTime/oendwrg');
            }

            //update time
            $timeList = array($_POST['pickup-start'],$_POST['pickup-end'],$_POST['order-start'],$_POST['order-end']);
            $this->load->model('market');
            $this->market->updateTimeSetting($_POST['userType'],$timeList);

            return redirect('basiccontroller/showEditTime');
        }

        // time validate
        public function validateTimeSetting($time){
            if(true){
//                if($time>=date('00:00:00')&&$time<=date('23:59:59')){
                    return true;
//                }
            }
            return false;
        }

        // show editing campus page
        public function showCampusDetail($errorCode = null){
            // check if there is error code
            $eMsg = array(
                'wrong' => "请按照提示输入正确的校区信息！",
                'success'=>"修改已成功!",
                'delerror'=>"请选中餐厅再删除！",
                'deletesuccess'=>"删除配餐餐厅成功！",
                'addsuccess'=>"添加新校区成功，您可以继续对它进行编辑！"
            );

            if(!empty($errorCode) && isset($eMsg["$errorCode"])){
                $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
            }

            // if the page will be loaded directly by choosing one diner id from dinerPanel
            if(isset($_GET['campusId'])){
                $this->load->model('market');
                $this->market->findCampus($_GET['campusId']);
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
                return redirect('basiccontroller/showCampusDetail/wrong');
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

            return redirect('basiccontroller/showCampusDetail/success');
        }

        // delete support diner
        public function removeSupportDiner(){
//            var_dump($_POST);
//            die();
            if(empty($_POST)){
                return redirect('basiccontroller/showCampusDetail/delerror');
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
            return redirect('basiccontroller/showCampusDetail/deletesuccess');
        }

        // show add new campus
        public function showAddCampus($errorCode = null){
            // check if there is error code
            $eMsg = array(
                'wrong' => "校区名与地址不可为空！"
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
//            var_dump($_POST);
//            die();

            // check if all input are fit the validation rules
            if(empty($_POST['cname'])||empty($_POST['caddr'])){
                return redirect('basiccontroller/showAddDiner/wrong');
            }
            // store campus information into db
            $value['cname'] = $this->input->post('cname');
            $value['caddr'] = $this->input->post('caddr');

            $this->load->model('market');
            $campusId = $this->market->newCampus($value);// this method will create new campus and return diner's id

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
            return redirect("basiccontroller/showCampusDetail/addsuccess");
        }

        // delete campus
        public function deleteCampus(){
            if(!isset($_SESSION['campus']['cid'])){
                return redirect('basiccontroller/showBasicManage');
            }
            $this->load->model('market');
            $this->market->deleteCampus($_SESSION['campus']['cid']);

            return redirect('basiccontroller/showBasicManage');
        }
    }