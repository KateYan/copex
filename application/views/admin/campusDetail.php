<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/29/2014
 * Time: 10:08 AM
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
                        <h1>校区管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">参看校区详情并编辑
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-danger','type'=>'reset','style'=>'float: right;');
                                echo anchor('campuscontroller/deleteCampus','<i class="glyphicon glyphicon-remove"> 删除本校区</i>',$attributes);

                                $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;margin-right:5px;');
                                echo anchor('campuscontroller/showAddPickupPlace','<i class="glyphicon glyphicon-plus"></i>
                                         添加取餐地点',$attributes);

                                ?>
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回校区管理主页</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>校区详情
                                        <?php
                                        if(isset($eMsg['wrong'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                        } elseif(isset($eMsg['success'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
                                        }elseif(isset($eMsg['deletesuccess'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                                        }elseif(isset($eMsg['addsuccess'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['addsuccess'].'</b></span>';
                                        }elseif(isset($eMsg['nodelete'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['nodelete'].'</b></span>';
                                        }
                                        ?>
                                    </legend>
                                    <?php
                                    $attributes = array('id'=>'editCampus');
                                    echo form_open('campuscontroller/editCampus',$attributes);
                                    echo form_close();

                                    $attributes = array('id'=>'removeSupportDiner');
                                    echo form_open('campuscontroller/removeSupportDiner',$attributes);
                                    echo form_close();

                                    $attributes = array('id'=>'removePickupPlace');
                                    echo form_open('campuscontroller/removePickupPlace',$attributes);
                                    echo form_close();
                                    ?>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">校区ID</label>
                                        <div class="col-lg-10">
                                            <input readonly form="editCampus" type="text" class="form-control" name="cid" value="<?php echo $_SESSION['campus']['cid']; ?>"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">校区名</label>
                                        <div class="col-lg-10">
                                            <input form="editCampus" class="form-control" type="text" name="cname" value="<?php echo $_SESSION['campus']['cname'];?>"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">校区地址</label>
                                        <div class="col-lg-10">
                                            <input form="editCampus" class="form-control" type="text" name="caddr" value="<?php echo $_SESSION['campus']['caddr'];?>"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">包含取餐地点列表</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">取餐地点如下
                                                        <button style="float: right;" form="removePickupPlace" class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                            删除取餐地点
                                                        </button>
                                                        <?php
                                                        if(isset($eMsg['delAPlaceError'])){
                                                            echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['delAPlaceError'].'</b></span>';
                                                        } elseif(isset($eMsg['deletePlaceSuccess'])){
                                                            echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['deletePlaceSuccess'].'</b></span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>取餐地点ID</th>
                                                            <th>地点名称</th>
                                                            <th>具体地址</th>
                                                            <th>删除地点</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $num = count($_SESSION['campus']['placeID']);
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<th>'.$_SESSION['campus']['placeID'][$i].'</th>';
                                                            echo '<th>'.$_SESSION['campus']['placeName'][$i].'</th>';
                                                            echo '<th>'.$_SESSION['campus']['placeAddr'][$i].'</th>';
                                                            echo '<th>'.'<input form="removePickupPlace" type="checkbox" name="place" value="'.$_SESSION['campus']['placeID'][$i].'"/></th>';
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
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">配餐来源餐厅列表</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">配餐餐厅如下
                                                        <button style="float: right;" form="removeSupportDiner" class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                            删除配餐餐厅
                                                        </button>
                                                        <?php
                                                        if(isset($eMsg['delerror'])){
                                                            echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['delerror'].'</b></span>';
                                                        } elseif(isset($eMsg['deletesuccess'])){
                                                            echo '<span style="color: #be2221;float:right;"><b>'.$eMsg['deletesuccess'].'</b></span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>餐厅ID</th>
                                                            <th>餐厅名</th>
                                                            <th>删除餐厅</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $num = count($_SESSION['campus']['did']);
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<th>'.$_SESSION['campus']['did'][$i].'</th>';
                                                            echo '<th>'.$_SESSION['campus']['dname'][$i].'</th>';
                                                            echo '<th>'.'<input form="removeSupportDiner" type="checkbox" name="diner'.$i.'" value="'.$_SESSION['campus']['did'][$i].'"/></th>';
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
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">添加配餐餐厅</label>
                                        <div class="col-lg-10">
                                            <span>
                                            <?php
                                            $num_diners = count($diners);
                                            for($j = 0; $j<$num_diners; $j++){
                                                echo '<label style="padding-right: 15px;">';
                                                echo '<input form="editCampus" type="checkbox"';
                                                for($i = 0;$i<$num; $i++){
                                                    if($_SESSION['campus']['did'][$i]==$diners[$j]->did){
                                                        echo "disabled ";
                                                    }
                                                }
                                                echo 'name="add_diner'.$j.'" value="'.$diners[$j]->did.'"/>';
                                                echo "  ".$diners[$j]->dname;
                                                echo '</label>';
                                            }
                                            echo "  已有餐厅不能添加";
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                    <button form="editCampus" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes = array('type'=>'reset','class'=>'btn btn-default');
                                    echo anchor('campuscontroller/showCampusDetail','<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes);

                                    $attributes1 = array('class'=>'btn btn-success','type'=>'reset','style'=>'margin-left:5px;');
                                    echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回基本管理主页</i>',$attributes1);
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
