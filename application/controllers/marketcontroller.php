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
        $data['date'] = date('Y-m-d');
        $data['title'] = '午餐菜单';
        $data['uphone'] = $_SESSION['uphone'];

        //using cid and date to find menuitems
        $data['recomdItem'] = $this->menuitem->recomdItem($_SESSION['cid'],$data['date']);
        $data['saleItem'] = $this->menuitem->saleItem($_SESSION['cid'],$data['date']);

        $this->load->view('partials/header',$data);
        //if user is vip->he has vipid session then load vipmenu
        if(isset($_SESSION['vipid'])){
            $this->load->view('vipmenu',$data);
            return false;
        }
        $this->load->view('menu',$data);
    }

    /*
     * show sidedish option for vipuser
     */
    public function showSideDish(){
        //forbid non-vip user to see sidedish page
        if(!isset($_SESSION['vipid'])){
            return redirect('userstatuscontroller/checkUserStatus');
        }
        $this->load->model('market');
        $data['sideDish'] = $this->market->getSideDish($_SESSION['cid']);
        $data['title'] = '精选小食';
        $this->load->view('partials/header',$data);
        $this->load->view('sidedish',$data);
    }

    public function orderGenerate(){
        $fid = $this->input->post('fid');
        $uid = $_SESSION['uid'];
        $odate = date('Y-m-d');
        $oispaid = '0';
        $item = array('food'=>array($fid),'sidedish'=>array());
//
        $this->load->model('order');
        $order = new Order($uid,$odate,$oispaid,$item);
        var_dump($order);

    }
}
