<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:46 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Market extends CI_Model {

    /*
     * select all campus infomation from campus table
     */
    public function getCampusList(){
        $sql="SELECT * FROM campus";
        $query=$this->db->query($sql);
        return $query->result();
    }

    /*
     * 根据输入手机号查找用户并判断是否为VIP
     */
    public function isVip($uphone){
        $sql="SELECT vipid FROM user WHERE uphone='".$uphone."'";
        $query=$this->db->query($sql);
        $num=$query->num_rows();
        if($num==1){
            return $query->row();
        }
        return NULL;
    }
}