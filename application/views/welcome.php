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
    <meta name="screen-orientation" content="portrait" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/copex/css/reset.css" rel="stylesheet" type="text/css" />
    <script type="/copex/text/javascript" src="/copex/js/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript">
        $(function(){
            var _l = 5;
            $(".wrapper ul").css({"height": document.documentElement.clientHeight +"px", "width": _l * document.documentElement.clientWidth +"px"});
            $(".wrapper li, .wrapper").css({"width": document.documentElement.clientWidth +"px", "height": document.documentElement.clientHeight +"px"});
        });
    </script>
    <title>欢迎页</title>

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
<script type="text/javascript">
    var i = 0;
    function GetSlideAngle(dx, dy) {
        return Math.atan2(dy, dx) * 180 / Math.PI;
    }

    //根据起点和终点返回方向 1：向上，2：向下，3：向左，4：向右,0：未滑动
    function GetSlideDirection(startX, startY, endX, endY) {
        var dy = startY - endY;
        var dx = endX - startX;
        var result = 0;

        //如果滑动距离太短
        if (Math.abs(dx) < 2 && Math.abs(dy) < 2) {
            return result;
        }

        var angle = GetSlideAngle(dx, dy);
        if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {
            result = 3;
        }

        return result;
    }

    //滑动处理
    var startX, startY;
    document.addEventListener('touchstart', function (ev) {
        startX = ev.touches[0].pageX;
        startY = ev.touches[0].pageY;
    }, false);
    document.addEventListener('touchend', function (ev) {
        var endX, endY;
        endX = ev.changedTouches[0].pageX;
        endY = ev.changedTouches[0].pageY;
        var direction = GetSlideDirection(startX, startY, endX, endY);
        switch (direction) {
            case 3:
                //alert("向左");
                i++;
                if(i>4){
                    return;
                }
                $(".wrapper ul").animate({"left": -i * document.documentElement.clientWidth +"px"});
                $(".coin a").eq(i).addClass("currse_coin").siblings().removeClass("currse_coin");
                break;
            default:
        }
    }, false);
</script>
</body>
</html>

