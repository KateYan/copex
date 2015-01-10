<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/10/2015
 * Time: 1:24 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cardcontroller extends MY_Controller{

    // show card list
    public function showCardList(){


        $data['title'] = "Copex | 会员卡管理";
//        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/cardList',$data);
//        $this->load->view('partials/adminFooter');
    }
}