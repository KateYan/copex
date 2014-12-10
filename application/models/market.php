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
    // and store their information into session
    public function getSideDish($cid){
        $sql="SELECT sidemenu.cid, sidemenuitem.sideItemID, sidemenuitem.sid, sidedish.sname, sidedish.sdes, sidedish.sprice, sidedish.spicture FROM(sidemenu JOIN sidemenuitem ON sidemenu.sideMenuID=sidemenuitem.sideMenuID)JOIN sidedish ON sidedish.sid=sidemenuitem.sid WHERE sidemenu.cid='".$cid."'AND sidemenu.sideMenuStatus='1'";
        $query = $this->db->query($sql);
        //store each row as session value
        $_SESSION['sidedish1-name'] = $query->row(0)->sname;
        $_SESSION['sidedish1-price'] = $query->row(0)->sprice;
        $_SESSION['sidedish2-name'] = $query->row(1)->sname;
        $_SESSION['sidedish2-price'] = $query->row(1)->sprice;
        $_SESSION['sidedish3-name'] = $query->row(2)->sname;
        $_SESSION['sidedish3-price'] = $query->row(2)->sprice;
        $_SESSION['sidedish4-name'] = $query->row(3)->sname;
        $_SESSION['sidedish4-price'] = $query->row(3)->sprice;

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


}