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
    public $uhash;
    public $ip;
    public $last_login;
    public $ordered;

    /*
     * create a new user object
     * $properties format
     */
    public function newUser($properties){
        foreach ($properties as $key => $value) {
            $this->$key = $value;//__set() will be used automaticlly to check if the $key is property of user class
        }

        $sql="INSERT INTO user(cid,vipid,uphone,uhash,ip,last_login,ordered) VALUES('$this->cid',".$this->db->escape($this->vipid).",".$this->db->escape($this->uphone).",'$this->uhash','$this->ip',".$this->db->escape($this->last_login).",'$this->ordered')";
        $this->db->query($sql);
        $this->uid=$this->db->insert_id();
        return $this;
    }
    //if $name is property of user class then set value to it
    public function __set($name,$value){
        if(isset($this->$name)){
            $this->$name = $value;
        }
    }
    /*
     * user varible 'uid' to return an old user object
     */
    public function oldUser($uid){
        $sql="SELECT user.cid as cid, user.vipid as vipid, user.uphone as uphone,user.ip as ip,user.uhash as uhash, vipcard.vnumber as vnumber,vipcard.vbalance as vbalance,vipcard.vpassword as vpassword FROM user LEFT JOIN vipcard ON user.uid=vipcard.uid WHERE user.uid='$uid'";
        $query=$this->db->query($sql);
        $oldUser=$query->row(0);
        $this->uid=$uid;
        $this->cid=$oldUser->cid;
        $this->vipid=$oldUser->vipid;
        $this->uphone=$oldUser->uphone;
        $this->vnumber=$oldUser->vnumber;
        $this->vbalance=$oldUser->vbalance;
        $this->vpassword=$oldUser->vpassword;
        $this->ip=$oldUser->ip;
        $this->uhash=$oldUser->uhash;
        return $this;
    }
    /*
     * set sessions and cookies for loged in user
     */
    public function login($user){
        if(isset($user->vipid)){
            $_SESSION['vipid']=$user->vipid;
        }
        $_SESSION['uid']=$user->uid;
        $_SESSION['cid']=$user->cid;
        $cookieLife=time()+3600*24*365;
        setcookie('uid',$user->uid,$cookieLife,'/');
        setcookie('uhash',$user->uhash,$cookieLife,'/');
    }
}