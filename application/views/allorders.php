<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/16/2014
 * Time: 5:29 PM
 */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
    <title>所有订单</title>
</head>
<body>
<strong><h1>所有订单</h1></strong>

<table border ="1">
    <tr>
        <th>订单号</th>
        <th>下单用户</th>
        <th>校区</th>
        <th>订餐日期</th>
        <th>是否已取餐</th>
        <th>是否已付款</th>
        <th>总价</th>
    </tr>
    <?php
    foreach($orders as $order){
        echo '<tr>';
        echo '<td><a href="showOrderDetail/'.$order->orderNumber.'">';
        echo $order->orderNumber.'</a>';
        echo '<td>'.$order->userId.'</td>';
        echo '<td>'.$order->campus.'</td>';
        echo '<td>'.$order->orderDate.'</td>';

        if($order->isPickedup==0){
            echo '<td>'."否".'</td>';
        }else{
            echo '<td>'."是".'</td>';
        }

        if($order->isPaid==0){
            echo '<td>'."否".'</td>';
        }else{
            echo '<td>'."是".'</td>';
        }
        echo '<td>'.$order->totalCost.'</td>';
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>