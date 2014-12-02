<?php
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();

        session_start();

        setcookie('cid','');
        setcookie('uid','');
        setcookie('vipid','');
    }

}
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 2014-11-16
 * Time: 2:33 PM
 */ 