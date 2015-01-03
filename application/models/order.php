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
    public function vipOrderByCard($uid,$vipid,$cid,$odate,$fordate,$food,$sidedish,$totalCost_beforTax,$foodItem,$sideDishItem){
        $orderitem = array('food'=>$food,'sidedish'=>$sidedish);

        // double check if the user can use vip card to pay order
        $sql = "SELECT vbalance FROM vipcard WHERE vipid='$vipid'";
        $query = $this->db->query($sql);
        $result = $query->row(0);
        $balance = $result->vbalance;
        $totalCost = round($totalCost_beforTax*1.13,2);
        $tax = round($totalCost_beforTax*0.13,2);

        $balance -= $totalCost;

        if($balance < 0){ // balance is not enough to pay order
            return false;
        }
        $oispaid = '1';

        // check inventory first
        // 1. checkfood inventory
        $num_food = count($foodItem);
        for($i=0;$i<$num_food;$i++){
            $inventory_food = $this->checkFoodInventory($cid,$foodItem[$i]['id'],$foodItem[$i]['amount']);
            if(!$inventory_food){
                return false;
            }
        }
        // 2. check sidedish inventory
        $num_sidedish = count($sideDishItem);
        for($i=0;$i<$num_sidedish;$i++){
            $inventory_sidedish = $this->checkSidedishInventory($cid,$sideDishItem[$i]['id'],$sideDishItem[$i]['amount']);
            if(!$inventory_sidedish){
                return false;
            }
        }

        //insert new order
        $sql = "INSERT INTO `order`(uid,cid,odate,fordate,oispaid,tax,totalcost) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($fordate).",".$this->db->escape($oispaid).",".$this->db->escape($tax).",".$this->db->escape($totalCost).") ";
        $this->db->query($sql);
        $oid = $this->db->insert_id();//get order's id


        //update new balance of vipcard
        $sql = "UPDATE vipcard SET vbalance='$balance' WHERE vipid='$vipid'";
        $this->db->query($sql);

        // 1. update the menuitem's inventory
        $food_num = count($foodItem);
        for($i=0;$i<$food_num;$i++){
            $this->updateMenuItemInventory($cid,$foodItem[$i]['id'],$inventory_food,$foodItem[$i]['amount']);
        }
        // 2. update the sidemenuitem's inventory
        $sidedish_num = count($sideDishItem);
        for($i=0;$i<$sidedish_num;$i++){
            $this->updateSideMenuItemInventory($cid,$sideDishItem[$i]['id'],$inventory_sidedish,$sideDishItem[$i]['amount']);
        }

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
                $sql .= "('$oid','".$orderitem['sidedish'][$i]."','1')";
                $sql .= ($i == ($num-1))? ';' : ',';
            }
            $this->db->query($sql);
        }
        return $oid;
    }


    /*
     * using userid, date, and the foodid the user chosed to create order for non-vip user
     */
    public function userOrder($uid,$cid,$odate,$fordate,$foodId,$uphone){

        // find the food's information from food table using food's fid
        $sqlFood = "SELECT * FROM food WHERE fid='$foodId'";
        $query = $this->db->query($sqlFood);
        if($query->num_rows()!=1){
            return false;
        }
        // $query is a set of results, so it can't be used directly
        // using row(0) to get it as an array
        $food = $query->row(0);
        $tax = round($food->fprice * 0.13,2);

        $totalcost = round($food->fprice + $tax,2);

        // check inventory befor make order
        $amount=1;
        $inventory = $this->checkFoodInventory($cid,$foodId,$amount);
        if(!$inventory){
            return false;
        }
        // insert into order table a new row
        $sql = "INSERT INTO `order`(uid,cid,odate,fordate,tax,totalcost) VALUES (".$this->db->escape($uid).",".$this->db->escape($cid).",".$this->db->escape($odate).",".$this->db->escape($fordate).",".$this->db->escape($tax).",".$this->db->escape($totalcost).")";
        $this->db->query($sql);

        // set the order's object's oid equal to the last insert's order's id
        $oid = $this->db->insert_id();

        //insert the order's food into orderitem table
        $sqlItem = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES(".$this->db->escape($oid).",".$this->db->escape($foodId).",'0')";
        $this->db->query($sqlItem);

        // update the menuitem's inventory
        $this->updateMenuItemInventory($cid,$foodId,$inventory,$amount);

        // update the user's order-status into '1' and his phone number into new entered phone number
        $sqlOrdered = "UPDATE `user` SET `uphone` = '$uphone', `ordered`='1' WHERE `uid` ='$uid'";
        $this->db->query($sqlOrdered);

        return $oid;
    }
    // update menuitem inventory
    public function updateMenuItemInventory($cid,$foodId,$inventory,$amount){
        $inventory -= $amount;
        // find the menu id
        $sql_menu = "SELECT mid FROM dailymenu WHERE cid='$cid' AND mstatus='1'";
        $query_menu = $this->db->query($sql_menu);
        $result_menu = $query_menu->result();
        $menuId = $result_menu[0]->mid;
        // update inventory
        $sql_inven_update = "UPDATE menuitem SET minventory='$inventory' WHERE fid ='$foodId' AND mid='$menuId'";
        $this->db->query($sql_inven_update);
        $num = $this->db->affected_rows();
        if($num == 1){
            return true;
        }
        return false;
    }

    // update sidedishmenuitem inventory
    public function updateSideMenuItemInventory($cid,$sidedishId,$inventory,$amount){
        $inventory -= $amount;
        // find the menu id
        $sql_menu = "SELECT sideMenuID FROM sidemenu WHERE cid='$cid' AND sideMenuStatus='1'";
        $query_menu = $this->db->query($sql_menu);
        $result_menu = $query_menu->result();
        $menuId = $result_menu[0]->sideMenuID;
        // update inventory
        $sql_inven_update = "UPDATE sidemenuitem SET sinventory='$inventory' WHERE sid ='$sidedishId' AND sideMenuID='$menuId'";
        $this->db->query($sql_inven_update);
        $num = $this->db->affected_rows();
        if($num == 1){
            return true;
        }
        return false;
    }



    // menuitem inventory check
    public function checkFoodInventory($cid,$foodId,$amount){

        $sql = "SELECT menuitem.minventory FROM menuitem JOIN dailymenu ON menuitem.mid=dailymenu.mid WHERE dailymenu.cid='$cid' AND dailymenu.mstatus='1' AND menuitem.fid ='$foodId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        $num = $query->num_rows();
        if($num < $amount){
            return false;
        }
        return $result[0]->minventory;
    }

    // sidemenu inventory check
    public function checkSidedishInventory($cid,$sidedishId,$amount){
        $sql = "SELECT sidemenuitem.sinventory FROM sidemenuitem JOIN sidemenu ON sidemenuitem.sideMenuID=sidemenu.sideMenuID WHERE sidemenu.cid='$cid' AND sidemenu.sideMenuStatus='1' AND sidemenuitem.sid ='$sidedishId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        $num = $query->num_rows();
        if($num < $amount){
            return false;
        }
        return $result[0]->sinventory;
    }

    // find one user's order
    public function findUserOrder($uid,$today,$tomorrow){

        $sql = "SELECT `order`.* ,`campus`.cname ,campus.caddr,food.* FROM ((`order` JOIN `campus` ON `order`.cid = `campus`.cid) JOIN orderitem ON `order`.oid = orderitem.oid) JOIN food ON orderitem.dishid=food.fid WHERE `order`.uid='$uid' AND `order`.fordate IN ('$today','$tomorrow')";

        $query = $this->db->query($sql);
        if($query->num_rows()==0){
            return false;
        }
        return $query->result();
    }
    // find vip user's order
    public function findVipOrder($uid,$today,$tomorrow){
        // find order first
        $sql = "SELECT `order`.* ,`campus`.cname ,campus.caddr FROM `order` JOIN `campus` ON `order`.cid = `campus`.cid WHERE `order`.uid='$uid' AND `order`.fordate IN ('$today','$tomorrow')";
        $query = $this->db->query($sql);
        if($query->num_rows()==0){
            return false;
        }
        $result = $query->result();
        // then find orderitem
        $orders = array();
        foreach($result as $order){

            $oid = $order->oid;
            // find food first
            $food = array();

            $sql_food = "SELECT food.* FROM food JOIN orderitem ON food.fid = orderitem.dishid WHERE orderitem.oid='$oid' AND orderitem.dishtype='0'";
            $query_food = $this->db->query($sql_food);
            $result_food = $query_food->result();
            foreach($result_food as $food_item){
                $food[] = $food_item;
            }

            // then find sidedish
            $sidedish = array();

            $sql_sidedish = "SELECT sidedish.* FROM sidedish JOIN orderitem ON sidedish.sid = orderitem.dishid WHERE orderitem.oid='$oid' AND orderitem.dishtype='1'";
            $query_sidedish = $this->db->query($sql_sidedish);

            if($query_sidedish->num_rows() != 0){
                $result_sidedish = $query_sidedish->result();

                foreach($result_sidedish as $sidedish_item){
                    $sidedish[] = $sidedish_item;
                }
            }
            // put info together
            $orders[] = array('order'=>$order,'food'=>$food,'sidedish'=>$sidedish);

        }
        return $orders;


    }

    // check if user has already ordered in the same day
    public function orderToday($uid,$now,$orderStart){
        $sql = "SELECT * FROM `order` WHERE `odate` < '$now' AND `odate` >= '$orderStart' AND uid='$uid'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return false;
        }return true;
    }
    /*
     *
     *
     * Functions below are used for admin control
     *
     *
     *
     */
    // for admin to mange orders from one campus orders that are needed to prepare
    public function getOrdersByCampusDate($campusId,$date){
        $sql = "SELECT `order`.oid as orderNumber,`order`.oispaid as isPaid,`order`.ostatus as isPickedup,`campus`.cname as campus,`order`.fordate as forDate,`order`.odate as orderDate,`order`.totalcost as totalCost,`user`.uphone as userPhone,`user`.vipid as vipId,`user`.uid as userId, vipcard.vnumber as cardNumber FROM ((`order`JOIN campus ON `order`.cid = `campus`.cid) JOIN `user` ON  `order`.uid = `user`.uid) LEFT JOIN vipcard ON `user`.vipid = vipcard.vipid WHERE `order`.fordate='$date' AND `order`.cid='$campusId' ORDER BY `order`.odate DESC, `user`.uid DESC";

        $query = $this->db->query($sql);
        if($query->num_rows()==0){
            return false;
        }
        return $query->result();
    }

    // find all orders to show order history for user
    public function getAllOrdersByCampus($campusId){
        $sql = "SELECT `order`.oid as orderNumber,`order`.oispaid as isPaid,`order`.ostatus as isPickedup,`campus`.cname as campus,`order`.fordate as forDate,`order`.odate as orderDate,`order`.totalcost as totalCost,`user`.uphone as userPhone,`user`.vipid as vipId,`user`.uid as userId, vipcard.vnumber as cardNumber FROM ((`order` JOIN campus ON `order`.cid = `campus`.cid) JOIN `user` ON  `order`.uid = `user`.uid) LEFT JOIN vipcard ON `user`.vipid = vipcard.vipid  WHERE `order`.cid='$campusId' ORDER BY `order`.odate DESC,`user`.uid DESC";

        $query = $this->db->query($sql);
        if($query->num_rows()==0){
            return false;
        }
        return $query->result();
    }

    // find order's food's detail
    public function orderFoodDetail($orderId){
    $sql = "SELECT `order`.*,campus.cname, `user`.uid,`user`.uphone,`user`.vipid,orderitem.dishtype,food.fname,food.fprice,diner.dname FROM (((((`order` JOIN campus ON `order`.cid=campus.cid)JOIN `user` ON `order`.uid=`user`.uid)JOIN orderitem ON `order`.oid=orderitem.oid) JOIN food ON orderitem.dishid=food.fid) JOIN diner ON food.did=diner.did)WHERE orderitem.dishtype='0' AND order.oid='$orderId'";

        $query = $this->db->query($sql);
        return $query->result();
    }
    // find order's sidedishes' detail
    public function orderSidedishDetail($orderId){
        $sql = "SELECT `order`.*,campus.cname, `user`.uid,`user`.uphone,`user`.vipid,orderitem.dishtype,sidedish.sname,sidedish.sprice,diner.dname FROM (((((`order` JOIN campus ON `order`.cid=campus.cid)JOIN `user` ON `order`.uid=`user`.uid)JOIN orderitem ON `order`.oid=orderitem.oid) JOIN sidedish ON orderitem.dishid=sidedish.sid) JOIN diner ON sidedish.did=diner.did)WHERE orderitem.dishtype='1' AND order.oid='$orderId'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    // update order properties(oispaid & ostatus)
    public function updateOrder($orderIdList,$columnName){
        $num = count($orderIdList);
        for($i=0;$i<$num;$i++){
            $sql = "UPDATE `order` SET $columnName='1' WHERE oid ='$orderIdList[$i]'";
            $this->db->query($sql);
        }
    }

}