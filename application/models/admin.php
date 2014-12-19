<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/18/2014
 * Time: 9:49 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Model {
    /*
     *  vailidate entered admin user name
     */
    public function validateAdmin($username){
        $sql = "SELECT * FROM admin WHERE adminName='$username'";
        $query = $this->db->query($sql);

        if($query->num_rows()==1){// exit one admin user
            return true;
        }return false;// user name doesn't exit
    }
    /*
     * validate entered admin user's password
     */
    public function validatePassword($username,$password){
        $sql = "SELECT * FROM admin WHERE adminName='$username' AND adminPassword='$password'";
        $query = $this->db->query($sql);

        if($query->num_rows()==1){// exit one admin user
            return true;
        }return false;// user password isn't right
    }
}