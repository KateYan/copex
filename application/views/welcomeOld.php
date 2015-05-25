<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/31/2014
 * Time: 1:15 AM
 */
?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html><head>
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
    <link rel="stylesheet" type="text/css" href="/copex/css/idangerous.swiper.css">
    <script type="text/javascript" src="/copex/js/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="/copex/js/idangerous.swiper-1.8_0.js"></script>

    <title>欢迎页</title>
    <script type="text/javascript">
        window.onload = function(){
            swiper = new Swiper('.swiper1', {
                pagination : '.pagination1',
                loop:true
            });
            var swiperN1 = $('.swiper-n1').swiper({
                pagination : '.pagination-n1',
                slidesPerSlide : 1,
            });
        }
        var i = 0;
        $(function(){
            $(".swiper-wrapper, .swiper-slide, .wrapper").css("height", document.documentElement.clientHeight +"px");
            $(".swiper-slide").css("width", document.documentElement.clientWidth +"px");
        });

    </script>
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
<div class="wrapper">
    <div class="swiper-container swiper-n1">
        <div class="pagination-n1"></div>
        <div class="swiper-wrapper" id="secondD">
            <div class='swiper-slide'><img src="/copex/images/remember01.jpg" width="100%" /></div>
            <div class='swiper-slide'><img src="/copex/images/remember02.jpg" width="100%" /></div>
            <div class='swiper-slide'><img src="/copex/images/remember03.jpg" width="100%" /></div>
            <div class='swiper-slide'><img src="/copex/images/remember04.jpg" width="100%" /></div>
            <div class='swiper-slide'>
                <img src="/copex/images/remember05.jpg" width="100%" />
                <?php
                $attributes = array('class'=>'btn_GoIn');
                echo anchor('userlogincontroller/loadCampus','<img src="/copex/images/btn_go.jpg" width="100%" />',$attributes);
                ?>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
</style>
</body>
</html>
