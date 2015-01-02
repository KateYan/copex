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
                    $attributes = array('id'=>'manageDiner');
                    echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-chevron-right"></i> 2. 餐厅管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageDish');
                    echo anchor('dishcontroller/showDishManage','<i class="glyphicon glyphicon-chevron-right"></i> 3. 菜品管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageMenu');
                    echo anchor('menucontroller/showMenuManage','<i class="glyphicon glyphicon-chevron-right"></i> 4. 菜单管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageVip');
                    echo anchor('vipcontroller/showVipPanel','<i class="glyphicon glyphicon-chevron-right"></i> 5. 会员管理',$attributes);
                    ?>
                </li>
                <li class="active">
                    <?php
                    $attributes = array('id'=>'manageBasic');
                    echo anchor('basiccontroller/showBasicManage','<i class="glyphicon glyphicon-chevron-right"></i> 6. 基本管理',$attributes);
                    ?>
                </li>
            </ul>
        </div>

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>基本管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">时间规则管理--(点击用户类型对特定用户群进行再编辑)</div>
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
                                if(!isset($rule)){
                                    echo "暂时没有任何时间规则！";
                                }
                                $num = count($rule['userType']);
                                $userType = $rule['userType'];
                                for($i = 0; $i<$num; $i++){
                                    echo '<tr>';
                                    if($rule['userType'][$i]=="user"){
                                        echo '<td>';
                                        echo anchor("basiccontroller/showEditTime?userType=$userType[$i]","普通用户");
                                        echo '</td>';
                                    }elseif($rule['userType'][$i]=="vip"){
                                        echo '<td>';
                                        echo anchor("basiccontroller/showEditTime?userType=$userType[$i]","VIP用户");
                                        echo '</td>';
                                    }
                                    echo '<td>'.$rule['timeRange'][$i]['value'][0].'</td>';
                                    echo '<td>'.$rule['timeRange'][$i]['value'][1].'</td>';
                                    echo '<td>'.$rule['timeRange'][$i]['value'][2].'</td>';
                                    echo '<td>'.$rule['timeRange'][$i]['value'][3].'</td>';
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
                            <div class="text-muted bootstrap-admin-box-title">校区管理
                            <?php
                            if(isset($eMsg['deletesuccess'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                            }

                            $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;');
                            echo anchor('basiccontroller/showAddCampus','<i class="glyphicon glyphicon-plus"></i>
                                         添加校区',$attributes);
                            ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>校区ID</th>
                                    <th>校区名</th>
                                    <th>校区地址</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($campus)){
                                    echo "暂时没有任何校区！";
                                }
                                $num = count($campus);
                                for($i = 0; $i<$num; $i++){
                                    echo '<tr>';
                                    echo '<td><a href="showCampusDetail?campusId='.$campus[$i]->cid.'">';
                                    echo $campus[$i]->cid;
                                    echo '</a></td>';
                                    echo '<td>'.$campus[$i]->cname.'</td>';
                                    echo '<td>'.$campus[$i]->caddr.'</td>';
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


