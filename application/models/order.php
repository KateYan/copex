<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/7/2014
 * Time: 1:11 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Model {
    private $oid;
    private $uid;
    private $odate;
    private $ostatus;
    private $oispaid;
    private $orderitem = array();
    private $totalcost;

    public function __construct($uid="",$odate="",$oispaid="",$orderitem=array()){


        $this->uid = $uid;
        $this->odate = $odate;
        $this->oispaid = $oispaid;
        $this->ostatus = '0';
        $this->orderitem = $orderitem;

        //insert new order
        $sql = "INSERT INTO `order`(`uid`,`odate`,`ostatus`,`oispaid`,`totalcost`) VALUES (".$this->db->escape($this->uid).",".$this->db->escape($this->odate).",".$this->db->escape($this->ostatus).",".$this->db->escape($this->oispaid).",".$this->db->escape($this->totalcost).") ";
        $this->db->query($sql);
        $this->oid = $this->db->insert_id();//get order's id


        if(!empty($this->orderitem['food'])){//count food part's cost
            $num = count($this->orderitem['food']);

            $foodcost = 0;
            for($i = 0 ;$i<$num;$i++){
                $sql = "SELECT * FROM food WHERE fid='".$this->orderitem['food'][$i]."'";
                $query = $this->db->query($sql);
                $fooditem = $query->row(0);

                $sql1 = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('".$this->oid."','".$this->orderitem['food'][$i]."','0') ";
                $this->db->query($sql1);

                $foodcost += $fooditem->fprice;
            }
        }else $foodcost = 0;

        if(!empty($this->orderitem['sidedish'])){//count sidedish part's cost
            $num = count($this->orderitem['sidedish']);

            $sidedishcost = 0;
            for($i = 0 ;$i<$num;$i++){
                $sql = "SELECT * FROM sidedish WHERE sid='".$this->orderitem['sidedish'][$i]."'";
                $query = $this->db->query($sql);
                $sidedishitem = $query->row(0);

                $sql1 = "INSERT INTO orderitem(oid,dishid,dishtype) VALUES('".$this->oid."','".$this->orderitem['sidedish'][$i]."','1') ";
                $this->db->query($sql1);

                $sidedishcost += $sidedishitem->sprice;
            }
        }else $sidedishcost = 0;

        // count total cost of an order
        $this->totalcost = $foodcost + $sidedishcost;

        return $this;
    }

    //if $name is property of order class then set value to it
    public function __set($name,$value){
        if(isset($this->$name)){
            $this->$name = $value;
        }
    }
}