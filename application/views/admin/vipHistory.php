<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 2/22/2015
 * Time: 5:37 AM
 */
?>

<!-- Datatables -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/DT_bootstrap.css">
<link rel="stylesheet" media="print" href="/copex/bootstrap/css/DT_bootstrap.css">
<script>
    function printOrder() {
//        var elems1 = document.getElementsByClassName('anoPrint');
//        for(var i = 0; i < elems1.length; i++) {
//            elems1[i].style.display = "none";
//        }
//        var elems2 = document.getElementsByClassName('print');
//        for(var i = 0; i < elems2.length; i++) {
//            elems2[i].style.display = "table-cell";
//        }
        window.print()
    }
</script>
<style type="text/css" media="screen">
    .print {
        display: none;
    }
</style>
<style type="text/css" media="print">
    .noPrint {
        display: none;
    }

    .print {
        display: table-cell;
    }
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
</div>

<!-- main / large navbar -->
<div class="noPrint">

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
</div>


<div class="container">
<!-- left, vertical navbar & content -->
<div class="row">
<!-- left, vertical navbar -->

<div class="noPrint">

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
            <li class="active">
                <?php
                $attributes = array('id' => 'manageVip');
                echo anchor('vipcontroller/showVipPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 6. 会员管理', $attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id' => 'manageBasic');
                echo anchor('cardcontroller/showCardList', '<i class="glyphicon glyphicon-chevron-right"></i> 7. 会员卡管理', $attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id' => 'manageBasic');
                echo anchor('basiccontroller/showBasicPanel', '<i class="glyphicon glyphicon-chevron-right"></i> 8. 基本管理', $attributes);
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
            <h1>
                会员历史操作 userID: <?php echo $_SESSION['vipUser']->uid;?>
            </h1>
        </div>
    </div>
</div>

<div class="noPrint">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">vipID: <?php echo $_SESSION['vipUser']->vipid;?>历史记录

                        <?php
                        $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-top:0px;');
                        echo anchor('vipcontroller/goback','<i class="glyphicon glyphicon-backward"> 回VIP列表</i>',$attributes);
                        ?>

                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <?php
                    if (empty($history)) {
                        echo "该用户暂时还未充过值。";
                    } else {

                        echo '<table class="table table-striped table-bordered" id="example">';
                        echo '<thead>';
                        echo '<tr>';

                        echo '<th>编号</th>
                            <th>操作时间</th>
                            <th>存入</th>
                            <th>取出</th>
                            <th>余额</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        $num = count($history);
                        for ($i = 1; $i <= $num; $i++) {
                            echo '<tr>';

                            echo '<td>'.$i.'</td>';

                            echo '<td>' . $history[$i-1]->logTime. '</td>';

                            if($history[$i-1]->befBalance < $history[$i-1]->aftBalance){
                                echo '<td>$' . $history[$i-1]->addBalance . '</td>';
                                echo '<td>N/A</td>';
                            }else{
                                echo '<td>N/A</td>';
                                $value = 0 - $history[$i-1]->addBalance;

                                echo '<td>$' . $value . '</td>';
                            }

                            echo '<td>$' . $history[$i-1]->aftBalance . '</td>';

                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>


