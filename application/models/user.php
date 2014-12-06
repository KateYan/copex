<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:46 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model {
    public $uid;
    public $cid;
    public $vipid;
    public $uphone;
    public $uhash;
    public $ip;
    public $last_login;
    public $ordered;
    public $created;

    /*
     * create a new user object
     * $properties format
     */
    public function newUser($properties){
        foreach ($properties as $key => $value) {
            $this->$key = $value;//__set() will be used automaticlly to check if the $key is property of user class
        }

        $sql="INSERT INTO user(cid,vipid,uphone,uhash,ip,last_login,ordered) VALUES(".$this->db->escape($this->cid).",".$this->db->escape($this->vipid).",".$this->db->escape($this->uphone).",".$this->db->escape($this->uhash).",".$this->db->escape($this->ip).",".$this->db->escape($this->last_login).",".$this->db->escape($this->ordered).")";
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
        $sql="SELECT *FROM user WHERE uid='$uid'";
        $query=$this->db->query($sql);
        $oldUser=$query->row(0);

        $this->uid=$uid;
        $this->cid=$oldUser->cid;
        $this->vipid=$oldUser->vipid;
        $this->uphone=$oldUser->uphone;
        $this->ip=$oldUser->ip;
        $this->uhash=$oldUser->uhash;
        $this->last_login=$oldUser->last_login;
        $this->ordered=$oldUser->ordered;
        $this->created=$oldUser->created;

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
    /*
     * update specific user's property's value
     * return updated user object
     */
    public function updateUser($uid,$name,$value){
        $sql = "UPDATE user SET ".$name." = '".$value."' WHERE uid='$uid'";
        $this->db->query($sql);
        $this->oldUser($uid);
        return $this;

    }
}