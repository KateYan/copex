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
    <title>特价午餐菜单</title>
    <link href="http://localhost/copex/css/masterpage.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/copex/css/dinner.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://localhost/copex/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(function(){
            var _W = document.documentElement.clientWidth;
            $(".manaRecom_menu").css("height", parseInt((_W - 18)*256/606)+"px");
            $(".tdyS_m_block").css("height", parseInt((_W - 18)*0.46*317/266)+"px");

        })
    </script>
</head>
<body>
<header id="Header">11月14号午餐菜单</header>

<div class="manaRecommends">
    <h3>店长推荐</h3>
    <div class="manaRecom_menu">
        <img src="http://localhost/copex/css/images/1_04img01.jpg" width="100%" height="100%"/>
        <ul>
            <li>红烧鸭子<i class="borderWidth"></i></li>
            <li>￥78.00</li>
        </ul>
    </div>
</div>
<div class="tdySales">
    <h3>今日6.99特价</h3>
    <div class="tdySal_menu">
        <div class="tdyS_m_block">
            <span class="tdyS_m_img">
                <img src="http://localhost/copex/css/images/1_04img02.jpg" width="100%" height="100%" />
                <span class="menu_title">干锅排骨</span>
            </span>
        </div><!-- end of tdyS_m_block-->
        <div class="tdyS_m_block">
            <span class="tdyS_m_img">
                <img src="http://localhost/copex/css/images/1_04img02.jpg" width="100%" height="100%" />
                <span class="menu_title">蜜辣烤翅</span>
            </span>
        </div><!-- end of tdyS_m_block-->
        <div class="clear"></div>
    </div>
</div>
<div class="dSales_btnTo">
    <a class="btn_footer moreDinner" href="dinner.html">想多选？点这里</a>
    <a href="#" class="btn_footer notInUTSC">我不在UTSC</a>
    <div class="clear"></div>
</div>
<footer id="Footer">
    <div class="dinnerS_fMain">
        <input type="tel" class="telephone" placeholder="输入手机号" />
        <a class="btn_submitOrder btn_nowOrder">立刻下单</a>
    </div>
</footer>
<div class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>对不起，已经超过<span class="sorry">0:00了哦，你可以</span></p>
        <ul>
            <li><a class="btn_again">A加入会员延长订餐时间</a></li>
            <li><a class="btn_again">B明天中午12:00后再订餐</a></li>
        </ul>
    </div>
</div>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:53 PM
 */ 