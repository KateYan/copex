<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:46 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public $uid;
    public $cid;
    public $vipid;
    public $uphone;
    public $vnumber;
    public $vbalance;
    public $vpassword;
    public $ip;
    public $uhash;
    public $ordered;

    function __construct(Array $params=array()){
        if(count($params)){
            foreach($params as $key=>$value){
                $this->$key=$value;
            }
        }
    }
/*
 * 新建一个不含电话的用户
 */
    public function newUser($cid){
        $ip=$_SERVER['REMOTE_ADDR'];
        $sql="INSERT INTO user(cid,uhash,ip,ordered) VALUES('".$cid."','12345','".$ip."','0')";
        $this->db->query($sql);
        $uid=$this->db->insert_id();

        $this->uid=$uid;
        $this->cid=$cid;
        $this->vipid=null;
        $this->uphone=null;
        $this->vnumber=null;
        $this->vbalance=null;
        $this->vpassword=null;
        $this->ip=$ip;
        $this->uhash='12345';
        return $this;

    }

}
