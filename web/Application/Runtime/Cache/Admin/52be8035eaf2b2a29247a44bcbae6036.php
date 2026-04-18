<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/LibraryWeb/Public/css/amazeui.min.css"/>  <!--amazeiu.css-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb/Public/css/myPage.css"/>  <!--myPage.js-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb/Public/css/admin.css">
    <!--<link rel="icon" type="image/png" href="/LibraryWeb/Public/i/favicon.png">-->
    <!--<link rel="apple-touch-icon-precomposed" href="/LibraryWeb/Public/i/app-icon72x72@2x.png">-->
    <title>首页</title>
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
<!--header start-->
<header class="am-topbar am-topbar-inverse admin-header">
<div class = "header1">
    <div class="am-topbar-brand">
        <strong>图书馆图书定位系统</strong>
        <small>后台管理</small>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                    <li><a href="<?php echo U('index/index');?>"><span class="am-icon-cog"></span> 修改密码</a></li>
                    <li><a href="<?php echo U('Login/logout');?>"><span class="am-icon-power-off"></span> 退出登录</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span
                    class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</div>
</header>
<!--header end-->

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
			
			<div style = "position:relative;">
			<img src="\LibraryWeb\Application\Admin\View\images\tupian2.jpg" style="width:100%;height:180px;"/>
			<div style = "position:absolute;left:55px;top:65px">
			<div class = "sub-mainbox">
			
			<script type = "text/javascript">
			
				function disptime() {
				var today = new Date();
				var yr = today.getFullYear();
				var mo = today.getMonth() + 1;
				var dy = today.getDate();
				var hh = today.getHours();
				var mm = today.getMinutes();
				var ss = today.getSeconds();

				document.getElementById("myclock").innerHTML =
				"当前日期:"+yr+"-"+mo+"-"+dy+"<br/>当前时间: "+hh+":"+mm+":"+ss+"";
				}
				setInterval("disptime()", 1000);
			</script>
			
			<div id = "myclock"></div>
			</div>
			</div>
			</div>
			
			
        </div>
    </div>
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span>添加管理员</span></strong> /
                    <small>Table</small>
                </div>
            </div>

            <hr>

            <div align="center" class="am-g am-container">
                <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
                    <fieldset>
                        <p class="login-box-msg">添加一个管理员</p>
                        <form action="/LibraryWeb/index.php/Index/register.html" method="post">

                            <div class="am-form-group">
                                <input type="text" name="admin_name"
                                       class="am-form-field am-round" placeholder="用户名" required/>
                                <!--<input type="text" name="username" placeholder="用户名"/>-->
                                <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                            </div>
                            <div class="am-form-group">
                                <input type="password" name="password"
                                       class="am-form-field am-round" placeholder="密码  (需包含字母数字以及@*#中的一种,长度为6-22位)"
                                       required/>

                            </div>
                            <div class="am-form-group">
                                <input type="password" name="repassword"
                                       class="am-form-field am-round" placeholder="确认密码" required/>

                            </div>
                            <div class="am-form-group">
                                <input type="email" name="email"
                                       class="am-form-field am-round" placeholder="邮箱" required/>

                            </div>
                            <div class="am-form-group">
                                <input type="text" name="telephone"
                                       class="am-form-field am-round" placeholder="手机号码" required/>

                            </div>
                            <div class="am-form-group">
                                <input type="text" name="verify" class="am-form-field am-round" placeholder="验证码"/>
                            </div>
                            <div class="am-form-group">
                                <img class="verify" src="<?php echo U(verify);?>" alt="验证码"
                                     onClick="this.src=this.src+'?'+Math.random()"/>
                            </div>

                            <div class="am-form-group">
                                <button type="submit"  style="background:#494" class="am-btn am-btn-primary">点击注册</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script src="/LibraryWeb/Public/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/LibraryWeb/Public/js/amazeui.min.js"></script>
<script src="/LibraryWeb/Public/js/app.js"></script>


</body>
</html>