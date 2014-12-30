<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/30/2014
 * Time: 11:56 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CoperationLine extends CI_Model
{
    // create more corperation line
    public function createLineByDiner($did,$addCampus){
        $num = count($addCampus);

        $sql = "INSERT INTO coperationline(did,cid) VALUES";

        for($i = 0 ;$i<$num;$i++){
            // renew cid session
            $sql .= "('$did','$addCampus[$i]')";
            $sql .= ($i == ($num-1))? ';' : ',';
        }
        $this->db->query($sql);
    }
    // delete coperation line
    public function deleteLineByDiner($did,$deleteCampus){
        $num = count($deleteCampus);

        $sql = "DELETE FROM coperationline WHERE did='$did' AND cid IN (";

        for($i = 0 ;$i<$num;$i++){
            $sql .= "'$deleteCampus[$i]'";
            $sql .= ($i == ($num-1))? ')' : ',';
        }
        $this->db->query($sql);
    }

    // create line by using campus id
    public function createLineByCampus($cid,$addDiner){
        $num = count($addDiner);

        $sql = "INSERT INTO coperationline(did,cid) VALUES";

        for($i = 0 ;$i<$num;$i++){
            // renew cid session
            $sql .= "('$addDiner[$i]','$cid')";
            $sql .= ($i == ($num-1))? ';' : ',';
        }
        $this->db->query($sql);
    }

    // delete coperation line by using campus' id
    public function deleteLineByCampus($cid,$removeDiner){
        $num = count($removeDiner);

        $sql = "DELETE FROM coperationline WHERE cid='$cid' AND did IN (";

        for($i = 0 ;$i<$num;$i++){
            $sql .= "'$removeDiner[$i]'";
            $sql .= ($i == ($num-1))? ')' : ',';
        }
        $this->db->query($sql);
    }
}