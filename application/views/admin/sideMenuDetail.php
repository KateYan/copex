<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/28/2014
 * Time: 7:39 PM
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
                        <h1>菜单管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">菜单详情
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-success','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                echo anchor('menucontroller/showMenus','<i class="glyphicon glyphicon-backward"> 回菜单列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>小食菜单详情: 菜单ID--
                                        <?php
                                        echo $_SESSION['sideMenuDetail']->sideMenuID;
                                        ?>
                                    </legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单所属校区</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php echo $_SESSION['sideMenuDetail']->cname;?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">创建日期</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php echo $_SESSION['sideMenuDetail']->sideMenuDate;?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单状态</label>
                                        <div class="col-lg-10">
                                            <input disabled class="form-control" type="text" value="<?php if($_SESSION['sideMenuDetail']->sideMenuStatus==1){echo "正在使用";}elseif($_SESSION['sideMenuDetail']->sideMenuStatus==0){echo "未使用";} ?>" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜单内容</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <?php
                                                    $attributes = array('id'=>'sideMenuInventory');
                                                    echo form_open('menucontroller/sideMenuInventory',$attributes);
                                                    echo form_close();
                                                    ?>
                                                    <div class="text-muted bootstrap-admin-box-title">菜单小食列表
                                                        <?php
                                                        if(isset($eMsg['wrong'])){
                                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                                        }elseif(isset($eMsg['success'])){
                                                            echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                                                        }
                                                        ?>
                                                        <button form="sideMenuInventory" class="btn btn-sm btn-success" style="float: right;margin-right: 5px;">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            修改库存
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>小食ID</th>
                                                            <th>小食名</th>
                                                            <th>单价</th>
                                                            <th>库存</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $num = count($_SESSION['sideMenuItems']);
                                                        echo '<input form="sideMenuInventory" type="hidden" name="menu" value="'.$_SESSION['sideMenuDetail']->sideMenuID.'"/>';
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<input form="sideMenuInventory" type="hidden" name="side'.$i.'" value="'.$_SESSION['sideMenuItems'][$i]->sid.'"/>';
                                                            echo '<td>'.$_SESSION['sideMenuItems'][$i]->sid.'</td>';
                                                            echo '<td>'.$_SESSION['sideMenuItems'][$i]->sname.'</td>';
                                                            echo '<td>'."$".$_SESSION['sideMenuItems'][$i]->sprice.'</td>';
                                                            echo '<td>';
                                                            echo '<input form="sideMenuInventory" class="form-control" style="width:15%;" type="text" name="inventory'.$i.'" value="'.$_SESSION['sideMenuItems'][$i]->sinventory.'" required />';
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
