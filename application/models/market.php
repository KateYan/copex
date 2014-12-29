<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:46 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Market extends CI_Model {

    // select all campus infomation from campus table
    public function getCampusList(){
        $sql = "SELECT * FROM campus";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // get campus's address by using session['cid']
    public function getCampusById($cid){
        $sql = "SELECT * FROM campus WHERE cid='$cid'";
        $query = $this->db->query($sql);

        // return the result set as an array
        return $query->row(0);
    }


    // get sidedish's information by using it's sid
    public function getSidedishById($sid){
        $sql = "SELECT * FROM sidedish WHERE sid='$sid'";
        $query = $this->db->query($sql);

        // return the result set as an array
        return $query->row(0);
    }

    // get vip user's vipcard's information by using his vipid
    public function getVipCard($vipid){
        $sql = "SELECT * FROM vipcard WHERE vipid='$vipid'";
        $query = $this->db->query($sql);

        //return the result set as an array;
        return $query->row(0);
    }

    // using user's vipid to find his vipcard's password,
    // if the input password is not equal to the one get from database, return false
    // if they are same to each other then return true

    public  function validatePassword($vipid,$password){
        // encrypt input password to check if it is match the one stored in database
        $encryptedPassword = md5($password);
        $vipCard = $this->getVipCard($vipid);
        if($encryptedPassword==$vipCard->vpassword){
            return true;
        }
        return false;
    }

    // store new password
    public function updatePassword($vipid,$newPassword){
        // encrypt input new password
        $encryptedNewPassword = md5($newPassword);
        $sql = "UPDATE vipcard SET vpassword='$encryptedNewPassword' WHERE vipid='$vipid'";
        $this->db->query($sql);
    }

    // get order time range for user
    public function orderTimeRange($userType){
        $sql1 = "SELECT `value` FROM `basic` WHERE `key`='".$userType."_order_start'";

        $sql2 = "SELECT `value` FROM `basic` WHERE `key`='".$userType."_order_end'";

        $query1 = $this->db->query($sql1);
        $timeStart = $query1->row(0);
        $query2 = $this->db->query($sql2);
        $timeEnd = $query2->row(0);

        // return order time range
        $orderTimeRange = array('orderStart'=>$timeStart->value,'orderEnd'=>$timeEnd->value);
        return $orderTimeRange;
    }

    // using user's type to get pickup time range
    public function getPickupTime($userType){
        $sql1 = "SELECT `value` FROM `basic` WHERE `key`='".$userType."_pickup_start'";

        $sql2 = "SELECT `value` FROM `basic` WHERE `key`='".$userType."_pickup_end'";

        $query1 = $this->db->query($sql1);
        $timeStart = $query1->row(0);
        $query2 = $this->db->query($sql2);
        $timeEnd = $query2->row(0);

        // return pickup time range
        $pickupTimeRange = array('pickupStart'=>$timeStart->value,'pickupEnd'=>$timeEnd->value);
        return $pickupTimeRange;
    }

    // get user/vip's basic time rule
    public function getTimeRange($userType){
        $name = array();
        $value = array();

        $sql1 = "SELECT * FROM basic WHERE `key`='".$userType."_order_start'";
        $query1 = $this->db->query($sql1);
        $name[] = $query1->row(0)->key;
        $value[] = $query1->row(0)->value;

        $sql2 = "SELECT * FROM basic WHERE `key`='".$userType."_order_end'";
        $query2 = $this->db->query($sql2);
        $name[] = $query2->row(0)->key;
        $value[] = $query2->row(0)->value;

        $sql3 = "SELECT * FROM basic WHERE `key`='".$userType."_pickup_start'";
        $query3 = $this->db->query($sql3);
        $name[] = $query3->row(0)->key;
        $value[] = $query3->row(0)->value;

        $sql4 = "SELECT * FROM basic WHERE `key`='".$userType."_pickup_end'";
        $query4 = $this->db->query($sql4);
        $name[] = $query4->row(0)->key;
        $value[] = $query4->row(0)->value;

        $timeRange = array('name'=>$name,'value'=>$value);

        return $timeRange;
    }

    // get menulist by using campus' id
    public function getMenusByCampus($cid){
        $sql = "SELECT campus.cid, campus.cname, dailymenu.* FROM campus JOIN dailymenu ON campus.cid = dailymenu.cid AND dailymenu.cid ='$cid' ORDER BY dailymenu.mstatus DESC, dailymenu.mdate DESC";
        $query = $this->db->query($sql);
        if($query->num_rows() ==0){
            return false;
        }
        return $query->result();
    }
    // get sidedish menu by using campus $cid
    public function getSideMenusByCampus($cid){
        $sql = "SELECT campus.cid, campus.cname, sidemenu.* FROM campus JOIN sidemenu ON campus.cid = sidemenu.cid AND sidemenu.cid ='$cid' ORDER BY sidemenu.sideMenuStatus DESC, sidemenu.sideMenuDate DESC ";
        $query = $this->db->query($sql);
        if($query->num_rows() ==0){
            return false;
        }
        return $query->result();
    }
    // get all food from database
    public function getAllFood(){
        $sql = "SELECT * FROM food";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // get all side dish from database
    public function getAllSideDish(){
        $sql = "SELECT * FROM sidedish";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // change menu and update status
    public function changeMenu($campusId,$menuId){
        // disable old menu first
        $sql1 = "UPDATE dailymenu SET mstatus = '0' WHERE cid = '$campusId' AND mstatus = '1'";
        $this->db->query($sql1);
        // active new menu
        $sql2 = "UPDATE dailymenu SET mstatus = '1' WHERE mid = '$menuId'";
        $this->db->query($sql2);
    }

    // change side menu and update status
    public function changeSideMenu($campusId,$sideMenuId){
        // disable old side menu first
        $sql1 = "UPDATE sidemenu SET sideMenuStatus = '0' WHERE cid = '$campusId' AND sideMenuStatus = '1'";
        $this->db->query($sql1);
        // active new side menu
        $sql2 = "UPDATE sidemenu SET sideMenuStatus = '1' WHERE sideMenuID = '$sideMenuId'";
        $this->db->query($sql2);
    }

    // get menu detial
    public function getMenuById($menuId){

        $sql = "SELECT dailymenu.*,campus.cname FROM dailymenu JOIN campus ON dailymenu.cid = campus.cid WHERE dailymenu.mid=$menuId";
        $query = $this->db->query($sql);
        if(count($query->result())!=1){
            return false;
        }
        return $query->row(0);

    }

    // get side menu detial
    public function getSideMenuById($sideMenuId){

        $sql = "SELECT sidemenu.*,campus.cname FROM sidemenu JOIN campus ON sidemenu.cid = campus.cid WHERE sidemenu.sideMenuID=$sideMenuId";
        $query = $this->db->query($sql);
        if(count($query->result())!=1){
            return false;
        }
        return $query->row(0);

    }

}