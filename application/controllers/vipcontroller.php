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
        $this->form_validation->set_rules('userPhone','Phone','trim|required|integer|numeric|exact_length[10]');
        $this->form_validation->set_rules('vipNumber','VipCardNumber','trim|required|integer|numeric|exact_length[4]');
        $this->form_validation->set_rules('vipBalance','VipCardBalance','trim|required|greater_than[49]|less_than[301]');
        $this->form_validation->set_rules('newPassword','VipPassword','trim|required|min_length[6]|max_length[10]|alpha_dash');
        $this->form_validation->set_rules('checkNewPassword','AgainPassword','trim|required|min_length[6]|max_length[10]|alpha_dash');
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
            'pswmiss' => "只有输入两次新密码才能重置支付密码！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = $eMsg["$errorCode"];
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
            return redirect('vipcontroller/showEditVip/pswmiss');// didn't fulfill both password area
        }
        unset($_SESSION['vipUser']);
        return redirect('vipcontroller/showVipPanel');
    }

    // show add vip user's page
    public function showAddVip($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "请按照输入要求插入新VIP用户信息！",
            'oldvip' => "该手机号已对应有存在的VIP用户！",
            'oldcard' => "该会员卡已使用！",
            'notmatch' => "两次输入的密码不匹配！",
            'faild' => "添加会员失败！",
            'success' => "会员已成功添加！"
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
        // check all inputs validation
        if($this->form_validation->run()==FALSE){
            return redirect('vipcontroller/showAddVip/wrong');
        }
        $this->load->model('user');
        // check if phone number has already exit
        $table = "user";
        $columnName['uphone'] = "uphone";
        if($this->user->findVip($table,$columnName['uphone'],$_POST['userPhone'])){
            return redirect('vipcontroller/showAddVip/oldvip');
        }
        // check if vip card number has already exit
        $table = "vipcard";
        $columnName['vnumber'] = "vnumber";
        if($this->user->findVip($table,$columnName['vnumber'],$this->input->post('vipNumber'))){
            return redirect('vipcontroller/showAddVip/oldcard');
        }
        // check if two password are match
        if($_POST['newPassword'] !=$_POST['checkNewPassword']){
            return redirect('vipcontroller/showAddVip/notmatch');
        }
        $passWord = md5($_POST['newPassword']);

        // create new VIP
        $newVip = $this->user->newVip($_POST['userPhone'],$_POST['vipNumber'],$_POST['vipBalance'],$passWord);
        if(!$newVip){
            return redirect('vipcontroller/showAddVip/faild');
        }
        return redirect('vipcontroller/showAddVip/success');

    }

    // clear session for go back anchor
    public function goback(){
        if(isset($_SESSION['vipUser'])){
            unset($_SESSION['vipUser']);
        }
        return redirect('vipcontroller/showVipPanel');
    }

}