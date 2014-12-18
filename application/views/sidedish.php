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
            $("form#side-dishes-list :input[type='checkbox']").change(function(){
                    var name = $(this).next('label').children('.sd_title').html(), price = $(this).next('label').find('.sd_price_num').html() - 0, oriTotal = $("#total-cost").html() - 0;
               if($(this).attr('checked')){
                //add item
                    var html = '<li><div class="order-list-title sidedish">'+ name +'</div><div class="order-list-amt">1份</div><div class="order-list-cost">$'+ price +'</div></li>';
                    $('#order_list ul').append(html);
                //total price
                    $("#total-cost").html((oriTotal + price).toFixed(2));
               }else{
                //remove item
                $('#order_list>ul>li>div.sidedish:contains('+ name +')').parent('li').remove();
                    $("#total-cost").html((oriTotal - price).toFixed(2));
               }

            });

            $("#side-dishes-list label.sd-selected").trigger('click');


            $("form#side-dishes-list").submit(function(){
                var total = $("#total-cost").html() - 0, balance = $("#balance").html() - 0;
                if(total > balance){
                    $('#not_enough_balance').show();
                    return false;
                }else{
                    $(this).submit();
                }
            });
        });

//        function cashOrder(){
//                var html = "<input type='hidden' name='by_cash' value='true' />";
//                $("form#side-dishes-list").unbind('submit').append(html).submit();
//            }

        function closeWindow(){
            $("#wrong_password").hide();
        }

        function showWindow(){
            $("#wrong_password").show();
        }
    </script>
</head>
<body>
<header id="Header">四款精选小食</header>

<?php
$attributes = array('id'=>'side-dishes-list');
echo form_open('marketcontroller/vipOrderGenerate',$attributes);
?>

<div id="Contenter" style="margin:5px;">
    <ul class="menu_list">
        <?php
        for($i = 0;$i <= 3; $i++){
            $id = $i + 1;
            echo '<li class="side-dish-list">';
            echo "<input type='checkbox' id='sd$id' name='sd$id' style='display:none;' class='side-dish'>";
            echo "<label for='sd$id' class=";
            echo (isset($selectedSd[$id]))?'"sd-selected"':'';
            echo '><div class="menuD_img sd_img"><img src="/copex/upload/';
            echo $sideDish[$i]->spicture;
            echo '.jpg" width="100%" height="100%" /></div>';
            echo '<div class="menuD_title sd_title">'.$sideDish[$i]->sname.'</div>';
            echo '<div class="menuD_price sd_price">$<span class="sd_price_num">'.$sideDish[$i]->sprice.'</span></div></label></li>';
        }
        ?>
    </ul>


    <div class="memu_accout">
        <div class="order_list" id="order_list">
            <ul>
                <?php
                foreach($orderedDishes as $key => $dish){
                    $id = $key + 1;
                    if(!empty($dish)){
                        echo '<li>';
                        echo '<div class="order-list-title">'.$dish['name'].'</div>';
                        echo '<div class="order-list-amt">'.$dish['qty']."份".'</div>';
                        echo '<div class="order-list-cost">'."$".$dish['cost'].'</div>';
                        echo '</li>';
                        echo "<input type='hidden' name='".$dish['inputName']."' value=".$dish['qty'].">";
                        ;
                    }
                }
                ?>
            </ul>
        </div>
        <div class="order_list">
        <ul><li>
            <div class="order-list-title">&nbsp;</div>
            <div class="order-list-amt">总计</div>
            <div class="order-list-cost">$<span id="total-cost"><?php echo $totalcost; ?></span></div>
        </ul></li>
        </div>
        <div class="order_list" style="border:none">
        <ul><li>
            <div class="order-list-title">余额</div>
            <div class="order-list-amt">&nbsp;</div>
            <div class="order-list-cost">$<span id="balance"><?php echo $balance; ?></span></div>
        </ul></li>
        </div>

        <div class="order_password">
            <div class="passPay">支付密码</div>
            <input name="password" type="password" class="passWord" required />
        </div>
        <p style="padding:7px 0 15px 3%; color:red;"></p>
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
        <a href="showDailyMenu" class="btn_submitOrder btn_rest" style="float:left;">重新选择</a>
        <button type="submit" class="btn_submitOrder btn_nowOrder" style="border: none;">立刻下单</button>
        <div class="clear"></div>
    </div>
</Footer>
</form>
<div id="not_enough_balance" class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>余额不足<span class="sorry">现在你可以：</span></p>
        <ul class="finishLay">
            <li>
                <?php
                $attributes = array('class'=>'btn_again');
                echo anchor('marketcontroller/showDailyMenu','A重新点餐',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again');
                echo anchor('userlogincontroller/clearVip','B现金点餐',$attributes);
                ?>
            </li>
<!--            <li><a class="btn_again" onclick="cashOrder()">B现金点餐</a></li>-->
            <li>
                <?php
                $attributes = array('class'=>'btn_again');
                echo anchor('marketcontroller/showDailyMenu','C暂不点餐',$attributes);
                ?>
            </li>
        </ul>
    </div>
</div>
<div id="wrong_password" class="layer" <?php echo (isset($eMsg))?'style="display: block"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br />
        <p><?php echo (isset($eMsg))?$eMsg: ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li></li>
            <li><a href="#" onclick = "closeWindow()">关闭</a></li>
        </ul>
    </div>
</div>
</body>
</html>
