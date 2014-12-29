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
//            var_dump($data['rule']['timeRange']);
//            die();

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

            if(!isset($_SESSION['rule'])){
                // get time information of specific type of user
                if(isset($_GET['userType'])){
                    $userType = $_GET['userType'];
                }
            }else{// for updating rule session
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
    }