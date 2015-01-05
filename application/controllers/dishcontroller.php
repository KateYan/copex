<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 10:17 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dishcontroller extends MY_Controller{

    // show panel
    public function showDishPanel(){
        // get all dishes
        // 1. get food list from database
        $this->load->model('market');
        $data['food'] = $this->market->getAllFood();

        // 2. get sidedish list from database
        $this->load->model('market');
        $data['sideDish'] = $this->market->getAllSideDish();

        $data['title'] = "Copex | 菜品管理";
        $this->load->view('partials/adminHeader',$data);
        $this->load->view('admin/dishPanel',$data);
        $this->load->view('partials/adminFooter');
    }
}