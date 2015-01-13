<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/28/2014
 * Time: 6:42 PM
 */
?>

<!-- Vendors -->
<link rel="stylesheet" media="screen" href="vendors/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" media="screen" href="css/datepicker.fixes.css">
<link rel="stylesheet" media="screen" href="vendors/uniform/themes/default/css/uniform.default.min.css">
<link rel="stylesheet" media="screen" href="css/uniform.default.fixes.css">
<link rel="stylesheet" media="screen" href="vendors/chosen.min.css">
<link rel="stylesheet" media="screen" href="vendors/selectize/dist/css/selectize.bootstrap3.css">
<link rel="stylesheet" media="screen" href="vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

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

        <!-- content -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>菜单管理
                            <?php
                            if(isset($eMsg['using'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['using'].'</b></span>';
                            }
                            ?>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <?php
                            $attributes = array('id'=>'deleteMenu');
                            echo form_open('menucontroller/deleteMenu',$attributes);
                            echo form_close();
                            ?>
                            <div class="text-muted bootstrap-admin-box-title">菜单详情

                                <button form="deleteMenu" type="submit" class="btn btn-sm btn-danger" style="float: right;">
                                    <i class="glyphicon glyphicon-remove"> 删除该菜单</i>
                                </button>
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                echo anchor('menucontroller/showMenus','<i class="glyphicon glyphicon-backward"> 回菜单列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>主食菜单详情: 菜单ID--
                                    <?php
                                    echo $_SESSION['menuDetail']->mid;
                                    ?>
                                    </legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单所属校区</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php echo $_SESSION['menuDetail']->cname?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">创建日期</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php echo $_SESSION['menuDetail']->mdate?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单状态</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php if($_SESSION['menuDetail']->mstatus==1){echo "正在使用";}elseif($_SESSION['menuDetail']->mstatus==0){echo "未使用";} ?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单内容</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <?php
                                                    $attributes = array('id'=>'menuInventory');
                                                    echo form_open('menucontroller/menuInventory',$attributes);
                                                    echo form_close();
                                                    ?>
                                                    <div class="text-muted bootstrap-admin-box-title">菜单主食
                                                        <?php
                                                        if(isset($eMsg['wrong'])){
                                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                                        }elseif(isset($eMsg['success'])){
                                                            echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                                                        }
                                                        ?>
                                                        <button form="menuInventory" class="btn btn-sm btn-success" style="float: right;margin-right: 5px;">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            修改库存
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>主食类型</th>
                                                            <th>主食ID</th>
                                                            <th>主食名</th>
                                                            <th>单价</th>
                                                            <th>库存</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $num = count($_SESSION['menuItems']);
                                                        echo '<input form="menuInventory" type="hidden" name="menu" value="'.$_SESSION['menuDetail']->mid.'"/>';
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<td>';
                                                            if($_SESSION['menuItems'][$i]->isrecomd == 1){
                                                                echo "店长推荐";
                                                            }elseif($_SESSION['menuItems'][$i]->isrecomd == 0){
                                                                echo "特价";
                                                            }
                                                            echo '</td>';
                                                            echo '<input form="menuInventory" type="hidden" name="food'.$i.'" value="'.$_SESSION['menuItems'][$i]->fid.'"/>';

                                                            echo '<td>';
                                                            echo anchor("dishcontroller/showFoodDetail?foodId=".$_SESSION['menuItems'][$i]->fid,$_SESSION['menuItems'][$i]->fid);
                                                            echo '</td>';

                                                            echo '<td>'.$_SESSION['menuItems'][$i]->fname.'</td>';
                                                            echo '<td>'."$".$_SESSION['menuItems'][$i]->fprice.'</td>';
                                                            echo '<td>';
                                                            echo '<input form="menuInventory" class="form-control" style="width:50px;" type="text" name="inventory'.$i.'" value="'.$_SESSION['menuItems'][$i]->minventory.'" required />';
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
                                    <button form="" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 确认添加</i>
                                    </button>
                                    <?php
                                    $attributes = array('class'=>'btn btn-success','type'=>'reset');
                                    echo anchor('menucontroller/showMenus','<i class="glyphicon glyphicon-backward"> 回菜单列表</i>',$attributes);
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
