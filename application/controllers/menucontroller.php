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
        if($this->market->getMenusByCampus($_POST['campus'])){
            $data['menus'] = $this->market->getMenusByCampus($_POST['campus']);
            $data['sidemenus'] = $this->market->getSideMenusByCampus($_POST['campus']);
        }

        $data['title'] = "Copex | 校区菜单历史";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/menu_campus',$data);
        $this->load->view('partials/adminFooter');
    }

    // change menu status
    public function changeMenuStatus(){

    }

    // change side menu status
    public function changeSideMenuStatus(){

    }
}