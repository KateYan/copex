<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 3/1/2015
 * Time: 12:37 PM
 */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-control"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0,  user-scalable=no, initial-scale=1.0"/>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/copex/css/welcome/css/reset.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/copex/css/welcome/css/idangerous.swiper.css">
    <script type="text/javascript" src="/copex/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/copex/js/idangerous.swiper-1.8_0.js"></script>

    <title>欢迎页</title>
    <script type="text/javascript">
        window.onload = function () {
            swiper = new Swiper('.swiper1', {
                pagination: '.pagination1',
                loop: true
            });
            var swiperN1 = $('.swiper-n1').swiper({
                pagination: '.pagination-n1',
                slidesPerSlide: 1,
            });
        }
        var i = 0;
        $(function () {
            $("body").css({
                "width": document.documentElement.clientWidth + "px",
                "height": document.documentElement.clientHeight + "px"
            })
            $(".swiper-wrapper, .swiper-slide, .wrapper").css("height", document.documentElement.clientHeight + "px");
            $(".swiper-slide").css("width", document.documentElement.clientWidth + "px");
        });

    </script>
</head>
<body>
<div class="wrapper">
    <div class="swiper-container swiper-n1">
        <div class="pagination-n1"></div>
        <div class="swiper-wrapper" id="secondD">
            <div class='swiper-slide'>
                <div class="images01Position">
                    <img src="/copex/css/welcome/images/images01_01.png" width="320" class="img01"/>
                    <img src="/copex/css/welcome/images/images01_02.png" width="320" class="img02"/>
                    <img src="/copex/css/welcome/images/images01_03.png" width="320" class="img03"/>
                    <img src="/copex/css/welcome/images/images01_04.png" width="320"/>
                </div>
            </div>
            <div class='swiper-slide'>
                <div class="images02Position">
                    <img src="/copex/css/welcome/images/images02.png" width="212"/>
                    <a class="btn_GoIn" href="../userlogincontroller/loadCampus"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/copex/js/jsized.snow.min.js" type="text/javascript"></script>
<script>
    createSnow('', 60);
</script>
</body>
</html>
