<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/7/2014
 * Time: 11:17 AM
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
    <title>订单成功</title>
    <link href="../../css/masterpage.css" rel="stylesheet" type="text/css" />
    <link href="../../css/bgRed.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="orderGene">
	<span class="orderFont">
    	您的订单号为<br /><?php echo $orderNumber ?><br /><br />
        请在<?php echo $date; ?><br />
        <?php
        echo $timestart;
        echo "-".$timeend;
        ?><br />
        于<?php echo $address; ?>取餐
    </span>
</div>
</body>
</html>