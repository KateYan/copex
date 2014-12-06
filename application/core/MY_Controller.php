<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 2014-11-16
 * Time: 2:33 PM
 */
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        date_default_timezone_set("America/Montreal");
    }
}
