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
        $sql="SELECT menuitem.fid, food.fname, food.fdes, food.fprice, food.fpicture FROM(dailymenu JOIN menuitem ON dailymenu.mid=menuitem.mid)JOIN food ON food.fid=menuitem.fid WHERE dailymenu.cid='".$cid."'AND menuitem.isrecomd='0' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);
        if($query->num_rows()==2){
            return $query->result();
        }
        return false;
    }

    // select all sidemenu item from database where the side menu is activated
    // and store their information into session
    public function getSideDish($cid){
        $sql="SELECT sidemenu.cid, sidemenuitem.sideItemID, sidemenuitem.sid, sidedish.sname, sidedish.sdes, sidedish.sprice, sidedish.spicture FROM(sidemenu JOIN sidemenuitem ON sidemenu.sideMenuID=sidemenuitem.sideMenuID)JOIN sidedish ON sidedish.sid=sidemenuitem.sid WHERE sidemenu.cid='".$cid."'AND sidemenu.sideMenuStatus='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }



     // store session for menu-dishes
    public function storeFoodInSession($recomdItem,$saleItem){
        $_SESSION['food1'] = array('id' => $recomdItem->fid, 'name' => $recomdItem->fname, 'price' => $recomdItem->fprice);

        $_SESSION['food2'] = array('id' => $saleItem[0]->fid, 'name' => $saleItem[0]->fname, 'price' => $saleItem[0]->fprice);

        $_SESSION['food3'] = array('id' => $saleItem[1]->fid, 'name' => $saleItem[1]->fname, 'price' => $saleItem[1]->fprice);

    }

    // store session for sidedishes
    public function storeSidedishInSession($sideDish){
        for ($i = 1; $i <= 4 ; $i++) {
            $j = $i-1;
            $_SESSION["sidedish$i"] = array('id'=>$sideDish[$j]->sid, 'name'=>$sideDish[$j]->sname,'price'=>$sideDish[$j]->sprice);
        }
    }
}
