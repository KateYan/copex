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
            // get time rule from databse
            // non-vip
            $userType_0 = "user";

            $rule0['type'] = "普通用户";
            $this->load->model('market');
            $rule0['timeRange'] = $this->market->getTimeRange($userType_0);

            //vip
            $userType_1 = "vip";

            $rule1['type'] = "VIP用户";
            $this->load->model('market');
            $rule1['timeRange'] = $this->market->getTimeRange($userType_1);

            $data['rule'] = array($rule0,$rule1);

            // campus list data
            $this->load->model('market');
            $data['campus'] = $this->market->getCampusList();

            $data['title'] = "Copex | 基本管理";
            $this->load->view('partials/adminHeader',$data);
            $this->load->view('admin/basicPanel',$data);
            $this->load->view('partials/adminFooter');
        }
        // show editing time range page
        public function showEditTime(){

        }
    }