<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:28 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketcontroller extends MY_Controller{
    /*
     * load model "menuitem" and using its method recommend() and saleitem()
     * to find validate menuitem
     * for loading vipusers or non-vip users' menu
     */
    public function showDailyMenu(){
        $this->load->model('menuitem');
        $data['date']=date('Y-m-d');

        //using cid and date to find menuitems
        $data['recomdItem']=$this->menuitem->recomdItem($_SESSION['cid'],$data['date']);
        $data['saleItem']=$this->menuitem->saleItem($_SESSION['cid'],$data['date']);

        $data['title']='午餐菜单';
        $this->load->view('partials/header',$data);
        //if user is vip->he has vipid session then load vipmenu
        if(isset($_SESSION['vipid'])){
            $this->load->view('vipmenu',$data);
            return false;
        }
        $this->load->view('dailymenu',$data);
    }
}
