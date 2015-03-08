<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/6/2014
 * Time: 1:14 PM
 */
?>
<script type="text/javascript">
    $(function () {
        $("form#side-dishes-list :input[type='checkbox']").change(function () {
            var name = $(this).next('label').children('.sd_title').html(), price = $(this).next('label').find('.sd_price_num').html() - 0, oriTotal = $("#total-cost").html() - 0;
            if ($(this).attr('checked')) {
                //add item
                var html = '<li><div class="order-list-title sidedish">' + name + '</div><div class="order-list-amt">1份</div><div class="order-list-cost">$' + price + '</div></li>';
                $('#order_list ul').append(html);
                //total price
                var cost = (oriTotal + price).toFixed(2), tax = (cost * .13).toFixed(2), total = (cost - 0 + (tax - 0)).toFixed(2);

            } else {
                //remove item
                $('#order_list>ul>li>div.sidedish:contains(' + name + ')').parent('li').remove();
                //total price
                var cost = (oriTotal - price).toFixed(2), tax = (cost * .13).toFixed(2), total = (cost - 0 + (tax - 0)).toFixed(2);
            }

            $("#total-cost").html(cost);
            $("#tax").html(tax);
            $("#total-amt").html(total);

        });

        $("#side-dishes-list label.sd-selected").trigger('click');


        $("form#side-dishes-list").submit(function () {
            var total = $("#total-amt").html() - 0, balance = $("#balance").html() - 0;
            if (total > balance) {
                $('#not_enough_balance').show();
                return false;
            } else {
                $(this).submit();
            }
        });

        //**********new part
        $(".n_input").bind("click", function () {
            $(this).parent().children(".select_area_block").fadeIn();
        });
        $(".select_area_block ul label li").bind("click", function () {
            $(this).addClass("selectLi").siblings().removeClass("selectLi");
            $(this).parent().parent().parent().parent(".order_password").children(".n_input").val($(this).html());
            $(".select_area_block").hide();
        });
        // ******* new part end
    });

    //        function cashOrder(){
    //                var html = "<input type='hidden' name='by_cash' value='true' />";
    //                $("form#side-dishes-list").unbind('submit').append(html).submit();
    //            }

    function closeWindow() {
        $("#wrong_password").hide();
    }

    function closeWindowNofood() {
        $("#nofood").hide();
    }

    function closeWindowNosidedish() {
        $("#nosidedish").hide();
    }

    function closeWindowTimeLimit() {
        $("#timelimit").hide();

    }function closeWindowNoPickup() {
        $("#noPickupPlace").hide();
    }

    function showWindow() {
        $("#wrong_password").show();
    }

    function showWindow() {
        $("#nofood").show();
    }
</script>
</head>
<body>
<header id="Header">四款精选小食</header>

<?php
$attributes = array('id' => 'side-dishes-list');
echo form_open('marketcontroller/vipOrderGenerate', $attributes);
?>

<div id="Contenter" style="margin:5px;">
    <ul class="menu_list">
        <?php
        for ($i = 0; $i <= 5; $i++) {
            $id = $i + 1;
            echo '<li class="side-dish-list">';
            echo "<input type='checkbox' id='sd$id' name='sd$id' style='display:none;' class='side-dish'>";
            echo "<label for='sd$id' class=";
            echo (isset($selectedSd[$id])) ? '"sd-selected"' : '';
            echo '><div class="menuD_img sd_img"><img src="/copex/upload/side/';
            echo $sideDish[$i]->spicture;
            echo '" width="100%" height="100%" /></div>';
            echo '<div class="menuD_title sd_title">' . $sideDish[$i]->sname . '</div>';
            echo '<div class="menuD_price sd_price">$<span class="sd_price_num">' . $sideDish[$i]->sprice . '</span></div></label></li>';
        }
        ?>
    </ul>


    <div class="memu_accout">
        <div class="order_list" id="order_list">
            <ul>
                <?php
                foreach ($orderedDishes as $key => $dish) {
                    $id = $key + 1;
                    if (!empty($dish)) {
                        echo '<li>';
                        echo '<div class="order-list-title">' . $dish['name'] . '</div>';
                        echo '<div class="order-list-amt">' . $dish['qty'] . "份" . '</div>';
                        echo '<div class="order-list-cost">' . "$" . $dish['cost'] . '</div>';
                        echo '</li>';
                        echo "<input type='hidden' name='" . $dish['inputName'] . "' value=" . $dish['qty'] . ">";;
                    }
                }
                ?>
            </ul>
        </div>
        <div class="order_list">
            <ul>
                <li>
                    <div class="order-list-title">&nbsp;</div>
                    <div class="order-list-amt">合计</div>
                    <div class="order-list-cost">$<span id="total-cost"><?php echo $totalcost_befortax; ?></span></div>
            </ul>
            </li>
        </div>
        <div class="order_list">
            <ul>
                <li>
                    <div class="order-list-title">&nbsp;</div>
                    <div class="order-list-amt">HST(13%)</div>
                    <div class="order-list-cost">$<span
                            id="tax"><?php echo round($totalcost_befortax * 0.13, 2); ?></span></div>
            </ul>
            </li>
        </div>
        <div class="order_list">
            <ul>
                <li>
                    <div class="order-list-title">&nbsp;</div>
                    <div class="order-list-amt">总额</div>
                    <div class="order-list-cost">$<span
                            id="total-amt"><?php echo round($totalcost_befortax * 1.13, 2); ?></span></div>
            </ul>
            </li>
        </div>

        <div class="order_list" style="border:none">
            <ul>
                <li>
                    <div class="order-list-title">余额</div>
                    <div class="order-list-amt">&nbsp;</div>
                    <div class="order-list-cost">$<span id="balance"><?php echo $balance; ?></span></div>
            </ul>
            </li>
        </div>

        <?php
        if(!empty($places)){
            echo '<div class="order_password" id="pickupPlace">';
            echo '<div class="passPay">取餐地点</div>';
            echo '<input type="text" class="n_input" placeholder="选择地点"/>';
            echo '<div class="select_area_block">';
            echo '<ul>';

            foreach ($places as $place) {
                echo '<input type="radio" name="pickupplace" id="' . $place->placeID . '" value="' . $place->placeID . '" style="display:none;" >';

                echo '<label for="' . $place->placeID . '"><li>' . "  ";
                echo $place->placeAddr;
                echo '</li></label>';

            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '';

        }
        ?>
        <br/>

        <div class="order_password">
            <div class="passPay">支付密码</div>
            <input name="password" type="password" class="passWord"/>
        </div>
        <p style="padding:7px 0 15px 3%; color:red;"></p>
    </div>
    <div class="clear"></div>
    <div class="dSales_btnTo">
        <?php
        $attributes = array('class' => 'btn_footer moreDinner');
        echo anchor('userlogincontroller/showChangePassword', '修改密码', $attributes);
        ?>
        <a href="#" class="btn_footer notInUTSC">忘记密码</a>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<Footer id="Footer">
    <div class="btn_resetOrder">
        <?php
        $attributes = array('class' => 'btn_submitOrder btn_rest', 'style' => 'float:left;');
        echo anchor('marketcontroller/showDailyMenu', '重新选择', $attributes);
        ?>
        <button type="submit" class="btn_submitOrder btn_nowOrder" style="border: none;">立刻下单</button>
        <div class="clear"></div>
    </div>
</Footer>
</form>
<div id="not_enough_balance" class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>您的会员卡余额不足<span class="sorry">现在您可以：</span></p>
        <ul class="finishLay">
            <li>
                <?php
                $attributes = array('class' => 'btn_again');
                echo anchor('marketcontroller/showDailyMenu', 'A. 我想重新选择', $attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again');
                echo anchor('userlogincontroller/clearVip', 'B. 以普通用户身份点餐', $attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again');
                echo anchor('marketcontroller/showSideDish', 'C. 留在当前页面看看', $attributes);
                ?>
            </li>
        </ul>
    </div>
</div>
<!--no password-->
<div id="nopw" class="layer" <?php echo (isset($eMsg['nopw'])) ? 'style="display: block;"' : ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br/>

        <p><?php echo (isset($eMsg['nopw'])) ? $eMsg['nopw'] : ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li></li>
            <li><?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindow()');
                echo anchor('marketcontroller/showSideDish', '关闭', $attributes);
                ?>
            </li>
        </ul>
    </div>
</div>
<!--wrong password-->
<div id="wrong_password" class="layer" <?php echo (isset($eMsg['wrongpw'])) ? 'style="display: block;"' : ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br/>

        <p><?php echo (isset($eMsg['wrongpw'])) ? $eMsg['wrongpw'] : ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li></li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindow()');
                echo anchor('marketcontroller/showSideDish', '关闭', $attributes);
                ?>
            </li>
        </ul>
    </div>
</div>
<!--food out of inventory-->
<div id="nofood" class="layer" <?php echo (isset($nofood)) ? 'style="display: block;"' : ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br/>

        <p style="margin-left: 5px;"><?php echo "对不起，";
            echo "“" . $nofood . "”"; ?><span class="sorry">没有预定名额了，你可以：</span></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindowNofood()');
                echo anchor('marketcontroller/showDailyMenu', '去挑选别的美味主食~', $attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>
<!--sidedish out of inventory-->
<div id="nosidedish" class="layer" <?php echo (isset($nosidedish)) ? 'style="display: block;"' : ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br/>

        <p style="margin-left: 5px;"><?php echo "对不起，";
            echo "“" . $nosidedish . "”"; ?><span class="sorry">没有预定名额了，你可以：</span></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindowNosidedish()');
                echo anchor('marketcontroller/showSideDish', '去挑选别的诱人小食~', $attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>

<!--didn't choose pickup place-->
<div id="noPickupPlace" class="layer" <?php if (isset($eMsg['nopickupplace'])) {
    echo 'style="display: block;"';
} ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p><?php
            $start = date("H:i", strtotime($orderStart));
            echo '<p>您还没有选择取餐地点哦~</p>';
            ?>
        </p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindowNoPickup()');
                echo anchor('marketcontroller/showSideDish', " 选择距离我最近的取餐地点~", $attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>

<!--out of order time range-->
<div id="timelimit" class="layer" <?php if (isset($eMsg['timelimit'])) {
    echo 'style="display: block;"';
} ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p><?php
            $start = date("H:i", strtotime($orderStart));
            echo '<p>今日下单已经结束<span class="sorry">' . $start . '后才能下明天的单哦</span></p>';
            ?>
        </p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class' => 'btn_again', 'onclick' => 'closeWindowTimeLimit()');
                echo anchor('marketcontroller/showDailyMenu', " 先去逛逛，等一会再下单~", $attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>
</body>
</html>
