<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/24/2014
 * Time: 11:48 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuController extends MY_Controller{

    // panel
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
    public function showAddMenu(){
        $data['title'] = "Copex | 添加主食菜单";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/newMenu',$data);
        $this->load->view('partials/adminFooter');
    }
}