<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/7/2014
 * Time: 1:11 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Model {

// generating vip user's order by using uid
    public function vipOrder($uid,$cid,$odate,$food,$sidedish,$totalcost){

        $ostatus = '0';
        $orderitem = array('food'=>$food,'sidedish'=>$sidedish);

        // double check if the user can use vip card to pay order
        $sql = "SELECT vbalance FROM vipcard WHERE uid='$uid'";
        $query = $this->db->query($sql);
        $result = $query->row(0);
        $balance = $result->vbalance;

        if($balance < $totalcost){ // balance is not enough to pay order
            return false;
        }

        $oispaid = '1';
        //update new balance of vipcard
        $balance -= $totalcost;
        $sql = "UPDATE vipcard SET vbalance='".$balance."' WHERE uid='".$uid."'";
        $this->db->query($sql);

        //insert new order
        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`,`ostatus`,`oispaid`,`totalcost`) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($ostatus).",".$this->db->escape($oispaid).",".$this->db->escape($totalcost).") ";
        $this->db->query($sql);
        $oid = $this->db->insert_id();//get order's id


        if(!empty($orderitem['food'])){//create rows of orderitems for orderitem table
            $num = count($orderitem['food']);

            for($i = 0 ;$i<$num;$i++){
                $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('$oid','".$orderitem['food'][$i]."','0') ";
                $this->db->query($sql);
            }
        }

        if(!empty($orderitem['sidedish'])){//count sidedish part's cost
            $num = count($orderitem['sidedish']);

            for($i = 0 ;$i<$num;$i++){
                $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('$oid','".$orderitem['sidedish'][$i]."','1') ";
                $this->db->query($sql);
            }
        }
        return $oid;
    }


    /*
     * using userid, date, and the foodid the user chosed to create order for non-vip user
     */
    public function userOrder($uid,$cid,$odate,$orderItemId,$uphone){

        // insert into order table a new row
        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).")";
        $this->db->query($sql);

        // set the order's object's oid equal to the last insert's order's id
        $oid = $this->db->insert_id();

        // find the food's information from food table using food's fid
        $sqlFood = "SELECT * FROM food WHERE fid='$orderItemId'";
        $query = $this->db->query($sqlFood);

        // $query is a set of results, so it can't be used directly
        // using row(0) to get it as an array
        $food = $query->row(0);

        // get the food's price and asign it's value to the order's total cost
        $totalcost = $food->fprice;

        //insert the order's food into orderitem table
        $sqlItem = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES(".$this->db->escape($oid).",".$this->db->escape($orderItemId).",'0')";
        $this->db->query($sqlItem);

        // update the totalcost's value which is just inserted into order table
        $sqlCost = "UPDATE `order` SET `totalcost`='$totalcost' WHERE `oid`='$oid'";
        $this->db->query($sqlCost);

        // update the user's order-status into '1' and his phone number into new entered phone number
        $sqlOrdered = "UPDATE user SET ordered = '1' AND uphone='$uphone' WHERE uid = '$uid'";
        $this->db->query($sqlOrdered);

        return $oid;
    }


    //if $name is property of order class then set value to it
    public function __set($name,$value){
        if(isset($this->$name)){
            $this->$name = $value;
        }
    }

//    // if the properties are private
//    // __get() will help to show the propertie's value asusual
//    public function __get($name){
//        if(isset($this->$name)){
//            return $this->$name;
//        }
//    }
}