<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/22/2014
 * Time: 5:49 PM
 */
?>

<!-- Datatables -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/DT_bootstrap.css">

</head>
<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['username']; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">更改用户名</a></li>
                                <li><a href="#">更改登录密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li>
                                    <?php
                                    $attributes = array('class'=>'log_out');
                                    echo anchor('admincontroller/logOut','退出登录',$attributes);
                                    ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- main / large navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <?php
                    $attributes = array('class'=>'navbar-brand');
                    echo anchor('admincontroller/showAdminPanel','Copex 订餐系统-控制面板',$attributes);
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</nav>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <div class="col-md-2 bootstrap-admin-col-left">
            <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                <li>
                    <?php
                    $attributes = array('id'=>'adminPanel');
                    echo anchor('admincontroller/showAdminPanel','<i class="glyphicon glyphicon-chevron-right"></i> 关于Copex',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageOrder');
                    echo anchor('admincontroller/showOrderPanel','<i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'prepareDishes');
                    echo anchor('preparecontroller/showDinerDishPanel','<i class="glyphicon glyphicon-chevron-right"></i> 2. 备餐管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageDiner');
                    echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-chevron-right"></i> 3. 餐厅管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageDish');
                    echo anchor('dishcontroller/showDishPanel','<i class="glyphicon glyphicon-chevron-right"></i> 4. 菜品管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageMenu');
                    echo anchor('menucontroller/showMenuManage','<i class="glyphicon glyphicon-chevron-right"></i> 5. 菜单管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageVip');
                    echo anchor('vipcontroller/showVipPanel','<i class="glyphicon glyphicon-chevron-right"></i> 6. 会员管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageBasic');
                    echo anchor('cardcontroller/showCardList','<i class="glyphicon glyphicon-chevron-right"></i> 7. 会员卡管理',$attributes);
                    ?>
                </li>
                <li class="active">
                    <?php
                    $attributes = array('id'=>'manageBasic');
                    echo anchor('basiccontroller/showBasicPanel','<i class="glyphicon glyphicon-chevron-right"></i> 8. 基本管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageCampus');
                    echo anchor('campuscontroller/showCampusPanel','<i class="glyphicon glyphicon-chevron-right"></i> 9. 校区管理',$attributes);
                    ?>
                </li>
            </ul>
        </div>

        <!-- content -->
        <div class="col-md-10">
            <?php
            $attributes = array('id'=>'removeSupportDiner');
            echo form_open('campuscontroller/removeSupportDiner',$attributes);
            echo form_close();
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>基本管理--校区
                        <?php
                        echo $rule->campusName;
                        ?>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">时间规则管理--(点击用户类型对特定用户群进行再编辑)
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;');
                                echo anchor('basiccontroller/goback','<i class="glyphicon glyphicon-backward"> 回基本管理主页</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>适用范围</th>
                                    <th>取餐起始时间</th>
                                    <th>取餐结束时间</th>
                                    <th>下单起始时间</th>
                                    <th>下单结束时间</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($rule->cid)){
                                    echo "暂时没有任何时间规则！";
                                }else{
                                    // for non-vip user
                                    echo '<tr>';
                                    echo '<td>';
                                    echo anchor("basiccontroller/showEditTime?userType=user","普通用户");
                                    echo '</td>';
                                    echo '<td>'.$rule->userPickupStart.'</td>';
                                    echo '<td>'.$rule->userPickupEnd.'</td>';
                                    echo '<td>'.$rule->userOrderStart.'</td>';
                                    echo '<td>'.$rule->userOrderEnd.'</td>';
                                    echo '</td>';

                                    //for vip user
                                    echo '<tr>';
                                    echo '<td>';
                                    echo anchor("basiccontroller/showEditTime?userType=vip","VIP用户");
                                    echo '</td>';
                                    echo '<td>'.$rule->vipPickupStart.'</td>';
                                    echo '<td>'.$rule->vipPickupEnd.'</td>';
                                    echo '<td>'.$rule->vipOrderStart.'</td>';
                                    echo '<td>'.$rule->vipOrderEnd.'</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">取餐地址列表--点击取餐地点ID修改其取餐时间段
                                <?php
                                if(isset($eMsg['deletesuccess'])){
                                    echo '<span style="color: #be2221;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                                }

                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;');
                                echo anchor('basiccontroller/goback','<i class="glyphicon glyphicon-backward"> 回基本管理主页</i>',$attributes);
                                ?>
<!--                                <button style="float: right;" form="removePickupPlace" class="btn btn-sm btn-danger">-->
<!--                                    <i class="glyphicon glyphicon-remove"></i>-->
<!--                                    删除取餐地点-->
<!--                                </button>-->

                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>取餐地点ID</th>
                                    <th>取餐地址</th>
                                    <th>取餐开始</th>
                                    <th>取餐结束</th>
<!--                                    <th>删除地点</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(empty($places)){
                                    echo "暂时没有任何取餐地点！";
                                }else{
                                    foreach($places as $place){
                                        echo '<tr>';
                                        echo '<td><a href="showPlacePickupTime?placeID='.$place->placeID.'">';
                                        echo $place->placeID;
                                        echo '</a></td>';
                                        echo '<td>'.$place->placeAddr.'</td>';
                                        echo '<td>'.$place->userPickupStart.'</td>';
                                        echo '<td>'.$place->userPickupEnd.'</td>';
//                                        echo '<td>'.'<input form="removePickupPlace" type="radio" name="place" value="'.$place->placeID.'"/></td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


