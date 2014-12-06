<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:28 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{

    /*
     * if some user try to use url/uri to see daily menu directyly,
     * forbid it and redirect to check user's status
     */
    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['uid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
    }
    /* load model "menuitem" and using its method recommend() and saleitem()
     * to find validate menuitem
     * for loading vipusers or non-vip users' menu
     */
    public function showDailyMenu(){
        $this->load->model('menuitem');
        date_default_timezone_set("America/Montreal");
        $data['date'] = date('Y-m-d');

        //using cid and date to find menuitems
        $data['recomdItem'] = $this->menuitem->recomdItem($_SESSION['cid'],$data['date']);
        $data['saleItem'] = $this->menuitem->saleItem($_SESSION['cid'],$data['date']);

        $data['title'] = '午餐菜单';
//        $data['uphone'] = $_SESSION['uphone'];
        $data['uphone'] ='647-255-1234'; //use this phone number as session to try
        $this->load->view('partials/header',$data);
        //if user is vip->he has vipid session then load vipmenu
        if(isset($_SESSION['vipid'])){
            $this->load->view('vipmenu',$data);
            return false;
        }
        $this->load->view('menu',$data);
    }
}
