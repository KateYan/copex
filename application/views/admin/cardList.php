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
        <li class="active">
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
            echo anchor('basiccontroller/showBasicManage','<i class="glyphicon glyphicon-chevron-right"></i> 8. 基本管理',$attributes);
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
    <div class="text-muted bootstrap-admin-box-title">会员卡列表</div>
</div>
    <div class="bootstrap-admin-panel-content">
    <table class="table table-striped table-bordered" id="example">
    <thead>
    <tr>
    <th>会员卡ID</th>
    <th>会员卡卡号</th>
    <th>会员卡密码</th>
    <th>会员卡余额</th>
    <th>会员卡绑定状态</th>
</tr>
</thead>
<tbody>

<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 1.0</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 1.5</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 2.0</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 3.0</td>
    <td>Win 2k+ / OSX.3+</td>
    <td class="center">1.9</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Camino 1.0</td>
    <td>OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Camino 1.5</td>
    <td>OSX.3+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape 7.2</td>
    <td>Win 95+ / Mac OS 8.6-9.2</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape Browser 8</td>
    <td>Win 98SE+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape Navigator 9</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.0</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.1</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.2</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.2</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.3</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.3</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.4</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.4</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.5</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.5</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.6</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.6</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.7</td>
    <td>Win 98+ / OSX.1+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.8</td>
    <td>Win 98+ / OSX.1+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Seamonkey 1.1</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Epiphany 2.20</td>
    <td>Gnome</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


