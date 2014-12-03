<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Market extends CI_Model {

    /*
     * 查找campus表中所有行并返回
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
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:46 PM
 */ 