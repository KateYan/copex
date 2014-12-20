<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 8:37 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vipcontroller extends MY_Controller{

    //show Vip user manage panel
    public function showVipPanel(){
        $data['title'] = "Copex | 会员管理";
        $data['username'] = $_SESSION['username'];
        // search all vip user
        $this->load->model('user');
        if($this->user->allVip()){
            $data['vipUser'] = $this->user->allVip();
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('vipPanel',$data);
    }

    // show edit existing vip user
    public function showEditVip($userId){
        $data['title'] = "Copex | 编辑VIP";
        $data['username'] = $_SESSION['username'];
        // find campus for user to choose
        $this->load->model('market');
        $data['campus'] = $this->market->getCampusList();
        // find vip user's information
        $this->load->model('user');
        if($this->user->findVip($userId)){
            $data['vipUser'] = $this->user->findVip($userId);
        }

        $this->load->view('partials/adminHeader',$data);
        $this->load->view('editVip',$data);
    }

    // save edit vip user's information
    public function editVip(){
        $this->load->model('user');
        if(!empty($_POST['campusId'])){
            $columnName = "cid";
            $this->user->updateVip($columnName,$_POST['campusId']);
        }
        if
    }
}