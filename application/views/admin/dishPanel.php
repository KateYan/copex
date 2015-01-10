<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 10:19 PM
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
            <li class="active">
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
                echo anchor('basiccontroller/showBasicManage','<i class="glyphicon glyphicon-chevron-right"></i> 7. 基本管理',$attributes);
                ?>
            </li>
        </ul>
    </div>

    <!-- content -->
    <div class="col-md-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>菜品管理</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">主食列表--点击ID查看并编辑
                            <?php
                            if(isset($eMsg['fooddeleted'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['fooddeleted'].'</b></span>';
                            }

                            $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;');
                            echo anchor('dishcontroller/showAddFood','<i class="glyphicon glyphicon-plus"></i>
                                         添加主食',$attributes);
                            ?>
                        </div>
                    </div>
                    <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>主食ID</th>
                                <th>菜名</th>
                                <th>单价</th>
                                <th>烹饪餐厅</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!isset($food)){
                                echo "还没有任何主食菜品！";
                            }else{
                                $num = count($food);
                                for($i = 0;$i < $num; $i++){
                                    echo '<tr>';
                                    echo '<td>';
                                    echo anchor("dishcontroller/showFoodDetail?foodId=".$food[$i]->fid,$food[$i]->fid);
                                    echo '</td>';
                                    echo '<td>'.$food[$i]->fname.'</td>';
                                    echo '<td>$ '.$food[$i]->fprice.'</td>';
                                    echo '<td>'.$food[$i]->dname.'</td>';
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
                        <div class="text-muted bootstrap-admin-box-title">小食列表--点击ID查看并编辑
                            <?php
                            if(isset($eMsg['sidedeleted'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['sidedeleted'].'</b></span>';
                            }
                            $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;');
                            echo anchor('dishcontroller/showAddSideDish','<i class="glyphicon glyphicon-plus"></i>
                                         添加小食',$attributes);
                            ?>
                        </div>
                    </div>
                    <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>小食ID</th>
                                <th>菜名</th>
                                <th>单价</th>
                                <th>烹饪餐厅</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!isset($sideDish)){
                                echo "还没有任何小食菜品！";
                            }else{
                                $num = count($sideDish);
                                for($i = 0;$i < $num; $i++){
                                    echo '<tr>';
                                    echo '<td>';
                                    echo anchor("dishcontroller/showSideDetail?sideId=".$sideDish[$i]->sid,$sideDish[$i]->sid);
                                    echo '</td>';
                                    echo '<td>'.$sideDish[$i]->sname.'</td>';
                                    echo '<td>$ '.$sideDish[$i]->sprice.'</td>';
                                    echo '<td>'.$sideDish[$i]->dname.'</td>';
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
