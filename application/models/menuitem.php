<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:51 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menuitem extends CI_Model {

    /*
     * using cid and date and status to choose one recommend menu-item
     */

    public function recomdItem($cid){
        $sql="SELECT menuitem.fid as fid, food.fname as fname, food.fdes as fdes, food.fprice as fprice, food.fpicture as fpicture FROM(dailymenu JOIN menuitem ON dailymenu.mid=menuitem.mid)JOIN food ON food.fid=menuitem.fid WHERE dailymenu.cid='$cid' AND menuitem.isrecomd='1' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);

        if($query->num_rows()==1){
            return $query->row(0);
        }
        return false;
    }
/*
 * using cid and date and status to choose two on-sale menu-items
 */
    public function saleItem($cid){
        $sql="SELECT dailymenu.cid, menuitem.mitemid, menuitem.fid, menuitem.isrecomd,food.fname, food.fdes, food.fprice, food.fpicture FROM(dailymenu JOIN menuitem ON dailymenu.mid=menuitem.mid)JOIN food ON food.fid=menuitem.fid WHERE dailymenu.cid='".$cid."'AND menuitem.isrecomd='0' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);
        if($query->num_rows()==2){
            return $query->result();
        }
        return false;
    }


     // store session for menu-dishes
    public function storeInSession($recomdItem,$saleItem){
        $_SESSION['food1'] = array('name' => $recomdItem->fname, 'price' => $recomdItem->fprice);

        $_SESSION['food2'] = array('name' => $saleItem[0]->fname, 'price' => $saleItem[0]->fprice);

        $_SESSION['food3'] = array('name' => $saleItem[1]->fname, 'price' => $saleItem[1]->fprice);

    }


    // select all sidemenu item from database where the side menu is activated
    // and store their information into session
    public function getSideDish($cid){
        $sql="SELECT sidemenu.cid, sidemenuitem.sideItemID, sidemenuitem.sid, sidedish.sname, sidedish.sdes, sidedish.sprice, sidedish.spicture FROM(sidemenu JOIN sidemenuitem ON sidemenu.sideMenuID=sidemenuitem.sideMenuID)JOIN sidedish ON sidedish.sid=sidemenuitem.sid WHERE sidemenu.cid='".$cid."'AND sidemenu.sideMenuStatus='1'";
        $query = $this->db->query($sql);

        //store each row as session value
        $_SESSION['sidedish1'] = array('name'=>$query->row(0)->sname,'price'=>$query->row(0)->sprice);
        $_SESSION['sidedish2'] = array('name'=>$query->row(1)->sname,'price'=>$query->row(1)->sprice);
        $_SESSION['sidedish3'] = array('name'=>$query->row(2)->sname,'price'=>$query->row(2)->sprice);
        $_SESSION['sidedish4'] = array('name'=>$query->row(3)->sname,'price'=>$query->row(3)->sprice);

        return $query->result();
    }


}
