<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/5/2015
 * Time: 3:56 PM
 */
?>
<!-- Vendors -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/datepicker.fixes.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/uniform/themes/default/css/uniform.default.min.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/uniform.default.fixes.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/chosen.min.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/selectize/dist/css/selectize.bootstrap3.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

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
                        <h1>菜品管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">编辑小食
                                <?php
                                $attributes2 = array('class'=>'btn btn-sm btn-success','type'=>'reset','style'=>'margin-left:5px;','style'=>'float:right;');
                                echo anchor('dishcontroller/goback','<i class="glyphicon glyphicon-backward"> 回菜品列表</i>',$attributes2);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>菜品内容：
                                        <?php
                                        if(isset($eMsg['wrong'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                        } elseif(isset($eMsg['success'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                                        }
                                        ?>
                                    </legend>
                                    <?php
                                    $attributes_1 = array('id'=>'editSideDish');
                                    echo form_open('dishcontroller/editSideDish',$attributes_1);
                                    echo form_close();

                                    $attributes_2 = array('id'=>'uploadSideDish');
                                    echo form_open_multipart('dishcontroller/uploadSideDish',$attributes_2);
                                    echo form_close();

                                    ?>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜品ID</label>
                                        <div class="col-lg-10">
                                            <input form="editSideDish" class="form-control" type="text" name="dishId" value="<?php echo $_SESSION['side']->sid; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜名</label>
                                        <div class="col-lg-10">
                                            <input form="editSideDish" class="form-control" type="text" name="dishName" value="<?php echo $_SESSION['side']->sname; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">价格</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-right-radius:0px;border-top-right-radius: 0px; ">$</span>
                                                <input form="editSideDish" class="form-control" type="text" name="dishPrice" value="<?php echo $_SESSION['side']->sprice; ?>"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">烹饪餐厅</label>
                                        <div class="col-lg-10">
                                            <input form="editSideDish" class="form-control" type="text" value="<?php echo $_SESSION['side']->dname; ?>" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">变更烹饪餐厅</label>
                                        <div class="col-lg-10">
                                            <span>
                                            <?php
                                            $num = count($diners);
                                            for($j = 0; $j<$num; $j++){
                                                echo '<label style="padding-right: 15px;">';
                                                echo '<input form="editSideDish" type="radio"';

                                                if($_SESSION['side']->did==$diners[$j]->did){
                                                    echo "disabled ";
                                                }

                                                echo 'name="newDiner" value="'.$diners[$j]->did.'"/>';
                                                echo "  ".$diners[$j]->dname;
                                                echo '</label>';
                                            }
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">图片</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">预览</div>
                                                    <div class="pull-right"><span class="badge"></span></div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <div class="row bootstrap-admin-light-padding-bottom">
                                                        <div class="col-md-4">
                                                            <a class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 100%; height: 100%;" src="/copex/upload/side/<?php
                                                                if(isset($_SESSION['upload'])){
                                                                    echo $_SESSION['upload'];
                                                                }else{
                                                                    echo  $_SESSION['side']->spicture;
                                                                }
                                                                ?>">
                                                            </a>
                                                            <?php

                                                            echo '<input form="editSideDish" type="hidden" name="dishPicture" value="';
                                                            if(isset($_SESSION['upload'])){
                                                                echo $_SESSION['upload'];
                                                            }else{
                                                                echo $_SESSION['side']->spicture;
                                                            }
                                                            echo '">';

                                                            ?>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input form="uploadSideDish" class="form-control" type="file" name="userfile" />
                                                            <!--                                                        </div>-->
                                                            <div style="margin-top: 10px;">
                                                                <span style="margin-top: 10px;">

                                                                    <input form="uploadSideDish" type="submit" class="btn btn-sm btn-info" name="picture" value=" 确认上传"/>

                                                                </span>
                                                                <span>
                                                                    <?php
                                                                    $attributes_undo = array('class'=>'btn btn-sm btn-default','type'=>'reset');
                                                                    echo anchor('dishcontroller/undoSideDish',' 取消修改',$attributes_undo);
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="textarea-wysihtml5">简介</label>
                                        <div class="col-lg-10">
                                            <textarea form="editSideDish" id="textarea-wysihtml5" name="dishDes" class="form-control textarea-wysihtml5" style="width: 100%; height: 200px" value="<?php echo $_SESSION['side']->sdes;?>"></textarea>
                                        </div>
                                    </div>
                                    <button form="editSideDish" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes1 = array('class'=>'btn btn-default','type'=>'reset');
                                    echo anchor('dishcontroller/undoSideDish','<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes1);
                                    $attributes2 = array('class'=>'btn btn-success','type'=>'reset','style'=>'margin-left:5px;');
                                    echo anchor('dishcontroller/showDishPanel','<i class="glyphicon glyphicon-backward"> 回菜品列表</i>',$attributes2);
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

