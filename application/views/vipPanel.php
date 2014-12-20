<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 8:44 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 12:07 AM
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
                                    echo anchor('admincontroller/showAdminLogin','退出登录',$attributes);
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
            <a href="showAdminPanel"><i class="glyphicon glyphicon-chevron-right"></i> 关于Copex</a>
        </li>
        <li>
            <a href="showOrderManage"><i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理</a>
        </li>
        <li>
            <a href="forms.html"><i class="glyphicon glyphicon-chevron-right"></i> 2. 餐厅管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 3. 菜品管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 4. 菜单管理</a>
        </li>
        <li>
            <a href="../vipcontroller/showVipPanel"><i class="glyphicon glyphicon-chevron-right"></i> 5. 会员管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 6. 基本管理</a>
        </li>
        <li>
            <a href="buttons-and-icons.html"><i class="glyphicon glyphicon-chevron-right"></i> Buttons &amp; Icons</a>
        </li>
        <li>
            <a href="wysiwyg-editors.html"><i class="glyphicon glyphicon-chevron-right"></i> WYSIWYG Editors</a>
        </li>
        <li>
            <a href="ui-and-interface.html"><i class="glyphicon glyphicon-chevron-right"></i> UI &amp; Interface</a>
        </li>
        <li>
            <a href="error-pages.html"><i class="glyphicon glyphicon-chevron-right"></i> Error pages</a>
        </li>
    </ul>
</div>

<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>VIP-会员管理</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        $attributes = array('id'=>'editVip');
        echo form_open('vipcontroller/editVip',$attributes);
        echo form_close();
        ?>
        <?php
        $attributes = array('id'=>'addVip');
        echo form_open('admincontroller/addVip',$attributes);
        echo form_close();
        ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">会员列表--(点击用户Id编辑VIP用户信息)
                        <button form="addVip" class="btn btn-sm btn-success" style="float: right;">
                            <i class="glyphicon glyphicon-plus"></i>
                             添加会员
                        </button>
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>用户Id</th>
                            <th>校区</th>
                            <th>VIP-Id</th>
                            <th>电话</th>
                            <th>历史</th>
                            <th>注册日期</th>
                            <th>会员卡号</th>
                            <th>会员卡余额</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!isset($vipUser)){
                            echo "暂时没有会员，点击右上按钮添加。";
                        }
                        $num = count($vipUser);
                        for($i=0;$i<$num;$i++){
                            echo '<tr>';
                            echo '<td><a href="showEditVip?vipUser='.$vipUser[$i]->uid.'">';
                            echo $vipUser[$i]->uid;
                            echo '</a></td>';
                            echo '<td>'.$vipUser[$i]->cname.'</td>';
                            echo '<td>'.$vipUser[$i]->vipid.'</td>';
                            echo '<td>'.$vipUser[$i]->uphone.'</td>';
                            if($vipUser[$i]->ordered==0){
                                echo '<td>'."新用户".'</td>';
                            }else{
                                echo '<td>'."老用户".'</td>';
                            }
                            echo '<td>'.$vipUser[$i]->created.'</td>';
                            echo '<td>'.$vipUser[$i]->vnumber.'</td>';
                            echo '<td>'.$vipUser[$i]->vbalance.'</td>';
                            echo '</tr>';
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
</div>

<!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Copex 订餐管理系统</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/copex/bootstrap/js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/DT_bootstrap.js"></script>
</body>
</html>
