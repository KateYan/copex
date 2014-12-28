<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/28/2014
 * Time: 11:04 AM
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
                            <div class="text-muted bootstrap-admin-box-title">添加菜单
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-success','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-backward"> 回菜单列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>添加新菜单
                                        <?php
                                        if(isset($eMsg['wrong'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                        } elseif(isset($eMsg['success'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                                        }elseif(isset($eMsg['deletesuccess'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                                        }
                                        //                            $attributes = array('class'=>'btn btn-sm btn-success','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                        //                            echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-backward"> 回餐厅列表</i>',$attributes);
                                        ?>
                                    </legend>
                                    <?php
                                    $attributes = array('id'=>'addMenu');
                                    echo form_open('menucontroller/addMenu',$attributes);
                                    echo form_close();
                                    ?>
                                    <?php
                                    $attributes = array('id'=>'deleteCampus');
                                    echo form_open('dinercontroller/deleteSupportCampus',$attributes);
                                    echo form_close();
                                    ?>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">校区</label>
                                        <div class="col-lg-10">
                                            <input form="addMenu" class="form-control" type="text" name="dname" />
                                            <span class="help-block">设置该校区主食菜单</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="disabledInput">添加推荐菜品</label>
                                        <div class="col-lg-10">
                                            <input form="addMenu" class="form-control" type="text" name="contact" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">添加第一个特价菜品</label>
                                        <div class="col-lg-10">
                                            <input form="addMenu" class="form-control" type="text" name="dphone" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">添加第二个特价菜品</label>
                                        <div class="col-lg-10">
                                            <input form="addMenu" class="form-control" type="text" name="demail" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

<!--                                    <div class="form-group">-->
<!--                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">添加供给餐厅</label>-->
<!--                                        <div class="col-lg-10">-->
<!--                                            <span>-->
<!--                                            --><?php
//                                            $num_campus = count($campus);
//                                            for($j = 0; $j<$num_campus; $j++){
//                                                echo '<label style="padding-right: 15px;">';
//                                                echo '<input form="addDiner" type="checkbox"';
//                                                echo 'name="add_campus'.$j.'" value="'.$campus[$j]->cid.'"/>';
//                                                echo "  ".$campus[$j]->cname;
//                                                echo '</label>';
//                                            }
//                                            echo "  供给餐厅还可以稍后在餐厅编辑中添加";
//                                            ?>
<!--                                            </span>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <button form="addMenu" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
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
