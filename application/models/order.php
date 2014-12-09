<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/7/2014
 * Time: 1:11 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Model {
    public  $oid;
    public $uid;
    public $cid;   //if user made two order to two different campus in a very short time, using cid will help to ditermin which order is to which campus
    public $odate;
    public $ostatus;
    public $oispaid;
    public $orderitem = array();
    public $totalcost;

//    public function __construct($uid="",$odate="",$oispaid="",$orderitem=array()){
//
//        $this->uid = $uid;
//        $this->odate = $odate;
//        $this->oispaid = $oispaid;
//        $this->ostatus = '0';
//        $this->orderitem = $orderitem;
//
//        //insert new order
//        $sql = "INSERT INTO `order`(`uid`,`odate`,`ostatus`,`oispaid`,`totalcost`) VALUES (".$this->db->escape($this->uid).",".$this->db->escape($this->odate).",".$this->db->escape($this->ostatus).",".$this->db->escape($this->oispaid).",".$this->db->escape($this->totalcost).") ";
//        $this->db->query($sql);
//        $this->oid = $this->db->insert_id();//get order's id
//
//
//        if(!empty($this->orderitem['food'])){//count food part's cost
//            $num = count($this->orderitem['food']);
//
//            $foodcost = 0;
//            for($i = 0 ;$i<$num;$i++){
//                $sql = "SELECT * FROM food WHERE fid='".$this->orderitem['food'][$i]."'";
//                $query = $this->db->query($sql);
//                $fooditem = $query->row(0);
//
//                $sql1 = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('".$this->oid."','".$this->orderitem['food'][$i]."','0') ";
//                $this->db->query($sql1);
//
//                $foodcost += $fooditem->fprice;
//            }
//        }else $foodcost = 0;
//
//        if(!empty($this->orderitem['sidedish'])){//count sidedish part's cost
//            $num = count($this->orderitem['sidedish']);
//
//            $sidedishcost = 0;
//            for($i = 0 ;$i<$num;$i++){
//                $sql = "SELECT * FROM sidedish WHERE sid='".$this->orderitem['sidedish'][$i]."'";
//                $query = $this->db->query($sql);
//                $sidedishitem = $query->row(0);
//
//                $sql1 = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('".$this->oid."','".$this->orderitem['sidedish'][$i]."','1') ";
//                $this->db->query($sql1);
//
//                $sidedishcost += $sidedishitem->sprice;
//            }
//        }else $sidedishcost = 0;
//
//        // count total cost of an order
//        $this->totalcost = $foodcost + $sidedishcost;
//
//        return $this;
//    }


    /*
     * using userid, date, and the foodid the user chosed to create order for non-vip user
     */
    public function userOrder($uid,$cid,$odate,$orderItemId){
        // set order object's properties' known values
        $this->uid = $uid;
        $this->cid = $cid;
        $this->odate = $odate;
        $this->orderitem = $orderItemId;

        // insert into order table a new row
        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`) VALUES (".$this->db->escape($this->uid).",".$this->db->escape($this->cid).",".$this->db->escape($this->odate).")";
        $this->db->query($sql);

        // set the order's object's oid equal to the last insert's order's id
        $this->oid = $this->db->insert_id();

        // find the food's information from food table using food's fid
        $sqlFood = "SELECT * FROM food WHERE fid='".$this->orderitem."'";
        $query = $this->db->query($sqlFood);

        // $query is a set of results, so it can't be used directly
        // using row(0) to get it as an array
        $food = $query->row(0);

        // get the food's price and asign it's value to the order's total cost
        $this->totalcost = $food->fprice;

        //insert the order's food into orderitem table
        $sqlItem = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES(".$this->db->escape($this->oid).",".$this->db->escape($food->fid).",'0')";
        $this->db->query($sqlItem);

        // update the totalcost's value which is just inserted into order table
        $sqlCost = "UPDATE `order` SET `totalcost`='".$this->totalcost."' WHERE `oid`='".$this->oid."'";
        $this->db->query($sqlCost);

        // update the user's order-status into '1'
        $sqlOrdered = "UPDATE user SET ordered = '1' WHERE uid = '".$this->uid."'";
        $this->db->query($sqlOrdered);

        return $this;
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