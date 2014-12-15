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
        $sql = "SELECT * FROM campus WHERE cid='".$cid."'";
        $query = $this->db->query($sql);

        // return the result set as an array
        return $query->row(0);
    }


    // get sidedish's information by using it's sid
    public function getSidedishById($sid){
        $sql = "SELECT * FROM sidedish WHERE sid='".$sid."'";
        $query = $this->db->query($sql);

        // return the result set as an array
        return $query->row(0);
    }

    // get vip user's vipcard's information by using his vipid
    public function getVipCard($vipid){
        $sql = "SELECT * FROM vipcard WHERE vipid='".$vipid."'";
        $query = $this->db->query($sql);

        //return the result set as an array;
        return $query->row(0);
    }

    // using user's vipid to find his vipcard's password,
    // if the input password is not equal to the one get from database, return false
    // if they are same to each other then return true

    public  function validatePassword($vipid,$password){
        $this->load->model('market');
        $vipCard = $this->market->getVipCard($vipid);
        if($password==$vipCard->vpassword){
            return true;
        }
        return false;
    }

    // store new password
    public function updatePassword($vipid,$newPassword){
        $sql = "UPDATE vipcard SET vpassword='".$newPassword."' WHERE vipid='".$vipid."'";
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


}