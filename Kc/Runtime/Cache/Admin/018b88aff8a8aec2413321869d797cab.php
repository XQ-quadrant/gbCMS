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
        <h3>Forms</h3>
        <div class="grid_3 grid_5">
            <h3>Tabs</h3>
            <div class="but_list">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">模型列表</a></li>
                        <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">添加</a></li>
                        <!--<li role="presentation" class="dropdown">
                            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">@fat</a></li>
                                <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a></li>
                            </ul>
                        </li>-->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                            <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
                                <div class="panel-body no-padding">
                                    <table class="table table-striped">
                                        <thead>

                                        <tr class="warning">
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><tr>
                                            <td><?php echo ($vo["id"]); ?></td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr><?php endforeach; endif; ?>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                            <form role="form" class="form-horizontal" id="form-register" method="post" >
                                <div class="form-group">
                                    <label class="col-md-2 control-label">名称<span class="font-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-envelope-o"></i>
									</span>
                                            <input name="name" id="name"  type="text" class="form-control1" placeholder="名称">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">上级栏目<span class="font-red">*</span></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-thumbs-o-up"></i>
									</span>
                                            <input name="pre_cate" id="pre_cate"  type="number" class="form-control1" value="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p class="help-block">上级栏目编号</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="model" class="col-sm-2 control-label">模型<span class="font-red">*</span></label>
                                    <div class="col-sm-8" id="model">
                                        <div class="checkbox-inline"><label><input type="checkbox" name="model[]" value=1>基础模型</label></div>
                                        <div class="checkbox-inline"><label><input type="checkbox" name="model[]" value=2>基础模型(评论)</label></div>
                                        <div class="checkbox-inline"><label><input type="checkbox" name="model[]" value=4>下载</label></div>
                                        <div class="checkbox-inline"><label><input type="checkbox" name="model[]" value=3>新闻</label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">优先级</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-gear"></i>
									</span>
                                            <input name="level" id="level" type="text" class="form-control1"  placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p class="help-block">数字0～250</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 ">
                                        <button class="btn-warning btn " type="submit" id="submit-register">保 存</button>
                                        <button class="btn-default btn " type="reset">重 置</button>

                                    </div>
                                </div>

                            </form>
                        </div>
                        <!--<div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>

    </script>

    <script>
        $('#submit-register').click(function() {
            //alert('kk');
            //var name = $('#name').val();
            //var password = $('#password').val();
            var myForm = $('form');
            $.ajax({
                url: '/kechuang4/index.php/Admin/Cate/addCate',
                type: 'post',//提交的方式
                dataType:'json',
                data: myForm.serialize(),
                success: function(data) {
                    //alert(9);
                    alert(data);
                    //这是成功返回的数据，写自己的逻辑
                }
            });
        });
    </script>


            <div class="copy_layout">
                <p>Copyright © 2015 Modern. All Rights Reserved | 技术支持由 <a href="http://www.gearblade.com/" target="_blank">归锋科技</a>提供 </p>
            </div>
        </div>
    </div>

    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Metis Menu Plugin JavaScript -->



<script src="/kechuang4/Public/Bootstrap/js/metisMenu.min.js"></script>
<script src="/kechuang4/Public/Bootstrap/js/custom.js"></script>
</body>
</html>