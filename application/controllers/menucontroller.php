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
        // campus list data
        $this->load->model('market');
        $data['campusList'] = $this->market->getCampusList();

        $data['title'] = "Copex | 菜单管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/menuPanel',$data);
        $this->load->view('partials/adminFooter');
    }

    // show specific campus' menu list
    public function showMenus(){
        // campus list data
        $this->load->model('market');
        if(isset($_POST['campus'])){
            if($this->market->getMenusByCampus($_POST['campus'])){
                $menus = $this->market->getMenusByCampus($_POST['campus']);
                $sideMenus = $this->market->getSideMenusByCampus($_POST['campus']);
                $_SESSION['menus'] = $menus;
                $_SESSION['sideMenus'] = $sideMenus;
            }
        }


//        var_dump($_SESSION['menus']);
//        var_dump($_SESSION['sideMenus']);
//        die();
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

//        var_dump($_POST);
    }

    // change side menu status
    public function changeSideMenuStatus(){
        if(!isset($_POST['sideMenu'])){
            return redirect('menucontroller/showMenus');
        }
        var_dump($_POST);
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
}