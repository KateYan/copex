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
        $this->did = $did;
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
        $result= array_merge($result1[0],$d_campus);

        return $result;
    }


    // find all diner
    public function allDiners(){
        $sql = "SELECT * FROM diner";
        $query = $this->db->query($sql);

        return $query->result();
    }
}