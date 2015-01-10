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
}