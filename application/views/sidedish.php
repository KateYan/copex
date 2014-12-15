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

        })
    </script>
</head>
<body>
<header id="Header">四款精选小食</header>
<div id="Contenter" style="margin:5px;">
    <form id="side-dishes-list">
    <ul class="menu_list">
        <?php
        for($i = 0;$i <= 3; $i++){
            $id = $i + 1;
            echo '<li class="side-dish-list">';
            echo "<input type='checkbox' id='sd$id' name='sd$id' style='display:none;' class='side-dish'>";
            echo "<label for='sd$id' >";
            echo '<div class="menuD_img sd_img"><img src="../../upload/';
            echo $sideDish[$i]->spicture;
            echo '.jpg" width="100%" height="100%" /></div>';
            echo '<div class="menuD_title sd_title">'.$sideDish[$i]->sname.'</div>';
            echo '<div class="menuD_price sd_price">$'.$sideDish[$i]->sprice.'</div></label></li>';
        }
        ?>
    </ul>
    </form>

    <div class="memu_accout">
        <div class="order_list">
            <ul>
                <?php
                foreach($orderedDishes as $dish){
                    if(!empty($dish)){
                        echo '<li>';
                        echo '<div class="order-list-title">'.$dish['name'].'</div>';
                        echo '<div class="order-list-amt">'.$dish['qty']."份".'</div>';
                        echo '<div class="order-list-cost">'."$".$dish['cost'].'</div>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <div class="order_list">
        <ul><li>
            <div class="order-list-title">&nbsp;</div>
            <div class="order-list-amt">总计</div>
            <div class="order-list-cost">$<?php echo $totalcost; ?></div>
        </ul></li>
        </div>
        <div class="order_list" style="border:none">
        <ul><li>
            <div class="order-list-title">余额</div>
            <div class="order-list-amt">&nbsp;</div>
            <div class="order-list-cost">$<?php echo $balance; ?></div>
        </ul></li>
        </div>
        <?php
        $attributes = array('class'=>'formcontrol', 'id'=>'viporder');
        echo form_open('marketcontroller/vipOrderGenerate',$attributes);
        ?>

        <div class="order_password">
            <div class="passPay">支付密码</div>
            <input form="viporder" name="password" type="password" class="passWord" />
        </div>
    </div>
    <div class="clear"></div>
    <div class="dSales_btnTo">
        <a class="btn_footer moreDinner" href="../userlogincontroller/showChangePassword">修改密码</a>
        <a href="#" class="btn_footer notInUTSC">忘记密码</a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<Footer id="Footer">
    <div class="btn_resetOrder">
        <a href="showDailyMenu" class="btn_submitOrder btn_rest">重新选择</a>
        <button form="viporder" class="btn_submitOrder btn_nowOrder" style="border: none;">立刻下单</button><div class="clear"></div>
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
