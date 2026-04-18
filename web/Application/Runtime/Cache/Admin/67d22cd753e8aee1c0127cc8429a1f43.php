<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/amazeui.min.css"/>  <!--amazeiu.css-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/myPage.css"/>  <!--myPage.js-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/admin.css">
    <!--<link rel="icon" type="image/png" href="/LibraryWeb-master/Public/i/favicon.png">-->
    <!--<link rel="apple-touch-icon-precomposed" href="/LibraryWeb-master/Public/i/app-icon72x72@2x.png">-->
    <title>修改密码</title>
	<style>
	 .header1 {
			background:#494;
        }
	span {
	color:#494;}
	.am-icon-arrows-alt
	{
	color:#EEF;}
	.admin-fullText
	{
	color:#EEF;}
	.am-icon-users
	{
	color:#EEF;}
	.am-icon-caret-down
	{color:#DDF;}
	</style>
</head>
<body>

<header class="am-topbar am-topbar-inverse admin-header">
<div class = "header1">
    <div class="am-topbar-brand">
        <strong>图书馆图书定位系统</strong>
        <small>后台管理</small>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<em>你好，<?php echo $_SESSION['admin_name'];?></em>
    </div>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
		
			
			
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="<?php echo U('index/information');?>"><span class="am-icon-user"></span> 个人资料</a></li>
                    <li><a href="<?php echo U('Index/changecode');?>"><span class="am-icon-cog"></span> 修改密码</a></li>
                    <li><a href="<?php echo U('Login/logout');?>"><span class="am-icon-power-off"></span> 退出登陆</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span
                    class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
					
			
			
					
        </ul>
    </div>
</div>
</header>
<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list">
                <li><a href="<?php echo U('Index/index');?>"><span class="am-icon-home"></span> 首页</a></li>
                <li><a href="<?php echo U('Index/index');?>"><span class="am-icon-book"></span> 图书信息</a></li>
                <li><a href="<?php echo U('Index/add');?>"><span class="am-icon-edit"></span> 添加图书</a></li>
                <li><a href="<?php echo U('Index/register');?>"><span class="am-icon-user"></span> 添加管理员</a></li>
                <li><a href="<?php echo U('Index/createqr');?>"><span class="am-icon-puzzle-piece"></span> 生成二维码</a></li>
            </ul>
            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> 公告</p>
                    <p>图书馆定位系统测试</p>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar end -->
	
	
	<!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span>修改密码</span></strong> /
                    <small>Code</small>
                </div>
            </div>

            <hr>

            <div align="center" class="am-g am-container" id="my-modal-edit-user">
                <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
                    <fieldset>
                        <p class="login-box-msg" >修改密码</p>
                        <form action="/LibraryWeb-master/index.php/Index/changecode.html//save2" method="post">

                            <div class="am-form-group">
                                <input type="password" name="password"
                                       class="am-form-field am-round" placeholder="旧密码" required/>
                                <!--<input type="text" name="username" placeholder="用户名"/>-->
                                <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                            </div>
							
							
                           


                            <div class="am-form-group">
                                <button type="submit"  style="background:#494" class="am-btn am-btn-primary" onclick= "edit_user(<?php echo ($administrator["workid"]); ?>)">修改</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
	
</div>

	
	
	
	<!--loading model-->
    <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">正在载入...</div>
            <div class="am-modal-bd">
                <span class="am-icon-spinner am-icon-spin"></span>
            </div>
        </div>
    </div>
    <!--./loading model-->

    //到时候用js拿出来
    <div id="get_url" title="/LibraryWeb-master/index.php/Index/edit_user/id/"></div>





	
	
<footer>
    <hr>
    <p class="am-padding-left">© 2016 Test</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/LibraryWeb-master/Public/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/LibraryWeb-master/Public/js/amazeui.min.js"></script>
<script src="/LibraryWeb-master/Public/js/app.js"></script>


</body>
</html>