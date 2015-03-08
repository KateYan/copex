<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/22/2014
 * Time: 5:24 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Basiccontroller extends MY_Controller{
        // show basic panel
        public function showBasicPanel(){
            // campus list data
            $this->load->model('market');
            $data['campusList'] = $this->market->getCampusList();

            $data['title'] = "Copex | 基本管理";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/basicPanel',$data);
            $this->load->view('partials/adminFooter');
        }

        // show basic rules' manage panel
        public function showBasicDetail(){

            if($this->input->post('campus')){

                $campusID = $this->input->post('campus');
            }elseif(isset($_SESSION['rule'])){
                $campusID = $_SESSION['rule']['campusID'];
            }

            // UPDATE SESSION
            $this->load->model('market');
            $timeRange = $this->market->getTimeRange($campusID);
            $data['places'] = $this->market->getPickupPlacesByCampus($campusID);
            $_SESSION['rule'] = $timeRange;

            $data['rule'] = $timeRange;

            $data['title'] = "Copex | 基本管理";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/basic_campus',$data);
            $this->load->view('partials/adminFooter');
        }

        // show editing time range page
        public function showEditTime($errorCode = null){
            // check if there is error code
            $eMsg = array(
                'pstartwrg' => "取餐起始时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'pendwrg' => "取餐结束时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'ostartwrg' => "下单起始时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'oendwrg' => "下单结束时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'success' => "修改时间成功！"
            );

            if(!empty($errorCode) && isset($eMsg["$errorCode"])){
                $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
            }

            // check if there is campus session
            if(!isset($_SESSION['rule'])){
                return redirect('basiccontroller/showBasicPanel');
            }
            $campusID = $_SESSION['rule']->campusID;

            // set user type
            if(!isset($_GET['userType'])){
                $userType = $_SESSION['ruleDetail']['userType'];
            }else{
                $userType = $_GET['userType'];
            }

            $this->load->model('market');
            $timeRange= $this->market->getTimeRange($campusID);
            $orderStart = $userType."OrderStart";
            $orderEnd = $userType."OrderEnd";
            $pickupStart = $userType."PickupStart";
            $pickupEnd = $userType."PickupEnd";

            $timeSetting = array('orderStart' => $timeRange->$orderStart,
                                'orderEnd' => $timeRange->$orderEnd,
                                'pickupStart' => $timeRange->$pickupStart,
                                'pickupEnd' => $timeRange->$pickupEnd
                                );

            $ruleDetail = array('userType'=>$userType,'timeRange'=>$timeSetting);

            // store session
            $_SESSION['ruleDetail'] = $ruleDetail;

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
            $orderStart = $_POST['userType']."OrderStart";
            $orderEnd = $_POST['userType']."OrderEnd";
            $pickupStart = $_POST['userType']."PickupStart";
            $pickupEnd = $_POST['userType']."PickupEnd";

            $nameList = array($pickupStart,$pickupEnd,$orderStart,$orderEnd);
            $timeList = array($pickupStart => $_POST['pickup-start'],
                            $pickupEnd => $_POST['pickup-end'],
                            $orderStart => $_POST['order-start'],
                            $orderEnd => $_POST['order-end']);
            $this->load->model('market');
            $this->market->updateTimeSetting($_SESSION['rule']->campusID,$nameList,$timeList);

            return redirect('basiccontroller/showEditTime/success');
        }

        // show pickup place's pickup time range
        public function showPlacePickupTime($errorCode = null){

            // check if there is error code
            $eMsg = array(
                'pstartwrg' => "取餐起始时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'pendwrg' => "取餐结束时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'success' => "修改时间成功！"
            );

            if(!empty($errorCode) && isset($eMsg["$errorCode"])){
                $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
            }

            if(isset($_GET['placeID'])){
                $placeID = $_GET['placeID'];
            }else{
                if(isset($_SESSION['pickupPlace'])){
                    $placeID = $_SESSION['pickupPlace']->placeID;
                }
            }
            $this->load->model('market');
            $pickupPlace = $this->market->getPickupTimeRangeByPlace($placeID);

            $_SESSION['pickupPlace'] = $pickupPlace;
            $data['pickupPlace'] = $pickupPlace;

            $data['title'] = "Copex | 取餐地点时间范围设定";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/basic_place',$data);
            $this->load->view('partials/adminFooter');
        }

        public function editPlacePickupTime(){

            if(!$this->validateTimeSetting($_POST['pickup-start'])){
                return redirect('basiccontroller/showPlacePickupTime/pstartwrg');
            }

            if(!$this->validateTimeSetting($_POST['pickup-end'])){
                return redirect('basiccontroller/showPlacePickupTime/pendwrg');
            }

            //update time
            $pickupStart = $_POST['pickup-start'];
            $pickupEnd = $_POST['pickup-end'];

            $this->load->model('market');
            $this->market->updatePickupTimeSetting($_POST['placeID'],$pickupStart,$pickupEnd);

            return redirect('basiccontroller/showPlacePickupTime/success');
        }

        // add pickup time range for pickup place
        public function showAddPickupTime($errorCode = null){

            // check if there is error code
            $eMsg = array(
                'pstartwrg' => "取餐起始时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'pendwrg' => "取餐结束时间错误！请输入'XX:XX:XX'格式的24小时制时间。",
                'success' => "添加时间成功！"
            );

            if(!empty($errorCode) && isset($eMsg["$errorCode"])){
                $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
            }


            if(!isset($_SESSION['place'])){
                return redirect('campuscontroller/showAddPickupPlace');
            }

            $this->load->model('market');
            $place = $this->market->getPickupTimeRangeByPlace($_SESSION['place']->placeID);
            $_SESSION['place'] = $place;

            $data['title'] = "Copex | 取餐地点时间范围设定";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/add_basic_place',$data);
            $this->load->view('partials/adminFooter');
        }

        public function addPlacePickupTime(){

            if(empty($_POST['pickup-start'])||!$this->validateTimeSetting($_POST['pickup-start'])){
                return redirect('basiccontroller/showAddPickupTime/pstartwrg');
            }

            if(empty($_POST['pickup-end'])||!$this->validateTimeSetting($_POST['pickup-end'])){
                return redirect('basiccontroller/showAddPickupTime/pendwrg');
            }

            //update time
            $pickupStart = $_POST['pickup-start'];
            $pickupEnd = $_POST['pickup-end'];

            $this->load->model('market');
            $ruleID = $this->market->addPickupTimeSetting($_POST['placeID'],$pickupStart,$pickupEnd);

            $placeID = $_POST['placeID'];

            if($ruleID){
                return redirect("basiccontroller/showPlacePickupTime?placeID=$placeID");
            }
            // faild adding pickup time range
        }

        // time validate
        public function validateTimeSetting($time){

            $pattern = "/^(((1|0?)[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/";
            if(preg_match($pattern,$time)){
                    return true;
            }
            return false;
        }


        // clear session for basiccontrolelr
        public function goback(){
            if(isset($_SESSION['rule'])){
                unset($_SESSION['rule']);
            }

            if(isset($_SESSION['ruleDetail'])){
                unset($_SESSION['ruleDetail']);
            }

            if(isset($_SESSION['pickupPlace'])){
                unset($_SESSION['pickupPlace']);
            }

            if(isset($_SESSION['place'])){
                unset($_SESSION['place']);
            }

            if(isset($_SESSION['campus'])){
                unset($_SESSION['campus']);
            }

            return redirect('basiccontroller/showBasicPanel');
        }
    }