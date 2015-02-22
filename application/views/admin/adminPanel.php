<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/18/2014
 * Time: 11:15 PM
 */
?>

    <!-- Custom styles -->
    <style type="text/css">
        @font-face {
            font-family: Ubuntu;
            src: url('/copex/bootstrap/fonts/Ubuntu-Regular.ttf');
        }
        .bs-docs-masthead{
            background-color: #6f5499;
            background-image: linear-gradient(to bottom, #563d7c 0px, #6f5499 100%);
            background-repeat: repeat-x;
        }
        .bs-docs-masthead{
            padding: 0;
        }
        .bs-docs-masthead h1{
            color: #fff;
            font-size: 40px;
            margin: 0;
            padding: 34px 0;
            text-align: center;
        }
        .bs-docs-masthead a:hover{
            text-decoration: none;
        }
        .meritoo-logo a{
            background-color: #fff;
            border: 1px solid rgba(66, 139, 202, 0.4);
            display: block;
            font-family: Ubuntu;
            padding: 22px 0;
            text-align: center;
        }
        .meritoo-logo a,
        .meritoo-logo a:hover,
        .meritoo-logo a:focus{
            text-decoration: none;
        }
        .meritoo-logo a img{
            display: block;
            margin: 0 auto;
        }
        .meritoo-logo a span{
            color: #4e4b4b;
            font-size: 18px;
        }
        .row-urls{
            margin-top: 4px;
        }
        .row-urls .col-md-6{
            text-align: center;
        }
        .row-urls .col-md-6 a{
            font-size: 14px;
        }
    </style>
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
                <li class="active">
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

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header bootstrap-admin-content-title">
                        <h1>Copex 订餐管理系统</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                        <ol class="breadcrumb bootstrap-admin-breadcrumb">
                            <li>
                                <a>
                                    <b>
                                    <?php
                                    echo "COPEX 的点击量： ";

                                    if(isset($clickTimes)){
                                        echo $clickTimes;
                                    }

                                    ?>
                                    </b>
                                </a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">COPEX系统运营管理项</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <?php
                                echo '<li>';
                                echo anchor('admincontroller/showOrderPanel','1. 订单管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('preparecontroller/showDinerDishPanel','2. 备餐管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('menucontroller/showMenuManage','3. 菜单管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('dishcontroller/showDishPanel','4. 菜品管理');
                                echo '</li>';


                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">COPEX系统维护管理项</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <?php
                                echo '<li>';
                                echo anchor('dinercontroller/showDinerManage','1. 餐厅管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('vipcontroller/showVipPanel','2. 会员管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('cardcontroller/showCardList','3. 会员卡管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('basiccontroller/showBasicPanel','4. 基本管理');
                                echo '</li>';

                                echo '<li>';
                                echo anchor('campuscontroller/showCampusPanel','5. 校区管理');
                                echo '</li>';


                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">使用指南</div>
                        </div>
                        <div class="bootstrap-admin-panel-content" style="height:300px;overflow: scroll;">
                            <p><b>一. 订单管理</b></p>
                            <p>1. 根据校区不同，显示不同校区需要准备的订单和历史订单。</p>
                            <p>2. 订单管理主页分两部分，a.需要准备的订单；b.所有订单历史（包含需要准备的订单）。</p>
                            <p>3. 对所有订单的操作分为两大类，一类为变更订单付款状态，另一类为变更订单收货的状态。一个订单只有当既付款了，也收货了，才算正常完成。</p>
                            <p>4. 预备订单部分配有打印功能，打印显示某校区需要准备的所有订单列表。同时，点击订单号可以查看该订单的详情（包含具体菜品内容）</p>
                            <p><b>二. 备餐管理</b></p>
                            <p>1. 首先选择要备餐的餐厅，会显示该餐厅今天需要准备的主食和小食菜品两类。同时可以点击打印，给各个餐厅准备菜品。</p>
                            <p>2. 点击“查看分配列表”，选择校区，可以查看该餐厅需要往该校区准备的菜品有多少，以供配餐人员对刚从餐厅取出的菜品按校区进行分类。可以打印。</p>
                            <p>3. 接着可以点击“订单分配”，查看该餐厅配往该校区的菜品属于哪些个订单。可以打印。</p>
                            <p><b>三. 餐厅管理</b></p>
                            <p>1. 餐厅管理主页包含所有餐厅列表，包含操作：a.点击餐厅ID查看详情。b.点击按钮添加新餐厅</p>
                            <p>2. 餐厅编辑中，如果餐厅有菜品处于正在当前使用菜单中使用的而状态，删除餐厅会不成功。</p>
                            <p><b>四. 菜品管理</b></p>
                            <p>1. 菜品管理主页会显示所有主食和小食的菜品列表，包含操作：a. 编辑菜品；b.添加菜品</p>
                            <p>2. 对于编辑菜品，如果需要变更菜品图片，需要先进行图片上传，然后再编辑菜品其他信息。</p>
                            <p>3. 对于新建菜品，也请先上传菜品图片再添加菜品其他信息。</p>
                            <p>4. 上传菜品请尽量不要使用中文图片名。</p>
                            <p><b>五. 菜单管理</b></p>
                            <p>1. 选择校区查看该校区主食菜单列表和小食菜单列表。</p>
                            <p>2. 菜单操作包含：a.更改菜单库存；b.变更使用菜单；c.添加菜单；d.删除未在使用的菜单。</p>
                            <p><b>六. 会员管理</b></p>
                            <p>1. 会员管理主页显示所有会员信息列表。</p>
                            <p>2. 点击会员用户ID可以查看会员所有信息，并可以为其变更会员卡或者充值。</p>
                            <p>3. 点击添加按钮添加新会员。</p>
                            <p><b>七. 会员卡管理</b></p>
                            <p>1. 会员卡管理可以添加新会员卡或者修改预存的支付密码。</p>
                            <p><b>八. 基本管理</b></p>
                            <p>1. 基本管理分为两大块：a.时间管理；b.校区管理。</p>
                            <p>2. 时间管理可以更改下单起止时间和取餐起止时间。</p>
                            <p>3. 校区管理可以修改校区信息或者删除校区。</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
