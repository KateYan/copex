<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:51 PM
 */
?>
<script type="text/javascript">
        $(function(){
            var _W = document.documentElement.clientWidth;
            $(".manaRecom_menu").css("height", parseInt((_W - 18)*256/606)+"px");
            $(".tdyS_m_block").css("height", parseInt((_W - 18)*0.46*317/266)+"px");
            //**********new part
            $(".n_input").bind("click", function(){
                $(this).parent().children(".select_area_block").fadeIn();
            });
            $(".select_area_block ul li").bind("click", function(){
                $(this).addClass("selectLi").siblings().removeClass("selectLi");
                $(this).parent().parent().parent(".n_input_block").children(".n_input").val($(this).html());
                $(".select_area_block").hide();
            });

//        var startTime = $('#timestart').val().split(":"), endTime = $('#timeend').val().split(":");
//        var s = new Date(), e = new Date(), n = new Date();
//
//        s.setHours(startTime[0]);
//        s.setMinutes(startTime[1]);
//        s.setSeconds(startTime[2]);
//
//
//        e.setHours((endTime[0] <=startTime[0])? (endTime[0] + 24): endTime[0]);
//        e.setMinutes(endTime[1]);
//        e.setSeconds(endTime[2]);
//
//            $("form#menuItem").submit(function(){
//                if(!((s<n)&&(n<e))){
//                    $('.layer').show();
//                    return false;
//                }
//
//            });
    })
        function closeWindowTimeLimit(){
            $("#timelimit").hide();
        }

        function closeWindow(){
            $("#orderedLimit").hide();
        }

        function showWindow(){
            $("#orderedLimit").show();
        }

        function closeWindowNofulfill(){
            $("#nofulfill").hide();
        }

        function closeWindowWrongPhone(){
            $("#wrongphone").hide();
        }
    function closeWindowInventory(){
        $("#outofinventory").hide();
    }

    </script>
</head>

<body>
<header id="main_title"><?php echo $date; echo $weekDay; ?> 午餐菜单</header>
<?php
    $attributes = array('class'=>'formcontrol', 'id'=>'menuItem');
    echo form_open('marketcontroller/orderGenerate',$attributes);

?>
<input type="hidden" id="timestart" value="<?php echo $orderStart ?>" >
<input type="hidden" id="timeend" value="<?php echo $orderEnd ?>" >
<div class="manaRecommends">
    <h3>店长推荐</h3>
    <?php
    /*
     * add food's id sending element-><input>
     * and add a label for it, so once the input is checked
     * the border of label will pop out to high light which food
     * the user just chose
     */
    echo '<input type="radio" id="recomdItem" name="fid" value="'.$recomdItem->fid.'">';
    echo '<label for="recomdItem">';
    echo '<div class="manaRecom_menu">';
    echo ' <img src="/copex/upload/recommend/'.$recomdItem->fpicture.'" width="100%" >';
    ?>
        <ul>
            <li><?php echo $recomdItem->fname;?><i class="borderWidth"></i></li>
            <li>$<?php echo $recomdItem->fprice;?></li>
        </ul>
    </div>
    </label>
</div>
<div class="tdySales">
    <h3>今日特价</h3>
    <div class="tdySal_menu">
        <?php
            foreach($saleItem as $sale){
                /* add food's id sending element-><input>
                 * and add a label for it, so once the input is checked
                 * the border of label will pop out to high light which food
                 * the user just chose
                 */
                echo '<div class="tdySal_menu_item"><input type="radio" id="'.$sale->fid.'" name="fid" value="'.$sale->fid.'">';
                echo '<label class="tdyS_m_block" for="'.$sale->fid.'">';
                echo '<span class="tdyS_m_img">';
                echo '<img src="/copex/upload/normal/';
                echo $sale->fpicture.'" width="100%">';
                echo '<span class="menu_title">'.$sale->fname." $".$sale->fprice.'</span>';
                echo '</span>';
//                echo '<span class="menu_title">'.$sale->fname." $".$sale->fprice.'</span>';
                echo '</label> </div>';

            }
        ?>
        <div class="clear"></div>
    </div>
</div>
<div class="dSales_btnTo">
    <?php
    $attributes = array('class'=>'btn_footer moreDinner');
    echo anchor('userlogincontroller/showVipLogin','想多选？点这里',$attributes);
    ?>
    <?php
    $attributes = array('class'=>'btn_footer notInUTSC');
    echo anchor('userlogincontroller/loadCampus',"我不在$cname",$attributes);
    ?>
<!--    new part -->
    <br />
    <div class="n_input_block">
        <input type="text" class="n_input" placeholder="饮料选择" />

        <div class="select_area_block">
            <ul>
                <?php
                foreach ($drinks as $drink) {
                    echo '<input type="radio" name="drink" id="'.$drink->sid.'" value="'.$drink->sid.'" style="display:none;", form="menuItem">';
                    echo '<label for="'.$drink->sid.'"><li>'."  ";
                    echo $drink->sname;
                    echo '</li></label>';
                }
                ?>
            </ul>
        </div>
    </div>


    <div class="n_input_block n_input_rightB">
        <input type="text" class="n_input" placeholder="取餐地点选择" />
        <div class="select_area_block">
            <ul>
                <?php
                foreach ($places as $place) {
                    echo '<input type="radio" name="pickupplace" id="'.$place->placeID.'" value="'.$place->placeID.'" style="display:none;", form="menuItem">';
                    echo '<label for="'.$place->placeID.'"><li>'."  ";
                    echo $place->placeAddr;
                    echo '</li></label>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<footer id="Footer">
    <div class="dinnerS_fMain">
        <input type="tel" class="telephone" name="uphone" placeholder="<?php if(isset($_SESSION['uphone'])){echo $_SESSION['uphone']; }else{echo "请输入手机号";}?>" value="<?php echo $uphone; ?>" required/>
        <button class="btn_submitOrder btn_nowOrder" id="submit_form" style="border:none;">立刻下单</button>
    </div>
</footer>
</form>
<div id="timelimit" class="layer" <?php echo (isset($eMsg['timelimit']))?'style="display: block;"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <?php
        if(isset($orderEnd)){
            $time = date('H:i:s');
            $end = date('06:00:00');
            $start = date("H:i",strtotime($orderStart));
            if($time <= $orderStart && $time>$end){
                echo '<p style="margin-left: 5px;">今天的午餐0:00已经截止下单，明天的午餐要<span class="sorry">'.$start.'后才能下单哦</span></p>';
                echo '<ul>';
                echo '<li></li>';
                echo '<li>';
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowTimeLimit()');
                echo anchor('marketcontroller/showDailyMenu'," 今天".$start."后再订餐",$attributes);
                echo '</li>';
                echo '<li></li></ul>';
            }else{
                echo '<p>对不起，已经超过<span class="sorry">0:00了哦，你可以</span></p>';
                echo '<ul>';
                echo '<li></li>';
                echo '<li>';
                $attributes = array('class'=>'btn_again');
                echo anchor('userlogincontroller/showVipLogin','A. 加入会员延长订餐时间',$attributes);
                echo '</li>';
                echo '<li>';
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowTimeLimit()');
                echo anchor('marketcontroller/showDailyMenu',"B. 明天".$start."后再订餐",$attributes);
                echo '</li>';
            }
        }
        ?>
    </div>
</div>

<div id="wrongphone" class="layer" <?php echo (isset($eMsg['wrongphone']))?'style="display: block;"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br />
        <p style="margin-left: 5px;"><?php echo (isset($eMsg['wrongphone']))?$eMsg['wrongphone']: ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowWrongPhone()');
                echo anchor('marketcontroller/showDailyMenu','重新输入有效的手机号',$attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>

<div id="nofulfill" class="layer" <?php echo (isset($eMsg['nofulfill']))?'style="display: block;"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br />
        <p style="margin-left: 5px;"><?php echo (isset($eMsg['nofulfill']))?$eMsg['nofulfill']: ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowNofulfill()');
                echo anchor('marketcontroller/showDailyMenu','重新下单~',$attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>
<!--for user ordered in today already-->
<div id="orderedLimit" class="layer" <?php echo (isset($eMsg['orderlimit']))?'style="display: block;"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br />
        <p style="margin-left: 5px;"><?php echo (isset($eMsg['orderlimit']))?$eMsg['orderlimit']: ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again');
                echo anchor('userlogincontroller/showVipLogin','A. 加入会员，立享无限下单',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowWrongPhone()');
                echo anchor('marketcontroller/showDailyMenu','B. 继续留在当前页面看看',$attributes);
                ?>
            </li>
        </ul>
    </div>
</div>

<!--for out of inventory-->
<div id="outofinventory" class="layer" <?php echo (isset($eMsg['outofinventory']))?'style="display: block;"': ''; ?>>
    <div class="black_layer"></div>
    <div class="layer_summary">
        <br />
        <p style="margin-left: 5px;"><?php echo (isset($eMsg['outofinventory']))?$eMsg['outofinventory']: ''; ?></p>
        <ul class="finishLay">
            <li></li>
            <li>
                <?php
                $attributes = array('class'=>'btn_again','onclick'=>'closeWindowInventory()');
                echo anchor('marketcontroller/showDailyMenu','选点别的好吃的~',$attributes);
                ?>
            </li>
            <li></li>
        </ul>
    </div>
</div>
</body>
</html>

<?php
