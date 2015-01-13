<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/10/2015
 * Time: 1:25 PM
 */
?>
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
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i
                                    class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['username']; ?> <i
                                    class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">更改用户名</a></li>
                                <li><a href="#">更改登录密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li>
                                    <?php
                                    $attributes = array('class' => 'log_out');
                                    echo anchor('admincontroller/logOut', '退出登录', $attributes);
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
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small"
     role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <?php
                    $attributes = array('class' => 'navbar-brand');
                    echo anchor('admincontroller/showAdminPanel', 'Copex 订餐系统-控制面板', $attributes);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</nav>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <div class="col-md-2 bootstrap-admin-col-left">
            <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                <li>
                    <?php
                    $attributes = array('id' => 'adminPanel');
                    echo anchor('admincontroller/showAdminPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 关于Copex', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageOrder');
                    echo anchor('admincontroller/showOrderPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'prepareDishes');
                    echo anchor('preparecontroller/showDinerDishPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 2. 备餐管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageDiner');
                    echo anchor('dinercontroller/showDinerManage', '<i class="glyphicon glyphicon-chevron-right"></i> 3. 餐厅管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageDish');
                    echo anchor('dishcontroller/showDishPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 4. 菜品管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageMenu');
                    echo anchor('menucontroller/showMenuManage', '<i class="glyphicon glyphicon-chevron-right"></i> 5. 菜单管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageVip');
                    echo anchor('vipcontroller/showVipPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 6. 会员管理', $attributes);
                    ?>
                </li>
                <li class="active">
                    <?php
                    $attributes = array('id' => 'manageBasic');
                    echo anchor('cardcontroller/showCardList', '<i class="glyphicon glyphicon-chevron-right"></i> 7. 会员卡管理', $attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id' => 'manageBasic');
                    echo anchor('basiccontroller/showBasicManage', '<i class="glyphicon glyphicon-chevron-right"></i> 8. 基本管理', $attributes);
                    ?>
                </li>
            </ul>
        </div>

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>会员卡管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">会员卡列表
                                <?php
                                $attributes = array('class' => 'btn btn-sm btn-success', 'style' => 'float: right;');
                                echo anchor('cardcontroller/showAddCard', '<i class="glyphicon glyphicon-plus"></i>
                                         添加会员卡', $attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped table-bordered" id="example">
                                <thead>
                                <tr>
                                    <th>会员卡ID</th>
                                    <th>会员卡卡号</th>
                                    <th>会员卡余额</th>
                                    <th>用户ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($vipcards as $vipcard) {
                                    echo '<tr class="gradeA">';
                                    echo '<td>';
                                    echo anchor("cardcontroller/cardDetail?card=$vipcard->vipid", $vipcard->vipid);
                                    echo '</td>';
                                    echo '<td>' . $vipcard->vnumber . '</td>';
//    echo '<td>'.$vipcard->vpassword.'</td>';
                                    echo '<td>$ ' . $vipcard->vbalance . '</td>';
                                    echo '<td>';
                                    if ($vipcard->uid == NULL) {
                                        echo "未使用";
                                    } else {
                                        echo anchor("vipcontroller/showEditVip?vipUser=$vipcard->uid", $vipcard->uid);
                                    }
                                    echo '</td>';
                                    echo '</tr>';
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


