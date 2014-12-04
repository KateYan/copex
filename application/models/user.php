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
    function __construct(Array $params=array()){
        if(count($params)){
            foreach($params as $key=>$value){
                $this->$key=$value;
            }
        }
    }
    /*
     * 新建一个用户
     * $properties format
     */
    public function newUser($properties){
        foreach ($properties as $key => $value) {
//            if (isset($this->$key)) {
//在这里始终不执行$this->$key=$value,加了magic method __set()才可以
                $this->$key = $value;
//            }
        }

        $sql="INSERT INTO user(cid,uhash,ip,ordered) VALUES('".$properties['cid']."','".$properties['uhash']."','".$properties['ip']."','".$properties['ordered']."')";
        $this->db->query($sql);
        $this->uid=$this->db->insert_id();
        return $this;
    }
    //遇到给属性赋值，就验证属性是否已经定义，定义后才会赋值
    public function __set($name,$value){
        if(isset($this->$name)){
            $this->$name = $value;
        }
    }
    /*
     * 根据uid返回一个老用户
     */
    public function oldUser($uid){
        $sql="SELECT user.cid as cid, user.vipid as vipid, user.uphone as uphone,user.ip as ip,user.uhash as uhash, vipcard.vnumber as vnumber,vipcard.vbalance as vbalance,vipcard.vpassword as vpassword FROM user LEFT JOIN vipcard ON user.uid=vipcard.uid WHERE user.uid='".$uid."'";
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
     * 为登录的user对象设置session和cookie
     */
    public function login($user){
        if(!isset($user->vipid)){
            $_SESSION['vipid']=$user->vipid;
        }
        $_SESSION['uid']=$user->uid;
        $_SESSION['cid']=$user->cid;
        $cookieLife=time()+3600*24*365;
        setcookie('uid',$user->uid,$cookieLife,'/');
        setcookie('uhash',$user->uhash,$cookieLife,'/');
    }
}