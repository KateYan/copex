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
    //if $name is property of user class then set value to it
    public function __set($name,$value){
        if(isset($this->$name)){
            $this->$name = $value;
        }
    }

    public function newUser($properties){
        foreach ($properties as $key => $value) {
            $this->$key = $value;//__set() will be used automaticlly to check if the $key is property of user class
        }

        $sql = "INSERT INTO `user`(cid,vipid,uphone,uhash,ip,ordered,created) VALUES(".$this->db->escape($this->cid).",".$this->db->escape($this->vipid).",".$this->db->escape($this->uphone).",".$this->db->escape($this->uhash).",".$this->db->escape($this->ip).",".$this->db->escape($this->ordered).",".$this->db->escape($this->created).")";
        $this->db->query($sql);
        $this->uid = $this->db->insert_id();
        return $this;
    }
    /*
     * user varible 'uid' to return an old user object
     */
    public function oldUser($uid){
        $sql = "SELECT *FROM user WHERE uid='$uid'";
        $query = $this->db->query($sql);
        $oldUser = $query->row(0);

        $this->uid = $uid;
        $this->cid = $oldUser->cid;
        $this->vipid = $oldUser->vipid;
        $this->uphone = $oldUser->uphone;
        $this->ip = $oldUser->ip;
        $this->uhash = $oldUser->uhash;
        $this->last_login = $oldUser->last_login;
        $this->ordered = $oldUser->ordered;
        $this->created = $oldUser->created;

        // update user's last_login status
        $last_login = date("Y-m-d H:i:s");
        $sql = "UPDATE user SET last_login='$last_login' WHERE uid='".$this->uid."'";
        $this->db->query($sql);

        return $this;
    }
    /*
     * set sessions and cookies for loged in user
     * SESSION: uid, cid, uphone, vipid(optional)
     * Cookie: uid, uhash
     */
    public function login($user){
        if(isset($user->vipid)){
            $_SESSION['vipid'] = $user->vipid;
        }
        $_SESSION['uid'] = $user->uid;
        $_SESSION['cid'] = $user->cid;
        $_SESSION['uphone'] = $user->uphone;
        $cookieLife = time()+3600*24*365;
        setcookie('uid',$user->uid,$cookieLife,'/');
        setcookie('uhash',$user->uhash,$cookieLife,'/');
    }
    /*
     * update specific user's property's value
     * return updated user object
     */
    public function updateUser($uid,$prop,$value){
        $sql = "UPDATE user SET ".$prop." = '$value' WHERE uid='$uid'";
        $this->db->query($sql);
        $this->oldUser($uid);
        return $this;
    }

    /*
     * find vip user by using input phone number
     */
    public function vipUser($uphone){
        $sql = "SELECT `user`.* FROM `user`,vipcard WHERE `user`.vipid = vipcard.vipid AND `user`.uphone='$uphone'";
        $query = $this->db->query($sql);
        if($query->num_rows()==1){
            $vip = $query->row(0);

            $this->uid = $vip->uid;
            $this->cid = $vip->cid;
            $this->vipid = $vip->vipid;
            $this->uphone = $vip->uphone;
            $this->ip = $vip->ip;
            $this->uhash = $vip->uhash;
            $this->last_login = $vip->last_login;
            $this->ordered = $vip->ordered;
            $this->created = $vip->created;

            return $this;
        }return false;//if can not find vip user exits or more vip user sharing one phone number, return false
    }

    /*
     * find all Vip user for administer to manage
     */
    public function allVip(){
        $sql = "SELECT `user`.uid,`user`.vipid,`user`.uphone,`user`.ordered,`user`.created,vipcard.vnumber,vipcard.vbalance FROM `user` JOIN vipcard ON `user`.vipid=vipcard.vipid ORDER BY `user`.created DESC";

        $query = $this->db->query($sql);

        if($query->num_rows()>0){
            return $query->result();
        }return false;
    }
    /*
     *find vip user by using uid
     */
    public function findVip($table,$columnName,$value){
        $sql = "SELECT `user`.uid,`user`.vipid,`user`.uphone,vipcard.vnumber,vipcard.vbalance FROM `user` JOIN vipcard ON `user`.vipid=vipcard.vipid AND `$table`.$columnName='$value'";

        $query = $this->db->query($sql);
        if($query->num_rows()!=1){
            return false;
        }
        return $query->row(0);
    }
    /*
     * update vip user's basic information
     */
    public function updateVip($userId,$columnName,$value){

        $sql = "UPDATE `user` SET ".$columnName."='$value' WHERE uid='$userId'";
        $this->db->query($sql);
        // check if the updating is successfully finished
        $num = $this->db->affected_rows();

    }
    /*
     * update vip card information
     */
    public function updateVipCard($userId,$columnName,$value){

        // find vipid first
        $sql0 = "SELECT vipid FROM `user` WHERE uid = $userId";
        $query0 = $this->db->query($sql0);

        $vipcard = $query0->row(0);

        $vipid = $vipcard->vipid;
        // find vipcard
        $sql = "UPDATE `vipcard` SET ".$columnName."='$value' WHERE vipid='$vipid'";
        $this->db->query($sql);
        // check if the updating is successfully finished
        $num = $this->db->affected_rows();

    }
    /*
     * create new vip user
     */
    public function newVip($uphone,$vnumber,$vbalance,$vpassword){
        // first create new vipcard row
        $sql1 = "INSERT INTO vipcard(vnumber,vbalance,vpassword) VALUES (".$this->db->escape($vnumber).",".$this->db->escape($vbalance).",".$this->db->escape($vpassword).")";
        $this->db->query($sql1);
        $vipid = $this->db->insert_id();

        // create new vip user basic information

        $uhash = hash('md5', rand(10000,99999));
        $created = date('Y-m-d H:i:s');
        $sql2 = "INSERT INTO `user`(vipid,uphone,uhash,ordered,created) VALUES (".$this->db->escape($vipid).",".$this->db->escape($uphone).",".$this->db->escape($uhash).",'0',".$this->db->escape($created).")";
        $this->db->query($sql2);
        $num = $this->db->affected_rows();

        if($num == 1){
            return true;
        }
        return false;

    }

}