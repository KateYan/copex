<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/6/2014
 * Time: 1:14 PM
 */
?>

    <script type="text/javascript">
        $(function(){
            var _W = document.documentElement.clientWidth;
            $(".menuD_img").css("height", parseInt((_W-18)*0.47*145/288)+"px");

        })
    </script>
</head>
<body>
<header id="Header">四款精选小食</header>
<div id="Contenter" class="selectedDinner">
    <ul class="menu_list">
        <?php
        foreach($sideDish as $sideItem){
            echo '<li><span class="menuD_img"><img src="';
            echo $sideItem->spicture;
            echo '" width="100%" height="100%" /></span>';
            echo '<span class="menuD_title">'.$sideItem->sname.'</span>';
            echo '<span class="menuD_price">$'.$sideItem->sprice.'</span></li>';
        }
        ?>
    </ul>

    <ul class="memu_accout">
        <div class="menu_list_li">
            <ul>
                <?php
                foreach($orderedDishes as $dish){
                    if(!empty($dish)){
                        echo '<li>';
                        echo '<span class="menuD_AccoutTitle">'.$dish['name'].'</span>';
                        echo '<span class="menuD_AccoutNum">'.$dish['qty']."份".'</span>';
                        echo '<span class="menuD_AccoutPrice">'."$".$dish['cost'].'</span>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <li class="menuD_accout">
            <span class="menuD_AccoutTitle"></span>
            <span class="menuD_AccoutNum">总计</span>
            <span class="menuD_AccoutPrice">$<?php echo $totalcost; ?></span>
        </li>
        <li class="menuD_balance">
            <span class="menuD_AccoutTitle">余额</span>
            <span class="menuD_AccoutNum"></span>
            <span class="menuD_AccoutPrice">$<?php echo $balance; ?></span>
        </li>
        <?php
        $attributes = array('class'=>'formcontrol', 'id'=>'viporder');
        echo form_open('marketcontroller/vipOrderGenerate',$attributes);
        ?>
        <li class="menuD_pay">
            <span class="passPay">支付密码</span>
            <input form="viporder" name="password" type="password" class="passWord" />
        </li>
    </ul>
    <div class="clear"></div>
    <div class="dSales_btnTo">
        <a class="btn_footer moreDinner" href="#">修改密码</a>
        <a href="#" class="btn_footer notInUTSC">忘记密码</a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<Footer id="Footer">
    <div class="btn_resetOrder">
        <a href="showDailyMenu" class="btn_submitOrder btn_rest">重新选择</a><button form="viporder" class="btn_submitOrder btn_nowOrder">立刻下单</button><div class="clear"></div>
    </div>
</Footer>
<div class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>余额不足<span class="sorry">现在你可以：</span></p>
        <ul class="finishLay">
            <li><a class="btn_again">A重新点餐</a></li>
            <li><a class="btn_again">B现金点餐</a></li>
            <li><a class="btn_again">B暂不点餐</a></li>
        </ul>
    </div>
</div>
</body>
</html>
