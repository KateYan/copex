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
                $campusId = $this->input->post('campus');
            }elseif(isset($_SESSION['basic_campus'])){
                $campusId = $_SESSION['basic_campus']['cid'];
            }

            $this->load->model('market');
            $timeRange = $this->market->getTimeRange($campusId);

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

            return redirect('basiccontroller/showEditTime/success');
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

            return redirect('basiccontroller/showBasicManage');
        }
    }