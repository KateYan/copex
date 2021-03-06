<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/21/2014
 * Time: 3:47 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Diner extends CI_Model
{
    // find diner with diner id
    public function findDiner($did){
        $sql1 = "SELECT * FROM diner WHERE did = '$did'";
        $query1 = $this->db->query($sql1);
        $result1 = $query1->result_array();

        $d_campus = array(
            'cid'=>array(),
            'cname'=>array()
        );

        $sql2 = "SELECT coperationline.*,campus.cname FROM (coperationline JOIN campus ON coperationline.cid = campus.cid)JOIN diner ON coperationline.did = diner.did WHERE diner.did = '$did'";
        $query2 = $this->db->query($sql2);
        foreach($query2->result() as $line){
            $d_campus['cid'][] = $line->cid;
            $d_campus['cname'][] = $line->cname;
        }
        $diner = array_merge($result1[0],$d_campus);

        $_SESSION['diner'] = $diner;
    }

    // create new diner
    public function newDiner($value){
        $sql = "INSERT INTO diner(dname,contact,dphone,demail,daddr,dinfo) VALUES (".$this->db->escape($value['dname']).",".$this->db->escape($value['contact']).",".$this->db->escape($value['dphone']).",".$this->db->escape($value['demail']).",".$this->db->escape($value['daddr']).",".$this->db->escape($value['dinfo']).")";

        $this->db->query($sql);
        $dinerId = $this->db->insert_id(); // get new diner's id
        return $dinerId;
    }

    // update diner
    public function updateDiner($did,$columnName,$value){
        $num = count($columnName);
        for($i = 0;$i < $num;$i++){
            $name = $columnName[$i];
            $sql = "UPDATE diner SET $name=".$this->db->escape($value[$name])." WHERE did=$did";

            $this->db->query($sql);
        }
    }

    // find all diner
    public function allDiners(){
        $sql = "SELECT * FROM diner";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // check diner status
    public function checkDinerStatus($did){
        // find in use menu first
        $sql = "SELECT mid FROM dailymenu WHERE mstatus=1";
        $query = $this->db->query($sql);
        $memus = $query->result();

        foreach($memus as $menu){
            // find menuitem's fid
            $sql_food = "SELECT fid FROM menuitem WHERE mid=$menu->mid";
            $query_food = $this->db->query($sql_food);
            $foods = $query_food->result();

            foreach($foods as $food){
                // find food's diner
                $sql_diner = "SELECT did FROM food WHERE fid=$food->fid";
                $query_diner = $this->db->query($sql_diner);
                $diners = $query_diner->result();

                foreach($diners as $diner){
                    if($diner->did == $did){
                        return false;
                    }
                }
            }
        }

        // find in use menu first
        $sql = "SELECT sideMenuID FROM sidemenu WHERE sideMenuStatus=1";
        $query = $this->db->query($sql);
        $memus = $query->result();

        foreach($memus as $menu){
            // side dish menuitem's fid
            $sql_side = "SELECT sid FROM sidemenuitem WHERE sideMenuID=$menu->sideMenuID";
            $query_side = $this->db->query($sql_side);
            $sides = $query_side->result();

            foreach($sides as $side){
                // find sidedish's diner
                $sql_diner = "SELECT did FROM sidedish WHERE sid=$side->sid";
                $query_diner = $this->db->query($sql_diner);
                $diners = $query_diner->result();

                foreach($diners as $diner){
                    if($diner->did == $did){
                        return false;
                    }
                }
            }
        }
        // no match means the diner is safe to be deleted
        return true;
    }

    // delete diner
    public function deleteDiner($did){
        $sql = "DELETE FROM diner WHERE did = '$did'";
        $this->db->query($sql);
        // because did is also table coperationline's foreign key with on delete cascate
        // so there is no need to delete related rows from coperationline
    }

}