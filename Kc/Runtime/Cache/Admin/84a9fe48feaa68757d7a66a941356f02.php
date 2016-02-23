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
            
    <div ><!--class="modal-dialog"-->
        <div class="row">
            <div class="col-md-10">
                <div class="modal-content"> <!--style="width: 750px;"-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title"><?php echo ($title); ?></h3>
                        <div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled list-inline" >
                                        <li><a href="#" class="text-muted"><?php echo ($author); ?></a></li>
                                        <li><a href="" class="text-muted"><?php echo ($createtime); ?></a></li>
                                        <li><a href="#" class="text-muted"><i class="fa fa-comment"></i> 584</a></li>
                                        <li><a href="#" class="text-orange"><i class="fa fa-heart"></i> 12k</a></li>

                                    </ul>                            </div>
                                <div class="clearfix"> </div>
                            </div>
                            <!--<h2><?php echo ($title); ?></h2>-->

                        </div>
                    </div>
                    <div class="modal-body"  >



                        <?php echo ($content); ?>

                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div><!-- /.modal-content -->
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>





        </div>
        <div class="copy_layout">
            <p> 技术支持由 <a href="http://www.gearblade.com/" target="_blank">归锋科技</a>提供 </p>
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
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    <script>
        $('#submit').click(function() {
            //alert('kk');
            //var name = $('#name').val();
            //var password = $('#password').val();
            var myForm = $('form');
            $.ajax({
                url: '/kechuang4/index.php/Admin/Article/addAtc',
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