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

    // create new menu
    public function newMenu($date,$cid,$recommend,$onsale1,$onsale2){
        $sql_menu = "INSERT INTO dailymenu(cid,mdate,mstatus) VALUES('$cid','$date','0')";
        $this->db->query($sql_menu);

        $menuId = $this->db->insert_id();

        // insert menuitems
        $sql_menuitem = "INSERT INTO menuitem(fid, mid, isrecomd) VALUES('$recommend','$menuId','1'),('$onsale1','$menuId','0'),('$onsale2','$menuId','0')";

        $this->db->query($sql_menuitem);

    }

    // create new side menu
    public function newSideMenu($date,$cid,$sideMenuList){

        $sql_sideMenu = "INSERT INTO sidemenu(cid,sideMenuDate,sideMenuStatus) VALUES('$cid','$date','0')";
        $this->db->query($sql_sideMenu);

        $sideMenuId = $this->db->insert_id();
        $num = count($sideMenuList);
        $sql_sidemenuitem = "INSERT INTO sidemenuitem(sid, sideMenuID) VALUES";

        for($i = 0;$i<$num; $i++){
            $sql_sidemenuitem .= "('$sideMenuList[$i]','$sideMenuId')";
            $sql_sidemenuitem .= ($i == ($num-1))? ';' : ',';
        }
        $this->db->query($sql_sidemenuitem);
    }


    // get menu items
    public function getMenuItems($menuId){
        $sql = "SELECT menuitem.isrecomd,menuitem.fid,menuitem.minventory,food.fname, food.fprice FROM menuitem JOIN food ON menuitem.fid = food.fid WHERE menuitem.mid =$menuId ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    // get side menu items
    public function getSideMenuItems($sideMenuId){
        $sql = "SELECT sidemenuitem.sid, sidemenuitem.sinventory,sidedish.sname, sidedish.sprice FROM sidemenuitem JOIN sidedish ON sidemenuitem.sid = sidedish.sid WHERE sidemenuitem.sideMenuID =$sideMenuId ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    // update meuitem inventory
    public function updateMenuInventory($menuId,$food){
        $num = count($food);
        for($i=0;$i<$num;$i++){
            $fid = $food[$i]['fid'];
            $inventory = $food[$i]['inventory'];
            $sql = "UPDATE menuitem SET minventory='$inventory'WHERE mid='$menuId' AND fid = '$fid'";
            $this->db->query($sql);
        }
    }

    //
    public function updateSideMenuInventory($menuId,$side){
        $num = count($side);
        for($i=0;$i<$num;$i++){
            $sid = $side[$i]['fid'];
            $inventory = $side[$i]['inventory'];
            $sql = "UPDATE sidemenuitem SET sinventory='$inventory'WHERE sideMenuID='$menuId' AND sid = '$sid'";
            $this->db->query($sql);
        }
    }

    // delete not using daily menu
    public function deleteMenu($menuId){
        $sql = "DELETE FROM dailymenu WHERE mid=$menuId";
        $this->db->query($sql);
    }

    //delete not using side menu
    public function deleteSideMenu($menuId){
        $sql = "DELETE FROM sidemenu WHERE sideMenuID=$menuId";
        $this->db->query($sql);
    }

    // check food status
    public function checkFoodStatus($foodId){
        // find inuse menu
        $sql = "SELECT mid FROM dailymenu WHERE mstatus=1";
        $query = $this->db->query($sql);
        $menus = $query->result();

        foreach($menus as $menu){
            $sql_food = "SELECT fid FROM menuitem WHERE mid=$menu->mid";
            $query_food = $this->db->query($sql_food);
            $foods = $query_food->result();

            foreach($foods as $food ){
                if($food->fid == $foodId){
                    return false;
                }
            }
        }
        return true;
    }

    // check side dish status
    public function checkSideDishStatus($sideId){
        // find inuse menu
        $sql = "SELECT sideMenuID FROM sidemenu WHERE sideMenuStatus=1";
        $query = $this->db->query($sql);
        $menus = $query->result();

        foreach($menus as $menu){
            $sql_side = "SELECT sid FROM sidemenuitem WHERE sideMenuID=$menu->sideMenuID";
            $query_side = $this->db->query($sql_side);
            $sides = $query_side->result();

            foreach($sides as $side ){
                if($side->sid == $sideId){
                    return false;
                }
            }
        }
        return true;
    }

    // delete food
    public function deleteFood($foodId){
        $sql = "DELETE FROM food WHERE fid = $foodId";
        $this->db->query($sql);
    }

    // delete sidedish
    public function deleteSideDish($sideId){
        $sql = "DELETE FROM sidedish WHERE sid = $sideId";
        $this->db->query($sql);
    }
}
