<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 8:37 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vipcontroller extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }
    //show Vip user manage panel
    public function showVipPanel(){
        $data['title'] = "Copex | 会员管理";
        // search all vip user
        $this->load->model('user');
        if($this->user->allVip()){
            $data['vipUser'] = $this->user->allVip();
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/vipPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show edit existing vip user
    public function showEditVip($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'pswnotmatch' => "两次输入密码不同！请再次输入",
            'pswmiss' => "只有输入两次新密码才能重置支付密码！",
            'nocard' => "您输入的会员卡不存在！",
            'inuse' => "您输入的会员卡正在被别的用户使用！",
            'wrongformat' => "密码格式不正确",
            'wrongbalance' => "请输入0到300的余额",
            'success' => "修改会员成功！",
            'wrongphoneformat' => "请输入10位有效电话号码"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $data['title'] = "Copex | 编辑VIP";

        if(isset($_GET['vipUser'])){
            $userId = $_GET['vipUser'];
            // find vip user's information and store as session
            $this->load->model('user');
            $table = "user";
            $columnName = "uid";
            if($this->user->findVip($table,$columnName,$userId)){
                $_SESSION['vipUser'] = $this->user->findVip($table,$columnName,$userId);
            }
        }
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/editVip',$data);
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
        if(isset($_POST['vipPhone'])){//update phone
//            echo "empty";
//            die();
            $_SESSION['vipUser']->uphone = $_POST['vipPhone'];
            // check if vnumber is 4-digits number
            $this->form_validation->set_rules('vipPhone','Phone','trim|required|integer|numeric|exact_length[10]');
            if($this->form_validation->run()==FALSE){
                return redirect('vipcontroller/showEditVip/wrongphoneformat');
            }

            // update it
            $columnName = "uphone";
            $this->user->updateVip($userId,$columnName,$_POST['vipPhone']);

        }
        if(isset($_POST['vipNumber'])){//update card number
            $_SESSION['vipUser']->vnumber = $_POST['vipNumber'];
            // check vip-card's status
            $this->load->model('vipcard');
            $vipCard = $this->vipcard->findVipCardByNumber($_POST['vipNumber']);

            if(!$vipCard){// if the card entered doesn't exist
                return redirect('vipcontroller/showEditVip/nocard');
            }elseif($vipCard->uid != $userId){// if the card is in use
                return redirect('vipcontroller/showEditVip/inuse');
            }else{// the card is safe to use
                $this->user->changeVipCardForUser($userId,$_POST['vipNumber']);
            }
        }
        if(isset($_POST['vipBalance'])){// update balance
            $_SESSION['vipUser']->vbalance = $_POST['vipBalance'];
            // check if balance is validate to use
            $this->form_validation->set_rules('vipBalance','VipCardBalance','trim|required|greater_than[0]|less_than[301]');
            if($this->form_validation->run()==FALSE){
                return redirect('vipcontroller/showEditVip/wrongbalance');
            }

            $columnName = "vbalance";
            $this->user->updateVipCardByUser($userId,$columnName,$_POST['vipBalance']);
        }
        if(isset($_POST['newPassword'])&&isset($_POST['checkNewPassword'])){
            // check if entered pasword validate the format
            $this->form_validation->set_rules('newPassword','VipPassword','trim|min_length[6]|max_length[10]|alpha_dash');
            $this->form_validation->set_rules('checkNewPassword','AgainPassword','trim|min_length[6]|max_length[10]|alpha_dash');

            if($this->form_validation->run()==FALSE){
                return redirect('vipcontroller/showEditVip/wrongformat');
            }

            if($_POST['newPassword']!=$_POST['checkNewPassword']){
                return redirect('vipcontroller/showEditVip/pswnotmatch');
            }
            $columnName = "vpassword";
            $newPassword = md5($_POST['newPassword']);
            $this->user->updateVipCardByUser($userId,$columnName,$newPassword);
        }elseif((!empty($_POST['newPassword'])&&empty($_POST['checkNewPassword']))||(empty($_POST['newPassword'])&&!empty($_POST['checkNewPassword']))){
            return redirect('vipcontroller/showEditVip/pswmiss');// didn't fulfill both password area
        }
        return redirect('vipcontroller/showEditVip/success');
    }

    // show add vip user's page
    public function showAddVip($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrongphoneformat' => "请输入10位有效电话号码",
            'oldvip' => "该手机号已对应有存在的VIP用户！",
            'emptycard' => "请输入四位有效会员卡号！",
            'nocard' => "您输入的会员卡不存在！",
            'inuse' => "该会员卡已被其他用户使用！",
            'wrongbalance' => "请输入0-300的会员卡余额"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }
        $data['title'] = "Copex | 添加会员";

        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newVip');
        $this->load->view('partials/adminFooter');
    }

    // using posted new vip information to add new vip
    public function addVip(){
//        var_dump($_POST);
//        echo $_POST['vipNumber'];
//        die();
        // check all inputs validation
        // 1. check phone number
        $this->form_validation->set_rules('vipPhone','Phone','trim|required|integer|numeric|exact_length[10]');
        if($this->form_validation->run()==FALSE){
            return redirect('vipcontroller/showAddVip/wrongphoneformat');
        }

        $this->load->model('user');
        // check if phone number has already exit
        $table = "user";
        $columnName['uphone'] = "uphone";
        if($this->user->findVip($table,$columnName['uphone'],$_POST['vipPhone'])){
            return redirect('vipcontroller/showAddVip/oldvip');
        }

        if(!isset($_POST['vipNumber'])){//update card number
            return redirect('vipcontroller/showAddVip/emptycard');
        }else{
            // check vip-card's status
            $this->load->model('vipcard');
            $vipCard = $this->vipcard->findVipCardByNumber($_POST['vipNumber']);

            if(!$vipCard){// if the card entered doesn't exist
                return redirect('vipcontroller/showAddVip/nocard');
            }elseif($vipCard->uid != null){// if the card is in use
                return redirect('vipcontroller/showAddVip/inuse');
            }else{// the card is safe to use
                // check if there is card's balance is posted
                if(!isset($_POST['vipBalance'])){
                    return redirect('vipcontroller/showAddVip/wrongbalance');
                }else{
                    $this->form_validation->set_rules('vipBalance','VipCardBalance','trim|required|greater_than[0]|less_than[301]');
                    if($this->form_validation->run()==FALSE){
                        return redirect('vipcontroller/showAddVip/wrongbalance');
                    }
                    // create new vip user
                    $vip = $this->user->newVip($_POST['vipPhone'],$_POST['vipNumber'],$_POST['vipBalance']);
                    return redirect("vipcontroller/showEditVip?vipUser=$vip");
                }

            }
        }
    }

    // clear session for go back anchor
    public function goback(){
        if(isset($_SESSION['vipUser'])){
            unset($_SESSION['vipUser']);
        }
        return redirect('vipcontroller/showVipPanel');
    }

}