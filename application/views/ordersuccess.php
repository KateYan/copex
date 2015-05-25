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
    <meta name="screen-orientation" content="portrait" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
    <title>订单成功</title>
    <link href="../../css/masterpage.css" rel="stylesheet" type="text/css" />
    <link href="../../css/bgRed.css" rel="stylesheet" type="text/css" />
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-62513157-2', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body>
<div class="orderGene">
	<span class="orderFont">
    	您的订单号为<br /><?php echo $order['order']->oid; ?><br /><br />
        请在<?php echo $date; ?><br />
        <?php
        echo $timestart;
        echo "-".$timeend;
        ?><br />
        于
        <?php
        echo $order['order']->cname;
        echo '校区<br/>';
        if(empty($order['order']->placeAddr)){
            echo $order['order']->caddr;
        }else{
            echo $order['order']->placeAddr;
        }
        ?>取餐
    </span>
</div>
</body>
</html>