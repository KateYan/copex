<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 1:21 AM
 */
?>
<!-- Datatables -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/DT_bootstrap.css">
<link rel="stylesheet" media="print" href="/copex/bootstrap/css/DT_bootstrap.css">
<script>
    function printOrder(){
        window.print()
    }
</script>
<style type="text/css" media="screen">
    .print{display:none;}
</style>
<style type="text/css" media="print">
    .noPrint{display:none;}
    .print{display:table-cell;}
</style>
</head>
<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<div class="noPrint">
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
</div>

<!-- main / large navbar -->
<div class="noPrint">
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
</div>

<div class="container">
<!-- left, vertical navbar & content -->
<div class="row">
    <div class="noPrint">
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
                <li class="active">
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
                <li>
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
    </div>

    <!-- content -->
    <div class="col-md-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>备餐管理----<?php echo '餐厅“'.$_SESSION['diner']['dname'].'”'; ?></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">需要准备的主食
                            <span class="noPrint">
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                echo anchor('preparecontroller/goback','<i class="glyphicon glyphicon-backward"> 回备餐主页</i>',$attributes);

                                $attributes = array('id'=>'distribution','class'=>'btn btn-sm btn-primary','style'=>'float: right;margin-right:5px;');
                                echo anchor('preparecontroller/showChooseCampus','<i class="glyphicon glyphicon-search"></i>
                                             查看分配列表',$attributes);
                                ?>
                                <button class="btn btn-sm btn-success" onclick="printOrder()" style="float: right;margin-right: 5px;">
                                    <i class="glyphicon glyphicon-print"></i>
                                    打印需要准备的菜品列表
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>菜品ID</th>
                                <th>菜名</th>
                                <th>份数</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(empty($_SESSION['prepare']['foodList'])){
                                echo "本餐厅不需要准备主食";
                            }else{
                                $num = count($_SESSION['prepare']['foodList']);
                                foreach($_SESSION['prepare']['foodList'] as $food){
                                    echo '<tr>';
                                    echo '<td>'.$food['fid'].'</td>';
                                    echo '<td>'.$food['fname'].'</td>';

                                    echo '<td>'.$food['amount'].'</td>';
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

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">需要准备的小食</div>
                    </div>
                    <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>菜品ID</th>
                                <th>菜名</th>
                                <th>份数</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(empty($_SESSION['prepare']['sideList'])){
                                echo "本餐厅不需要准备小食";
                            }else{
                                $num = count($_SESSION['prepare']['sideList']);
                                foreach($_SESSION['prepare']['sideList'] as $side){
                                    echo '<tr>';
                                    echo '<td>'.$side['sid'].'</td>';
                                    echo '<td>'.$side['sname'].'</td>';

                                    echo '<td>'.$side['amount'].'</td>';
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
