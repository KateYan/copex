<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 11:19 PM
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
                            <div class="text-muted bootstrap-admin-box-title">编辑主食</div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>菜品内容：</legend>
                                    <?php
                                    $attributes_1 = array('id'=>'editFood');
                                    echo form_open_multipart('dishcontroller/editFood',$attributes_1);
                                    echo form_close();

                                    $attributes_2 = array('id'=>'upload');
                                    echo form_open_multipart('dishcontroller/upload',$attributes_2);
                                    echo form_close();

                                    ?>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜品ID</label>
                                        <div class="col-lg-10">
                                            <input form="editFood" class="form-control" type="text" name="foodId" value="<?php echo $_SESSION['food']->fid; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">菜名</label>
                                        <div class="col-lg-10">
                                            <input form="editFood" class="form-control" type="text" name="vipNumber" value="<?php echo $_SESSION['food']->fname; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">价格</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-right-radius:0px;border-top-right-radius: 0px; ">$</span>
                                                <input form="editFood" class="form-control" type="text" name="fprice" value="<?php echo $_SESSION['food']->fprice; ?>"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">烹饪餐厅</label>
                                        <div class="col-lg-10">
                                            <input form="editFood" class="form-control" type="text" value="<?php echo $_SESSION['food']->dname; ?>" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg)){echo " has-error";}?>">
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
                                                            <a href="#" class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 100%; height: 100%;" src="/copex/upload/<?php echo  $_SESSION['food']->fpicture;?>.jpg">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg)){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="textarea-wysihtml5">简介</label>
                                        <div class="col-lg-10">
                                            <textarea form="editFood" id="textarea-wysihtml5" name="fdes" class="form-control textarea-wysihtml5" style="width: 100%; height: 200px" value="<?php echo $_SESSION['food']->fdes;?>"></textarea>

                                            <?php
                                            if(isset($eMsg)){
                                                echo '<span class="help-block">'.$eMsg.'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button form="editFood" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes1 = array('class'=>'btn btn-default','type'=>'reset');
                                    echo anchor('dishcontroller/showFoodDetail','<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes1);
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

