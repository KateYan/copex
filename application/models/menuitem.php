<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menuitem extends CI_Model {
    public  $mitemid;
    public  $fid;
    public $cid;
    public $fname;
    public $fdes;
    public $fprice;
    public  $fpicture;
    public  $isrecomd;

    public function recommend($cid){
//        $date=date('Y-m-d');
        $sql="SELECT menuitem.mitemid as mitemid, menuitem.isrecomd as isrecomd, food.fid as fid,food.fname as fname, food.fdes as fdes, food.fprice as fprice, food.fpicture as fpicture FROM  menuitem JOIN food ON dailymenu.mid=menuitem.mid AND menuitem.fid=food.fid WHERE dailymenu.cid='".$cid."' AND menuitem.isrecomd='1' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);

        if($query->num_rows()==1){
            $recommond=$query->row(0);

            $this->mitemid=$recommond->mitemid;
            $this->fid=$recommond->fid;
            $this->cid=$cid;
            $this->fname=$recommond->fname;
            $this->fdes=$recommond->fdes;
            $this->fprice=$recommond->fprice;
            $this->fpicture=$recommond->fpicture;

            return $this;
        }return false;
    }

    public function saleitem($cid){
        $sql="SELECT dailymenu.mid, menuitem.mitemid, menuitem.isrecomd, food.* FROM dailymenu JOIN menuitem JOIN food ON dailymenu.mid=menuitem.mid AND menuitem.fid=food.fid WHERE dailymenu.cid='".$cid."' AND menuitem.isrecomd='0' AND dailymenu.mstatus='1'";
        $query=$this->db->query($sql);
        if($query->num_rows()==2){
            return $query->result();
        }return false;
    }


}
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:51 PM
 */ 