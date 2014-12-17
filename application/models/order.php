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
    public function vipOrderByCard($uid,$cid,$odate,$food,$sidedish,$totalcost){
        $orderitem = array('food'=>$food,'sidedish'=>$sidedish);

        // double check if the user can use vip card to pay order
        $sql = "SELECT vbalance FROM vipcard WHERE uid='$uid'";
        $query = $this->db->query($sql);
        $result = $query->row(0);
        $balance = $result->vbalance;

        $balance -= $totalcost;

        if($balance < 0){ // balance is not enough to pay order
            return false;
        }

        $oispaid = '1';
        //update new balance of vipcard
        $sql = "UPDATE vipcard SET vbalance='".$balance."' WHERE uid='".$uid."'";
        $this->db->query($sql);

        //insert new order
        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`,`oispaid`,`totalcost`) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($oispaid).",".$this->db->escape($totalcost).") ";
        $this->db->query($sql);
        $oid = $this->db->insert_id();//get order's id

        // update the user's order-status into '1' and his phone number into new entered phone number
        $sqlOrdered = "UPDATE user SET ordered = '1' WHERE uid = '$uid'";
        $this->db->query($sqlOrdered);


        if(!empty($orderitem['food'])){//create rows of orderitems for orderitem table
            $num = count($orderitem['food']);

            $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES";

            for($i = 0 ;$i<$num;$i++){
                $sql .= "('$oid','".$orderitem['food'][$i]."','0')";
                $sql .= ($i == ($num-1))? ';' : ',';
            }
            $this->db->query($sql);
        }

        if(!empty($orderitem['sidedish'])){//count sidedish part's cost
            $num = count($orderitem['sidedish']);

            $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES";

            for($i = 0 ;$i<$num;$i++){
                $sql .= "('$oid','".$orderitem['sidedish'][$i]."','0')";
                $sql .= ($i == ($num-1))? ';' : ',';
            }
            $this->db->query($sql);
        }
        return $oid;
    }

    // generate vip order which will be paid by cash
    public function vipOrderByCash($uid,$cid,$odate,$food,$sidedish,$totalcost){
        $orderitem = array('food'=>$food,'sidedish'=>$sidedish);

        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`,`totalcost`) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($totalcost).") ";
        $this->db->query($sql);
        $oid = $this->db->insert_id();//get order's id

        // update the user's order-status into '1' and his phone number into new entered phone number
        $sqlOrdered = "UPDATE user SET ordered = '1' WHERE uid = '$uid'";
        $this->db->query($sqlOrdered);

        if(!empty($orderitem['food'])){//create rows of orderitems for orderitem table
            $num = count($orderitem['food']);

            $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES";

            for($i = 0 ;$i<$num;$i++){
                $sql .= "('$oid','".$orderitem['food'][$i]."','0')";
                $sql .= ($i == ($num-1))? ';' : ',';
            }
            $this->db->query($sql);
        }

        if(!empty($orderitem['sidedish'])){//count sidedish part's cost
            $num = count($orderitem['sidedish']);

            $sql = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES";

            for($i = 0 ;$i<$num;$i++){
                $sql .= "('$oid','".$orderitem['sidedish'][$i]."','0')";
                $sql .= ($i == ($num-1))? ';' : ',';
            }
            $this->db->query($sql);
        }
        return $oid;
    }

    /*
     * using userid, date, and the foodid the user chosed to create order for non-vip user
     */
    public function userOrder($uid,$cid,$odate,$foodId,$uphone){

        // find the food's information from food table using food's fid
        $sqlFood = "SELECT * FROM food WHERE fid='$foodId'";
        $query = $this->db->query($sqlFood);
        if($query->num_rows()!=1){
            return false;
        }
        // $query is a set of results, so it can't be used directly
        // using row(0) to get it as an array
        $food = $query->row(0);

        $totalcost = $food->fprice;

        // insert into order table a new row
        $sql = "INSERT INTO `order`(`uid`,`cid`,`odate`,`totalcost`) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($totalcost).")";
        $this->db->query($sql);

        // set the order's object's oid equal to the last insert's order's id
        $oid = $this->db->insert_id();

        //insert the order's food into orderitem table
        $sqlItem = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES(".$this->db->escape($oid).",".$this->db->escape($foodId).",'0')";
        $this->db->query($sqlItem);

        // update the user's order-status into '1' and his phone number into new entered phone number
        $sqlOrdered = "UPDATE user SET ordered = '1' AND uphone=".$this->db->escape($uphone)." WHERE uid = ".$this->db->escape($uid)."";
        $this->db->query($sqlOrdered);

        return $oid;
    }

    // find one user's all order
    public function findUserOrder($uid){
        $sql = "SELECT `order`.oid as orderNumber,`campus`.cname as campus,`order`.odate as orderDate,`order`.ostatus as isPickedup, `order`.oispaid as isPaid, `order`.totalcost as totalCost FROM `order`,`campus` WHERE `order`.cid = `campus`.cid AND `order`.uid='$uid'";

        $query = $this->db->query($sql);
        if($query->num_rows()==0){
            return false;
        }
        return $query->result();
    }
}