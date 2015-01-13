<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/10/2015
 * Time: 1:24 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cardcontroller extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

    // show card list
    public function showCardList(){
        //find all vipcards
        $this->load->model('vipcard');
        $data['vipcards'] = $this->vipcard->findAllCards();
        //load view
        $data['title'] = "Copex | 会员卡管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/cardList',$data);
        $this->load->view('partials/adminFooter');
    }

    // show card's detail
    public function cardDetail($errorCode = NULL){
        // check if there is error code
        $eMsg = array(
            'pswnotmatch' => "两次输入密码不同！请再次输入",
            'pswmiss' => "只有输入两次新密码才能重置支付密码！",
            'wrong' => "输入的余额格式不正确！",
            'success' => "编辑会员卡成功！",
            'wrongpass' =>"请输入不含除数字/字母/下划线/破折号以外其他字符的6-10位密码"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        if(!isset($_GET['card'])){
            if(!isset($_SESSION['vipCard'])){
                return redirect('cardcontroller/showCardList');
            }
            else{
                $vipId = $_SESSION['vipCard']->vipid;
                unset($_SESSION['vipCard']);
            }
        }else{
            $vipId = $_GET['card'];
            if(isset($_SESSION['vipCard'])){
                unset($_SESSION['vipCard']);
            }
        }
        // get card Info
        $this->load->model('vipcard');
        $vipCard = $this->vipcard->findCardById($vipId);
        $_SESSION['vipCard'] = $vipCard;

        $data['title'] = "Copex | 会员卡详情";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/cardDetail',$data);
        $this->load->view('partials/adminFooter');
    }

    // save change
    public function editVipCard(){

        // check all inputs validation
        if(isset($_POST['vipBalance'])){
            $this->form_validation->set_rules('vipBalance','VipCardBalance','trim|required|greater_than[0]|less_than[301]');

            if($this->form_validation->run()==FALSE){
                return redirect('cardcontroller/cardDetail/wrong');
            }
        }

        $columnName = array();
        $value = array();
        // update balance
        $columnName[] = "vbalance";
        $value['vbalance'] = $_POST['vipBalance'];

        if(!empty($_POST['newPassword'])&&!empty($_POST['checkNewPassword'])){
            // set password validating rules
            $this->form_validation->set_rules('newPassword','VipPassword','trim|min_length[6]|max_length[10]|alpha_dash');
            $this->form_validation->set_rules('checkNewPassword','AgainPassword','trim|min_length[6]|max_length[10]|alpha_dash');

            if($this->form_validation->run()==FALSE){
                return redirect('cardcontroller/cardDetail/wrongpass');
            }

            if($_POST['newPassword']!=$_POST['checkNewPassword']){
                return redirect('cardcontroller/cardDetail/pswnotmatch');
            }
            $columnName[] = "vpassword";
            $value['vpassword'] = md5($_POST['newPassword']);

        }elseif((!empty($_POST['newPassword'])&&empty($_POST['checkNewPassword']))||(empty($_POST['newPassword'])&&!empty($_POST['checkNewPassword']))){

            return redirect('cardcontroller/cardDetail/pswmiss');// didn't fulfill both password area
        }

        $this->load->model('vipcard');

        $this->vipcard->updateVipCard($_POST['vipId'],$columnName,$value);
        $_SESSION['vipCard']->vbalance = $_POST['vipBalance'];
        return redirect('cardcontroller/cardDetail/success');
    }

    // show add new vip card's page
    public function showAddCard($errorCode=null){

        // check if there is error code
        $eMsg = array(
            'pswnotmatch' => "两次输入密码不同！请再次输入",
            'wrong' => "请不要留空，请输入4位数字卡号，输入不含除数字/字母/下划线/破折号以外其他字符的6-10位密码！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        $data['title'] = "Copex | 添加会员卡";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newCard',$data);
        $this->load->view('partials/adminFooter');
    }

    // add new card
    public function addCard(){
        $value = array();
        // check all inputs validation
        $this->form_validation->set_rules('vipNumber','VipCardNumber','trim|required|integer|numeric|exact_length[4]');
        $this->form_validation->set_rules('vipBalance','VipCardBalance','trim|required|greater_than[0]|less_than[301]');
        $this->form_validation->set_rules('newPassword','VipPassword','trim|required|min_length[6]|max_length[10]|alpha_dash');
        $this->form_validation->set_rules('checkNewPassword','AgainPassword','trim|required|min_length[6]|max_length[10]|alpha_dash');

        $value['vnumber'] = $_POST['vipNumber'];
        $value['vbalance'] = $_POST['vipBalance'];

        if($this->form_validation->run()==FALSE){
            return redirect('cardcontroller/showAddCard/wrong');
        }
        // check if two passwords match with each other
        if($_POST['newPassword']!=$_POST['checkNewPassword']){
            return redirect('cardcontroller/showAddCard/pswnotmatch');
        }
        $value['vpassword'] = md5($_POST['newPassword']);

        $this->load->model('vipcard');
        $newCard = $this->vipcard->newCard($value);

        return redirect("cardcontroller/cardDetail?card=$newCard");

    }

    // clear session
    public function goback(){
        if(isset($_SESSION['vipCard'])){
            unset($_SESSION['vipCard']);
        }
        return redirect('cardcontroller/showCardList');
    }
}