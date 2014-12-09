<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/9/2014
 * Time: 1:35 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rules extends CI_Model {
    public  $ruleid;
    public $rulename;
    public $timestart;
    public $timeend;
    public $date;
    public $risvip;

    // using rules'name and date to get rule object contain a time range for user to pickup
    public function getPickupTime($name,$date){
        $sql = "SELECT * FROM basicrule WHERE rulename='".$name."' AND date='".$date."'";
        $query = $this->db->query($sql);
        // if the rule exists
        if($query->num_rows()==1){
            $rule = $query->row(0);
            $this->ruleid = $rule->ruleid;
            $this->rulename = $rule->rulename;
            $this->timestart = $rule->timestart;
            $this->timeend = $rule->timeend;
            $this->date = $rule->date;
            $this->risvip = $rule->risvip;

            return $this;
        }return false;//if the rule doesn't exist then return false
    }


    // using the time of user clicking "order confirm" button to check if the user is allowed to order at that time
    public function validateOrderTime($time){

    }

}