<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:51 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menuitem extends CI_Model {
    public  $mitemid;
    public  $fid;
    public $cid;
    public $fname;
    public $fdes;
    public $fprice;
    public  $fpicture;
    public  $isrecomd;

    /*
     * using cid and date and status to choose one recommend menu-item
     */

    public function recomdItem($cid,$date){
        $sql="SELECT dailymenu.cid as cid, menuitem.mitemid as mitemid, menuitem.fid as fid, food.fname as fname, food.fdes as fdes, food.fprice as fprice, food.fpicture as fpicture FROM(dailymenu JOIN menuitem ON dailymenu.mid=menuitem.mid)JOIN food ON food.fid=menuitem.fid WHERE dailymenu.cid='".$cid."'AND dailymenu.mdate='".$date."'AND menuitem.isrecomd='1' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);

        if($query->num_rows()==1){
            $recomdItem=$query->row(0);

            $this->mitemid=$recomdItem->mitemid;
            $this->fid=$recomdItem->fid;
            $this->cid=$cid;
            $this->fname=$recomdItem->fname;
            $this->fdes=$recomdItem->fdes;
            $this->fprice=$recomdItem->fprice;
            $this->fpicture=$recomdItem->fpicture;

            return $this;
        }return false;
    }
/*
 * using cid and date and status to choose two on-sale menu-items
 */
    public function saleItem($cid,$date){
        $sql="SELECT dailymenu.cid, menuitem.mitemid, menuitem.fid, food.fname, food.fdes, food.fprice, food.fpicture FROM(dailymenu JOIN menuitem ON dailymenu.mid=menuitem.mid)JOIN food ON food.fid=menuitem.fid WHERE dailymenu.cid='".$cid."'AND dailymenu.mdate='".$date."' AND menuitem.isrecomd='0' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);
        if($query->num_rows()==2){
            return $query->result();
        }return false;
    }


}
