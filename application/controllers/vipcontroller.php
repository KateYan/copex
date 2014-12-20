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
        // search all vip user
        $this->load->model('user');
        if($this->user->allVip()){
            $data['vipUser'] = $this->user->allVip();
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('vipPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show edit existing vip user
    public function showEditVip($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'pswnotmatch' => "两次输入密码不同！请再次输入",
            'pswmiss' => "只有输入两次新密码才能重置支付密码！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = $eMsg["$errorCode"];
        }

        $data['title'] = "Copex | 编辑VIP";
        // find campus for user to choose
        $this->load->model('market');
        $data['campus'] = $this->market->getCampusList();
        // if the function is loaded directlly from vip panel
        // get the user id
        if(isset($_GET['vipUser'])){
            $userId = $_GET['vipUser'];
            // find vip user's information and store as session
            $this->load->model('user');
            if($this->user->findVip($userId)){
                $_SESSION['vipUser'] = $this->user->findVip($userId);
            }
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('editVip',$data);
        $this->load->view('partials/adminFooter');
    }

    // save edit vip user's information
    public function editVip(){

        $userId = $_POST['userId'];
        $this->load->model('user');
        if(!empty($_POST['campusId'])){//update campus
            $columnName = "cid";
            $this->user->updateVip($userId,$columnName,$_POST['campusId']);
        }
        if(!empty($_POST['vipPhone'])){//update phone
            // check if vnumber is 4-digits number
            $columnName = "uphone";
            $this->user->updateVip($userId,$columnName,$_POST['vipPhone']);
        }
        if(!empty($_POST['vipNumber'])){//update card number
            $columnName = "vnumber";
            $this->user->updateVipCard($userId,$columnName,$_POST['vipNumber']);
        }
        if(!empty($_POST['vipBalance'])){// update balance
            $columnName = "vbalance";
            $this->user->updateVipCard($userId,$columnName,$_POST['vipBalance']);
        }
        if(!empty($_POST['newPassword'])&&!empty($_POST['checkNewPassword'])){
            if($_POST['newPassword']!=$_POST['checkNewPassword']){
                return redirect('vipcontroller/showEditVip/pswnotmatch');
            }
            $columnName = "vpassword";
            $newPassword = md5($_POST['newPassword']);
            $this->user->updateVipCard($userId,$columnName,$newPassword);
        }elseif((!empty($_POST['newPassword'])&&empty($_POST['checkNewPassword']))||(empty($_POST['newPassword'])&&!empty($_POST['checkNewPassword']))){
            return redirect('vipcontroller/showEditVip/pswmiss');
        }
        return redirect('vipcontroller/showVipPanel');
    }

    // show add vip user's page
    public function showAddVip(){
        $data['title'] = "Copex | 添加会员";

        $this->load->view('partials/adminHeader',$data);
        $this->load->view('newVip');
        $this->load->view('partials/adminFooter');
    }

    // using posted new vip information to add new vip
    public function addVip(){
        $this->load->model('user');
        // if new vip want to choose campus
        if(!empty($_POST['campusId'])){//update campus
            $columnName = "cid";
            $this->user->updateVip($userId,$columnName,$_POST['campusId']);
        }
    }
}