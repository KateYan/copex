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


    // select all sidemenu item from database where the side menu is activated
    public function getSideDish($cid){
        $sql="SELECT sidemenu.cid, sidemenuitem.sideItemID, sidemenuitem.sid, sidedish.sname, sidedish.sdes, sidedish.sprice, sidedish.spicture FROM(sidemenu JOIN sidemenuitem ON sidemenu.sideMenuID=sidemenuitem.sideMenuID)JOIN sidedish ON sidedish.sid=sidemenuitem.sid WHERE sidemenu.cid='".$cid."'AND sidemenu.sideMenuStatus='1'";
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


    // get food's information by using it's fid
    public function getFoodById($fid){
        $sql = "SELECT * FROM food WHERE fid='".$fid."'";
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


}