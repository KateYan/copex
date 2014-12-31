<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/31/2014
 * Time: 1:15 AM
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
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/copex/css/reset.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/copex/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/copex/js/move.js"></script>
    <title>欢迎页</title>
    <script type="text/javascript">
        var i = 0;
        $(function(){
            var _l = (".wrapper ul").length;
            $(".wrapper").css("height", document.documentElement.clientHeight +"px");
            $(".wrapper ul").css("width", _l * document.documentElement.clientWidth +"px");
            $(".wrapper li").css("width", document.documentElement.clientWidth +"px");
        });
    </script>
</head>
<body>
<div class="wrapper">
    <ul>
        <li><img src="/copex/images/remember01.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember02.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember03.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember04.jpg" width="100%" /></li>
        <li>
            <img src="/copex/images/remember05.jpg" width="100%" />
            <?php
            $attributes = array('class'=>'btn_GoIn');
            echo anchor('userlogincontroller/loadCampus','<img src="/copex/images/btn_go.jpg" width="100%" />',$attributes);
            ?>
        </li>
    </ul>
</div>
<div class="coin">
    <a class="btn_coin currse_coin"></a>
    <a class="btn_coin"></a>
    <a class="btn_coin"></a>
    <a class="btn_coin"></a>
    <a class="btn_coin"></a>
</div>
</body>
</html>
