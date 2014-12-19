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
                    <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size">
                        <li class="text">页面显示比例:</li>
                        <li><a class="size-changer small">小</a></li>
                        <li><a class="size-changer large active">大</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $username; ?> <i class="caret"></i></a>
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
                    echo anchor('admincontroller/showAdminLogin','Copex 订餐系统-控制面板',$attributes);
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
                    <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 5. 会员管理</a>
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
                    <div class="page-header bootstrap-admin-content-title">
                        <h1>Bootstrap 3.x Admin's Theme</h1>
                        <a href="https://github.com/meritoo/Bootstrap-3-Admin-Theme" class="action btn">
                            Go to GitHub &raquo;
                        </a>
                        <a href="https://github.com/meritoo/Bootstrap-3-Admin-Theme/archive/master.zip" class="action">
                            <button class="btn btn-success">Download (.zip)</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">Details</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <li>An admin theme built with <a href="http://getbootstrap.com" target="_blank">Bootstrap 3.x.</a></li>
                                <li>Free for personal and commercial use</li>
                                <li>Inspired by and based on <a href="https://github.com/VinceG/Bootstrap-Admin-Theme" target="_blank">Bootstrap-Admin-Theme</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">Source</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <li>
                                    <a href="https://github.com/meritoo/Bootstrap-3-Admin-Theme" target="_blank">Github Repository</a>
                                </li>
                                <li>
                                    <a href="https://github.com/meritoo/Bootstrap-3-Admin-Theme/archive/master.zip">Download (.zip package)</a>
                                </li>
                                <li>
                                    License: MIT (see below)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">License</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <p>The MIT License (MIT)</p>
                            <p>Copyright © 2013 - Meritoo.pl &lt;github [at] meritoo [dot] pl&gt;</p>
                            <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:</p>
                            <p>The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.</p>
                            <p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="bs-docs-masthead">
                        <a href="http://getbootstrap.com" target="_blank">
                            <h1>Bootstrap</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 meritoo-logo">
                    <a href="http://www.meritoo.pl" target="_blank">
                        <img src="images/logo-meritoo.png" alt="Meritoo.pl">
                        <span>Internet software house</span>
                    </a>
                </div>
            </div>

            <div class="row row-urls">
                <div class="col-md-6">
                    <a href="http://getbootstrap.com" target="_blank">Bootstrap 3.x</a>
                </div>
                <div class="col-md-6">
                    <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a>
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
                    <p class="left">Bootstrap 3.x Admin Theme</p>
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
</body>
</html>
