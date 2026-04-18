<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">

    <!-- 样式设置 -->
    <link href="/LibraryWeb/Public/lib/bootstrap.min.css" rel="stylesheet">
    <link href="/LibraryWeb/Public/css/common.css" rel="stylesheet">
    <link href="/LibraryWeb/Public/css/iconfont/iconfont.css" rel="stylesheet">

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
     .header1.am-topbar-brand
     {
     }
	span {
	color:#494;  }
	.am-icon-arrows-alt
	{
	color:#EEF;
    }
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
                    <li><a href="<?php echo U('index/changecode');?>"><span class="am-icon-cog"></span> 修改密码</a></li>
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
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span>添加图书</span></strong> /
                    <small>Table</small>
                </div>
            </div>

            <hr>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-sm-centered">
                    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
                        <fieldset>
                            <p class="login-box-msg">添加图书</p>
                            <form action="/LibraryWeb/index.php/Index/add.html" method="post" enctype="multipart/form-data">

                                <div class="am-form-group">
                                    <input type="text" name="book_name"
                                           class="am-form-field am-round" placeholder="书名" required/>
                                    <!--<input type="text" name="username" placeholder="用户名"/>-->
                                    <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                                </div>
								
								
								<div class="am-form-group">
                                    <input type="text" name="category"
                                           class="am-form-field am-round" placeholder="类别"
                                           required/>
                                </div>
								
                                <div class="am-form-group">
                                    <input type="text" name="author"
                                           class="am-form-field am-round" placeholder="作者"
                                           required/>
                                </div>
                                <div class="am-form-group">
                                    <input type="text" name="pub_house"
                                           class="am-form-field am-round" placeholder="出版社" required/>
                                </div>
                                <div class="am-form-group">
                                    <input type="text" name="slf_name"
                                           class="am-form-field am-round" placeholder="所在书架" required/>
                                </div>
                                <div class="am-form-group">
                                    <input type="text" name="is_onslf"
                                           class="am-form-field am-round" placeholder="是否在架 (在填1，不在填0)" required/>
                                </div>
                                <div class="am-form-group">
                                   封面： <input type="file" name="photo" />
                                </div>
                                <div class="am-form-group">
                                    <button type="submit" style="background:#494" class="am-btn am-btn-primary">添加图书</button>
                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <!--container start-->
                    <div class="container">
                        <!--地图map 容器-->
                        <p class="login-box-msg">室内地图</p>
                        <div id="map-container"></div>
                        <!-- 缩放按钮组 -->
                        <div class="zoom-group btn-group-vertical" data-toggle="buttons">
                            <button id="btnZoomIn" class="btn btn-default">+</button>
                            <button id="btnZoomOut" class="btn btn-default">-</button>
                        </div>
                        <!-- data-backdrop="false" -->
                        <div id="dlgModelInfo" class="modal fade">
                            <div class="modal-dialog bottom">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-3">地址</div>
                                                <div class="col-md-9" id="address"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">营业时间</div>
                                                <div class="col-md-9" id="businesshour"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!--container end-->

                </div>
            </div>
        </div>
    </div>
    <!--content end-->

</div>

<footer>
    <hr>
    <p class="am-padding-left">© 2016 Test</p>
</footer>



<!--室内地图的JS-SDK-->
<script src="/LibraryWeb/Public/lib/fengmap.min.js"></script>
<script src="/LibraryWeb/Public/lib/jquery.nicescroll.js"></script>
<script src="/LibraryWeb/Public/lib/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<!-- 妹子UI -->
<script src="/LibraryWeb/Public/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/LibraryWeb/Public/js/amazeui.min.js"></script>
<script src="/LibraryWeb/Public/js/app.js"></script>




<script type="text/javascript">
    //定义全局map变量
    var map;
    $(function () {
        map = new fengmap.FMMap({
            container: $('#map-container')[0],
//            mapServerURL: '/LibraryWeb/Public/data/00205100000590132',
//            mapThemeURL: '/LibraryWeb/Public/data/theme',
//            useStatic: true
        });


//        map.on('loadComplete', function () {
//            //初始化右边图层控制控件
//            layerGroup.init(map.listGroups, map.focusGroupID);
//            //resize(300, 300);
//
//            //map.scaleLevel = 3.5;
//            //map.fullScreen = true;
//        });
        map.openMapById('00205100000590132');//sceneId

        //显示指南针
        map.showCompass = true;

        $('#btnZoomIn').on('click', function () {
            map.zoomIn();
        });

        $('#btnZoomOut').on('click', function () {
            map.zoomOut();
        });
    });
</script>
</body>
</html>