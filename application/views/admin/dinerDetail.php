<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/21/2014
 * Time: 4:47 PM
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
            <h1>餐厅管理</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default bootstrap-admin-no-table-panel">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">参看餐厅详情并编辑
                    <?php
                    $attributes = array('class'=>'btn btn-sm btn-danger','type'=>'reset','style'=>'float: right;');
                    echo anchor('#','<i class="glyphicon glyphicon-remove"> 删除本餐厅</i>',$attributes);
                    ?>
                    <?php
                    $attributes = array('class'=>'btn btn-sm btn-success','type'=>'reset','style'=>'float:right;margin-right:5px;');
                    echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-backward"> 回餐厅列表</i>',$attributes);
                    ?>
                </div>
            </div>
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <div class="form-horizontal">
                    <fieldset>
                        <legend>餐厅详情
                            <?php
                            if(isset($eMsg['wrong'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                            } elseif(isset($eMsg['success'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                            }elseif(isset($eMsg['deletesuccess'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                            }elseif(isset($eMsg['addsuccess'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['addsuccess'].'</b></span>';
                            }
                            ?>
                        </legend>
                        <?php
                        $attributes = array('id'=>'editDiner');
                        echo form_open('dinercontroller/editDiner',$attributes);
                        echo form_close();
                        ?>
                        <?php
                        $attributes = array('id'=>'deleteCampus');
                        echo form_open('dinercontroller/deleteSupportCampus',$attributes);
                        echo form_close();
                        ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="focusedInput">餐厅ID</label>
                            <div class="col-lg-10">
                                <input readonly form="editDiner" type="text" class="form-control" name="did" value="<?php echo $_SESSION['diner']['did']; ?>"/>
                                <span class="help-block">已有餐厅ID不能变更</span>
                            </div>
                        </div>
                        <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                            <label class="col-lg-2 control-label">餐厅名</label>
                            <div class="col-lg-10">
                                <input form="editDiner" class="form-control" type="text" name="dname" value="<?php echo $_SESSION['diner']['dname'];?>"/>
                                <span class="help-block">餐厅名不能为空</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="disabledInput">餐厅联系人</label>
                            <div class="col-lg-10">
                                <input form="editDiner" class="form-control" type="text" name="contact" value="<?php echo $_SESSION['diner']['contact'];?>"/>
                                <span class="help-block">联系人可以缺省</span>
                            </div>
                        </div>
                        <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                            <label class="col-lg-2 control-label" for="optionsCheckbox2">餐厅电话</label>
                            <div class="col-lg-10">
                                <input form="editDiner" class="form-control" type="text" name="dphone" value="<?php echo $_SESSION['diner']['dphone'];?>"/>
                                    <span class="help-block">请输入10位有效电话号码，不能为空</span>
                            </div>
                        </div>
                        <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                            <label class="col-lg-2 control-label" for="optionsCheckbox2">E-mail</label>
                            <div class="col-lg-10">
                                <input form="editDiner" class="form-control" type="text" name="demail" value="<?php echo $_SESSION['diner']['demail'];?>"/>
                                <span class="help-block">请输入合法电子邮箱地址</span>
                            </div>
                        </div>
                        <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                            <label class="col-lg-2 control-label" for="optionsCheckbox2">餐厅地址</label>
                            <div class="col-lg-10">
                                <input form="editDiner" class="form-control" type="text" name="daddr" value="<?php echo $_SESSION['diner']['daddr'];?>"/>
                                <span class="help-block">餐厅地址不能为空！</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="optionsCheckbox2">餐厅供给的校区列表</label>
                            <div class="col-lg-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="text-muted bootstrap-admin-box-title">供给校区如下
                                            <button style="float: right;" form="deleteCampus" class="btn btn-sm btn-danger">
                                                <i class="glyphicon glyphicon-remove"></i>
                                                删除供给校区
                                            </button>
                                            <?php
                                            if(isset($eMsg['delerror'])){
                                                echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['delerror'].'</b></span>';
                                            }
                                            ?>
                                            <?php
                                            if(isset($eMsg['deletesuccess'])){
                                                echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="bootstrap-admin-panel-content">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>校区ID</th>
                                                <th>校区名</th>
                                                <th>删除校区</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $num = count($_SESSION['diner']['cid']);
                                            for($i = 0;$i<$num; $i++){
                                                echo '<tr>';
                                                echo '<th>'.$_SESSION['diner']['cid'][$i].'</th>';
                                                echo '<th>'.$_SESSION['diner']['cname'][$i].'</th>';
                                                echo '<th>'.'<input form="deleteCampus" type="checkbox" name="campus'.$i.'" value="'.$_SESSION['diner']['cid'][$i].'"/></th>';
                                                echo '</tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="optionsCheckbox2">添加给餐校区</label>
                            <div class="col-lg-10">
                                <span>
                                <?php
                                $num_campus = count($campus);
                                for($j = 0; $j<$num_campus; $j++){
                                    echo '<label style="padding-right: 15px;">';
                                    echo '<input form="editDiner" type="checkbox"';
                                    for($i = 0;$i<$num; $i++){
                                        if($_SESSION['diner']['cid'][$i]==$campus[$j]->cid){
                                            echo "disabled ";
                                        }
                                    }
                                    echo 'name="add_campus'.$j.'" value="'.$campus[$j]->cid.'"/>';
                                    echo "  ".$campus[$j]->cname;
                                    echo '</label>';
                                }
                                echo "  已有校区不能添加";
                                ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="textarea-wysihtml5">餐厅描述</label>
                            <div class="col-lg-10">
                                <textarea form="editDiner" id="textarea-wysihtml5" name="dinfo" class="form-control textarea-wysihtml5" style="width: 100%; height: 200px" value="<?php echo $_SESSION['diner']['dinfo'];?>"></textarea>
                            </div>
                        </div>
                        <button form="editDiner" type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                        </button>
                        <?php
                        $did = $_SESSION['diner']['did'];
                        $attributes = array('class'=>'btn btn-default','type'=>'reset','style'=>'margin-right: 5px;');
                        echo anchor("dinercontroller/showDinerDetail/$did",'<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes);

                        $attributes1 = array('class'=>'btn btn-success','type'=>'reset');
                        echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-backward"> 回餐厅列表</i>',$attributes1);
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
