<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/10/2015
 * Time: 2:44 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vipcard extends CI_Model {

    public function findAllCards(){
        $sql = "SELECT vipcard.*, `user`.uid FROM vipcard LEFT JOIN `user` ON vipcard.vipid=`user`.vipid";

        $query = $this->db->query($sql);
        $vipcards = $query->result();
        return $vipcards;
    }

    // find card
    public function findCardById($vipCardId){
        $sql = "SELECT vipcard.*, `user`.uid FROM vipcard LEFT JOIN `user` ON vipcard.vipid=`user`.vipid WHERE vipcard.vipid=$vipCardId";

        $query = $this->db->query($sql);
        $vipcard = $query->row(0);
        return $vipcard;
    }
    // update vip card's info
    public function updateVipCard($vipId,$columnName,$value){
        $num = count($columnName);

        $sql = "UPDATE vipcard SET ";
        for($i=0;$i<$num;$i++){
            $name = $columnName[$i];
            $sql .= "$name=".$this->db->escape($value[$name])."";
            $sql .= ($i == ($num-1))? "WHERE vipid=$vipId;" : ',';
        }
        $this->db->query($sql);
    }

    // create new vip card
    public function newCard($value){

        $sql = "INSERT INTO vipcard(vnumber,vbalance,vpassword) VALUES(".$this->db->escape($value['vnumber']).",".$this->db->escape($value['vbalance']).",".$this->db->escape($value['vpassword']).") ";

        $this->db->query($sql);

        $vipCardId = $this->db->insert_id();

        return $vipCardId;
    }
    // find vip card by number
    public function findVipCardByNumber($vnumber){
        $sql = "SELECT vipcard.*, `user`.uid FROM vipcard LEFT JOIN `user` ON vipcard.vipid=`user`.vipid WHERE vipcard.vnumber='$vnumber'";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0){
            return false;
        }
        $vipcard = $query->row(0);
        return $vipcard;
    }

}