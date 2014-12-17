<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/16/2014
 * Time: 10:38 PM
 */
?>
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
    <title>订单详情</title>
</head>
<body>
<strong><h1>订单详情</h1></strong>

<table border ="1">
    <tr>
        <th>订单号</th>
        <th>菜品名</th>
        <th>菜品类型</th>
        <th>菜品价格</th>
        <th>总价</th>
    </tr>
    <?php

        foreach($orderFood as $orderDetail){
            echo '<tr>';
            echo '<td>'.$orderDetail->oid.'</td>';
            echo '<td>'.$orderDetail->fname.'</td>';

            if($orderDetail->dishtype==0){
                echo '<td>'."主食".'</td>';
            }else{
                echo '<td>'."错误".'</td>';
            }
            echo '<td>'.$orderDetail->fprice.'</td>';
            echo '<td>'.$orderDetail->totalcost.'</td>';
            echo '</tr>';
        }


        foreach($orderSidedish as $orderDetail){
            echo '<tr>';
            echo '<td>'.$orderDetail->oid.'</td>';
            echo '<td>'.$orderDetail->sname.'</td>';

            if($orderDetail->dishtype==1){
                echo '<td>'."小食".'</td>';
            }else{
                echo '<td>'."错误".'</td>';
            }
            echo '<td>'.$orderDetail->sprice.'</td>';
            echo '<td>'.$orderDetail->totalcost.'</td>';
            echo '</tr>';

    }

    ?>
</table>
</body>
</html>