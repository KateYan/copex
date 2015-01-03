<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/24/2014
 * Time: 11:48 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuController extends MY_Controller{

    // set validation rules
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('menu-cid','NewMenu-cid','trim|required');
        $this->form_validation->set_rules('menu-recommend','NewMenu-recommend','trim|required');
        $this->form_validation->set_rules('menu-onsale1','NewMenu-onSale-1','trim|required');
        $this->form_validation->set_rules('menu-onsale2','NewMenu-onSale-2','trim|required');
    }

    // show menu panel
    public function showMenuManage(){
        // clear menu session
        if(isset($_SESSION['menus'])){
            unset($_SESSION['menus']);
            unset($_SESSION['menu_campus']);
        }
        if(isset($_SESSION['sideMenus'])){
            unset($_SESSION['sideMenus']);
            unset($_SESSION['menu_campus']);
        }
        // campus list data
        $this->load->model('market');
        $data['campusList'] = $this->market->getCampusList();

        $data['title'] = "Copex | 菜单管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/menuPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show specific campus' menu list
    public function showMenus($message = null){
        // check if there is error code
        $Msg = array(
            'menuchanged' => "主食菜单已更换成功！",
            'sidemenuchanged'=>"小食菜单已更换成功！"
        );

        if(!empty($message) && isset($Msg["$message"])){
            $data["Msg"] = array("$message"=>$Msg["$message"]);
        }
        // campus list data
        $this->load->model('market');
        if(isset($_POST['campus'])){
            $campusId = $this->input->post('campus');
        }elseif(isset($_SESSION['menu_campus'])){
            $campusId = $_SESSION['menu_campus']['cid'];
        }
        // get campus name
        $campus = $this->market->getCampusById($campusId);
        $_SESSION['menu_campus'] = array('cid'=>$campus->cid,'cname'=>$campus->cname);
        if($this->market->getMenusByCampus($campusId)){
            $menus = $this->market->getMenusByCampus($campusId);
            $sideMenus = $this->market->getSideMenusByCampus($campusId);
            $_SESSION['menus'] = $menus;
            $_SESSION['sideMenus'] = $sideMenus;
        }



        $data['title'] = "Copex | 校区菜单历史";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/menu_campus',$data);
        $this->load->view('partials/adminFooter');
    }

    // change menu status
    public function changeMenuStatus(){
        if(!isset($_POST['menu'])){
            return redirect('menucontroller/showMenus');
        }
        // change menu status by using posted menu's id
        $this->load->model('market');{
            $this->market->changeMenu($_POST['menu-campus'],$_POST['menu']);
        }
        return redirect('menucontroller/showMenus/menuchanged');
    }

    // change side menu status
    public function changeSideMenuStatus(){
        if(!isset($_POST['sideMenu'])){
            return redirect('menucontroller/showMenus');
        }
        // change menu status by using posted menu's id
        $this->load->model('market');{
            $this->market->changeSideMenu($_POST['sidemenu-campus'],$_POST['sideMenu']);
        }
        return redirect('menucontroller/showMenus/sidemenuchanged');
    }

    //add new menu
    public function showAddMenu($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'noitem' => "菜单中菜品不能为空！",
            'samerecomd'=>"特价菜不能和推荐菜相同！",
            'sameonsale'=>"两款推荐菜不能重复！",
            'success'=>"成功创建新菜单！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        // get food list from database
        $this->load->model('market');
        $data['food'] = $this->market->getAllFood();

        $data['title'] = "Copex | 添加主食菜单";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newMenu',$data);
        $this->load->view('partials/adminFooter');
    }

    // add new menu for one campus
    public function addMenu(){
        // check if all input are fit the validation rules
        if(!isset($_POST['menu-cid'])||!isset($_POST['menu-recommend'])||!isset($_POST['menu-onsale1'])||!isset($_POST['menu-onsale2'])){
            return redirect('menucontroller/showAddMenu/noitem');
        }

        if($_POST['menu-onsale1'] == $_POST['menu-recommend']){
            return redirect('menucontroller/showAddMenu/samerecomd');
        }
        if($_POST['menu-onsale2'] == $_POST['menu-onsale1']){
            return redirect('menucontroller/showAddMenu/sameonsale');
        }

        // create new menu with menu item
        $date = date('Y-m-d');
        $this->load->model('menuitem');
        $this->menuitem->newMenu($date,$_POST['menu-cid'],$_POST['menu-recommend'],$_POST['menu-onsale1'],$_POST['menu-onsale2']);

            return redirect('menucontroller/showAddMenu/success');
    }

    //add new side menu
    public function showAddSideMenu($errorCode = null){
        // check if there is error code
        $eMsg = array(
            'wrong' => "小食菜单必须有4款小食！",
            'success' => "成功添加小食菜单！"
        );

        if(!empty($errorCode) && isset($eMsg["$errorCode"])){
            $data["eMsg"] = array("$errorCode"=>$eMsg["$errorCode"]);
        }

        // get food list from database
        $this->load->model('market');
        $data['sideDish'] = $this->market->getAllSideDish();

        $data['title'] = "Copex | 添加小食菜单";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newSideMenu',$data);
        $this->load->view('partials/adminFooter');
    }

    // add new side menu
    public function addSideMenu(){
        // count how many side dish admin chose to make a new side menu
        $num = count($_POST);
        if($num != 5){
            return redirect('menucontroller/showAddSideMenu/wrong');
        }
        // store all 4 side dish into an array
        $sideMenuItem = array();
        for($i = 0;$i<4;$i++){
            $sideMenuItem[] = $_POST["sideMenu-$i"];
        }
        // create new side menu
        $date = date('Y-m-d');
        $this->load->model('menuitem');
        $this->menuitem->newSideMenu($date,$_POST['sideMenu-cid'],$sideMenuItem);

        return redirect('menucontroller/showAddSideMenu/success');
    }

    // show Menu's detail
    public function showMenuDetail($menuId){
        // get menu's basic information
        $this->load->model('market');
        $data['menu'] = $this->market->getMenuById($menuId);
        // get menu's items' information
        $this->load->model('menuitem');
        $data['menuItems'] = $this->menuitem->getMenuItems($menuId);

        $data['title'] = "Copex | 菜单详情";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/menuDetail',$data);
        $this->load->view('partials/adminFooter');

    }

    // show Menu's detail
    public function showSideMenuDetail($sideMenuId){
        // get menu's basic information
        $this->load->model('market');
        $data['sideMenu'] = $this->market->getSideMenuById($sideMenuId);
        // get menu's items' information
        $this->load->model('menuitem');
        $data['sideMenuItems'] = $this->menuitem->getSideMenuItems($sideMenuId);

        $data['title'] = "Copex | 菜单详情";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/sideMenuDetail',$data);
        $this->load->view('partials/adminFooter');

    }

    //update inventory
    public function menuInventory(){
        var_dump($_POST);
        die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inventory0','recommond','trim|required|integer|numeric|max_length[4]');
        $this->form_validation->set_rules('inventory1','onsale1','trim|required|integer|numeric|max_length[4]');
        $this->form_validation->set_rules('inventory2','onsale2','trim|required|integer|numeric|max_length[4]');

        if($this->form_validation->run()==FALSE){
            return redirect('menucontroller/showAddVip/wrong');
        }
    }
}