<?php if (!defined('THINK_PATH')) exit();?><!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE HTML>
<html>

    <head>
    <title>Modern an Admin Panel Category Flat Bootstarp Resposive Website Template | Compose :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="/kechuang4/Public/Bootstrap/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        
    <!-- Custom CSS -->
    <link href="/kechuang4/Public/Bootstrap/css/style.css" rel='stylesheet' type='text/css' />
    <link href="/kechuang4/Public/Bootstrap/css/font-awesome.css" rel="stylesheet">
            <!-- Nav CSS -->
            <link href="/kechuang4/Public/Bootstrap/css/custom.css" rel="stylesheet">
            <!----webfonts--->
<!--
            <link href='http://fonts.useso.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
-->
            <!---//webfonts--->
        
    <!-- jQuery -->
    <script src="/kechuang4/Public/Bootstrap/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/kechuang4/Public/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Modern</a>
        </div>
        <!-- /.navbar-header -->

        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" value="Search..." onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search...';}">
        </form>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php tag('cate'); ?>
                <!--<ul class="nav" id="side-menu">
                    <li>
                        <a href="index.html"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-laptop nav_icon"></i>Layouts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="grids.html">Grid System</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-indent nav_icon"></i>Menu Levels<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="graphs.html">Graphs</a>
                            </li>
                            <li>
                                <a href="typography.html">Typography</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope nav_icon"></i>Mailbox<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="inbox.html">Inbox</a>
                            </li>
                            <li>
                                <a href="compose.html">Compose email</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                    <li>
                        <a href="widgets.html"><i class="fa fa-flask nav_icon"></i>Widgets</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-check-square-o nav_icon"></i>Forms<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="forms.html">Basic Forms</a>
                            </li>
                            <li>
                                <a href="validation.html">Validation</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table nav_icon"></i>Tables<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="basic_tables.html">Basic Tables</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw nav_icon"></i>Css<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="media.html">Media</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                        </ul>
                        &lt;!&ndash; /.nav-second-level &ndash;&gt;
                    </li>
                </ul>-->
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="graphs" style="font-family: '微软雅黑', 'Helvetica Neue', Helvetica, Arial, sans-serif">
            

    <div class="xs">
        <h3>编辑</h3>

        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <form class="form-horizontal form">
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">标题</label>

                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control1" id="focusedinput" value=<?php echo ($title); ?>>
                        </div>
                        <div class="col-sm-2">
                            <p class="help-block">120字以内</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mediuminput" class="col-sm-2 control-label">作者</label>

                        <div class="col-sm-4">
                            <input type="text" name="author" class="form-control1 input-sm" id="mediuminput"
                                   value=<?php echo ($author); ?>>
                        </div>
                    </div>


                    <div class="form-group mb-n">
                        <label for="myEditor" class="col-sm-2 control-label label-input-lg">正文</label>

                        <div class="col-sm-8">
                            <textarea id="myEditor" name="content"><?php echo ($content); ?></textarea>
                            <!--<script id="container" name="content" type="text/plain" style="width:100%;">


                            </script>-->
                        </div>
                    </div>
                    <hr>

                </form>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">

                            <button id="submit" class="btn-success btn">提交</button>
                            <button class="btn-default btn">预览</button>
                            <!--<button class="btn-inverse btn">Reset</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




            <div class="copy_layout">
                <p>Copyright © 2015 Modern. All Rights Reserved | 技术支持由 <a href="http://www.gearblade.com/" target="_blank">归锋科技</a>提供 </p>
            </div>
        </div>
    </div>

    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Metis Menu Plugin JavaScript -->

    <!-- 配置文件 -->
    <script type="text/javascript" src="/kechuang4/Public/editor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/kechuang4/Public/editor/ueditor.all.js"></script>
    <script type="text/javascript" src="/kechuang4/Public/editor/ueditor.parse.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        //var ue = UE.getEditor('container');
        UE.getEditor("myEditor",{serverUrl: '/kechuang4/Public/editor/php/controller.php'});
        /*uParse('.ccc', {
            rootPath: '/kechuang4/Public/editor/'
        })*/


        //ue.getEditor('myEditor', {serverUrl: '/server/ueditor/controller.php'})


    </script>
    <script>
        $('#submit').click(function() {
            //alert('kk');
            //var name = $('#name').val();
            //var password = $('#password').val();
            var myForm = $('form');
            $.ajax({
                url: '/kechuang4/index.php/Admin/Article/editor/id/<?php echo ($id); ?>',
                type: 'post',//提交的方式
                dataType:'json',
                data: myForm.serialize(),
                success: function(data) {
                    alert(data.msg);
                    if(data.status==1){
                        window.location.href=document.referrer;
                    }

                    //这是成功返回的数据，写自己的逻辑
                }
            });
        });
    </script>

<script src="/kechuang4/Public/Bootstrap/js/metisMenu.min.js"></script>
<script src="/kechuang4/Public/Bootstrap/js/custom.js"></script>
</body>
</html>