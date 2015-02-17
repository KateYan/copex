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

    // get all pickup places of one campus
    public function getPickupPlacesByCampus($cid){
        $sql = "SELECT * FROM pickupplace WHERE cid = $cid";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // select all campus which has inuse menus
    public function getUseCampusList(){

        $sql = "SELECT campus.* FROM (campus JOIN dailymenu ON campus.cid=dailymenu.cid) JOIN sidemenu ON campus.cid=sidemenu.cid WHERE dailymenu.mstatus=1 AND sidemenu.sideMenuStatus=1";

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

    // find campus' all information including coperationline
    public function findCampus($cid){
        $sql1 = "SELECT * FROM campus WHERE cid = '$cid'";
        $query1 = $this->db->query($sql1);
        $result1 = $query1->result_array();

        $c_diner = array(
            'did'=>array(),
            'dname'=>array()
        );

        $sql2 = "SELECT coperationline.*,diner.dname FROM (coperationline JOIN diner ON coperationline.did = diner.did)JOIN campus ON coperationline.cid = campus.cid WHERE campus.cid = '$cid'";
        $query2 = $this->db->query($sql2);
        foreach($query2->result() as $line){
            $c_diner['did'][] = $line->did;
            $c_diner['dname'][] = $line->dname;
        }
        $campus = array_merge($result1[0],$c_diner);

        $_SESSION['campus'] = $campus;
    }

    // check campus status
    public function checkCampusStatus($cid){
        $sql = "SELECT * FROM `order` WHERE oispaid = 0 and cid = $cid or ostatus = 0 and cid = $cid";
        $query = $this->db->query($sql);
        if($query->num_rows() != 0){
            return ture;
        }
    }
    //get food information by using it's sid
    public function getFoodById($fid){
        $sql = "SELECT food.*,diner.did,diner.dname FROM food JOIN diner ON food.did = diner.did WHERE fid='$fid'";
        $query = $this->db->query($sql);

        // return the result set as an array
        return $query->row(0);
    }


    // get sidedish's information by using it's sid
    public function getSidedishById($sid){
        $sql = "SELECT sidedish.*,diner.did, diner.dname FROM sidedish JOIN diner ON sidedish.did = diner.did WHERE sid='$sid'";
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
    public function orderTimeRange($userType,$cid){
        $sql = "SELECT ".$userType."OrderStart as orderStart,".$userType."OrderEnd as orderEnd FROM `basic` WHERE cid=$cid";

        $query = $this->db->query($sql);
        $timeRange = $query->row(0);

        // return order time range
        $orderTimeRange = array('orderStart'=>$timeRange->orderStart,'orderEnd'=>$timeRange->orderEnd);
        return $orderTimeRange;
    }

    // using user's type to get pickup time range
    public function getPickupTime($userType,$cid){
        $sql = "SELECT ".$userType."PickupStart as pickupStart,".$userType."PickupEnd as pickupEnd FROM `basic` WHERE cid=$cid";

        $query = $this->db->query($sql);
        $timeRange = $query->row(0);

        // return pickup time range
        $pickupTimeRange = array('pickupStart'=>$timeRange->pickupStart,'pickupEnd'=>$timeRange->pickupEnd);
        return $pickupTimeRange;
    }

    // get user/vip's basic time rule
    public function getTimeRange($cid){

        $sql= "SELECT campus.cid as campusID, campus.cname as campusName, basic.* FROM campus LEFT JOIN basic ON campus.cid = basic.cid WHERE campus.cid = $cid";

        $query = $this->db->query($sql);

        return $query->row(0);
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
        $sql = "SELECT food.*,diner.did,diner.dname FROM food JOIN diner ON food.did = diner.did ";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // get all side dish from database
    public function getAllSideDish(){
        $sql = "SELECT sidedish.*,diner.did, diner.dname FROM sidedish JOIN diner ON sidedish.did = diner.did ";
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
        if($query->num_rows()!=1){
            return false;
        }
        $menu = $query->row(0);
        return $menu;

    }

    // get side menu detial
    public function getSideMenuById($sideMenuId){

        $sql = "SELECT sidemenu.*,campus.cname FROM sidemenu JOIN campus ON sidemenu.cid = campus.cid WHERE sidemenu.sideMenuID=$sideMenuId";
        $query = $this->db->query($sql);
        if($query->num_rows()!=1){
            return false;
        }
        $menu = $query->row(0);
        return $menu;
    }

    // update  pickup and order time range
    public function updateTimeSetting($cid,$nameList,$timeList){
        $num = count($nameList);

        $sql = "UPDATE basic SET ";
        for($i = 0; $i < $num; $i ++){
            $name = $nameList[$i];
            $sql .= "$name = ".$this->db->escape($timeList[$name])."";
            $sql .= ($i == ($num-1))? "WHERE cid = $cid;" : ',';
        }
        $this->db->query($sql);
    }

    // get all diner's information

    public function getDinerList(){
        $sql = "SELECT * FROM diner";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // update campus
    public function updateCampus($cid,$columnName,$value){
        $num = count($columnName);
        for($i = 0;$i < $num;$i++){
            $name = $columnName[$i];
            $sql = "UPDATE campus SET $name=".$this->db->escape($value[$name])." WHERE cid=$cid";

            $this->db->query($sql);
        }
    }

    // delete campus
    public function deleteCampus($cid){
        $sql = "DELETE FROM campus WHERE cid = '$cid'";
        $this->db->query($sql);
        // because cid is also table coperationline's foreign key with on delete cascate
        // so there is no need to delete related rows from coperationline
    }

    // add new campus
    public function newCampus($value,$times){
        $sql = "INSERT INTO campus(cname,caddr) VALUES (".$this->db->escape($value['cname']).",".$this->db->escape($value['caddr']).")";

        $this->db->query($sql);
        $campusId = $this->db->insert_id(); // get new diner's id

        $sql1 = "INSERT INTO basic(cid,userOrderStart,userOrderEnd,userPickupStart,userPickupEnd,vipOrderStart,vipOrderEnd,vipPickupStart,vipPickupEnd) VALUES('$campusId',".$this->db->escape($times[0]).",".$this->db->escape($times[1]).",".$this->db->escape($times[2]).",".$this->db->escape($times[3]).",".$this->db->escape($times[4]).",".$this->db->escape($times[5]).",".$this->db->escape($times[6]).",".$this->db->escape($times[7]).")";
        $query1 = $this->db->query($sql1);
        return $campusId;
    }

    // update food info
    public function updateFood($columnName,$value){
        $fid = $columnName[0];
        $num = count($columnName);

        $sql = "UPDATE food SET ";
        for($i=1;$i<$num;$i++){
            $name = $columnName[$i];
            $sql .= "$name=".$this->db->escape($value[$name])."";
            $sql .= ($i == ($num-1))? "WHERE fid=$value[$fid];" : ',';
        }
        $this->db->query($sql);
    }

    // update side dish info
    public function updateSideDish($columnName,$value){
        $sid = $columnName[0];
        $num = count($columnName);

        $sql = "UPDATE sidedish SET ";
        for($i=1;$i<$num;$i++){
            $name = $columnName[$i];
            $sql .= "$name=".$this->db->escape($value[$name])."";
            $sql .= ($i == ($num-1))? "WHERE sid=$value[$sid];" : ',';
        }
        $this->db->query($sql);
    }

    // create new food
    public function newFood($columnName,$value){
        $num = count($columnName);
        $sql = "INSERT INTO food(";
        for($i=0;$i<$num;$i++){
            $name = $columnName[$i];

            $sql .= "$name";
            $sql .= ($i == ($num-1))? ") VALUES(" : ',';
        }

        for($j=0;$j<$num;$j++){
            $name = $columnName[$j];

            $sql .= "'$value[$name]'";
            $sql .= ($j == ($num-1))? ');' : ',';
        }
        $this->db->query($sql);
        $foodId = $this->db->insert_id();
        return $foodId;
    }

    // create new side dish
    public function newSideDish($columnName,$value){
        $num = count($columnName);
        $sql = "INSERT INTO sidedish(";
        for($i=0;$i<$num;$i++){
            $name = $columnName[$i];

            $sql .= "$name";
            $sql .= ($i == ($num-1))? ") VALUES(" : ',';
        }

        for($j=0;$j<$num;$j++){
            $name = $columnName[$j];

            $sql .= "'$value[$name]'";
            $sql .= ($j == ($num-1))? ');' : ',';
        }
        $this->db->query($sql);
        $sideId = $this->db->insert_id();
        return $sideId;
    }

    // update web's click rate
    public function updateClick(){
        // get old click number
        $sql = "SELECT `value` FROM click WHERE `key`='clickTimes'";
        $query = $this->db->query($sql);
        $result = $query->row(0);
        $num = $result->value;

        $num ++;
        //update
        $sql_update = "UPDATE click SET `value`=$num WHERE `key`='clickTimes'";
        $this->db->query($sql_update);
    }

    //get click times
    public function getClick(){
        $sql = "SELECT `value` FROM click WHERE `key`='clickTimes'";
        $query = $this->db->query($sql);
        $result = $query->row(0);
        $num = $result->value;
        return $num;

    }
}