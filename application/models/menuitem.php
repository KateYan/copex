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


}
