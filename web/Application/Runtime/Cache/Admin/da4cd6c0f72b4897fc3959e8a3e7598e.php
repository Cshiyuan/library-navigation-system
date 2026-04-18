<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/amazeui.min.css"/>  <!--amazeiu.css-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/myPage.css"/>  <!--myPage.js-->
    <link rel="stylesheet" type="text/css" href="/LibraryWeb-master/Public/css/admin.css">
    <!--<link rel="icon" type="image/png" href="/LibraryWeb-master/Public/i/favicon.png">-->
    <!--<link rel="apple-touch-icon-precomposed" href="/LibraryWeb-master/Public/i/app-icon72x72@2x.png">-->
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
                    <li><a href="<?php echo U('Index/register');?>"><span class="am-icon-user"></span> 修改密码</a></li>
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
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span>图书信息</span></strong> /
                    <small>Table</small>
                </div>
            </div>

            <hr>

			
			<div class="am-g">

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm'}" id="search_info" onchange="window.location=this.value;">
                            <option value="option1">所有类别</option>
                            <option value="option2">马列主义、毛泽东思想、邓小平理论</option>
                            <option value="option3">哲学、宗教</option>
                            <option value="option4">社会科学总论</option>
                            <option value="option5">政治、法律</option>
                            <option value="option6">军事</option>
                            <option value="option7">经济</option>
							<option value="option8">文化、科学、教育、体育</option>
							<option value="option9">语言、文字</option>
							<option value="/LibraryWeb-master/index.php/Index/search">文学</option>
							<option value="option11">艺术</option>
							<option value="option12">历史、地理</option>
							<option value="option13">自然科学总论</option>
							<option value="option14">数理科学与化学</option>
							<option value="option15">天文学、地球科学</option>
							<option value="option16">生物科学</option>
							<option value="option17">医药、卫生</option>
							<option value="option18">农业科学</option>
							<option value="option19">工业技术</option>
							<option value="option20">交通运输</option>
							<option value="option21">航空、航天</option>
							<option value="option22">环境科学、安全科学</option>
							<option value="option23">综合性图书</option>
                        </select>
                    </div>
                </div>
                <!--search start-->
                <div class="am-u-sm-12 am-u-md-3">
                    <form id="search_ajax" method="post" action="/LibraryWeb-master/index.php/Index/search">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" name="search_info" id="search_info" class="am-form-field">
              <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="submit">搜索</button>
              </span>
                        </div>
                    </form>
                </div>
                <!--search end-->


            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <div>


                        <table class="am-table">
                            <thead>
                            <tr>
                                <th>书名</th>
								<th>类别</th>
                                <th>作者</th>
                                <th>出版社</th>
                                <th>是否在架</th>
                                <th>所在书架</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--list start-->
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["book_name"]); ?></td>
									<td><?php echo ($vo["category"]); ?></td>
                                    <td><?php echo ($vo["author"]); ?></td>
                                    <td><?php echo ($vo["pub_house"]); ?></td>
                                    <td><?php echo ($vo["is_onslf"]); ?></td>
                                    <td><?php echo ($vo["slf_name"]); ?></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs ">
                                                <!--//  <form id="edit_ajax" method="post"-->
                                                <!--//        action="/LibraryWeb-master/index.php/Index/edit_book/id/<?php echo ($vo["book_id"]); ?>">-->
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary am-hide-sm-only"
                                                        onclick="edit_ajax(<?php echo ($vo["book_id"]); ?>)">
                                                    <span class="am-icon-pencil-square-o"></span><span>编辑</span>
                                                </button>
                                                <!--// </form>-->
                                                </button>
                                                <form name="input" action="/LibraryWeb-master/index.php/Index/delete/id/<?php echo ($vo["book_id"]); ?>"
                                                      method="post">
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                        <span class="am-icon-trash-o"></span> 删除
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <!--list end-->
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                        <div class="am-f">
                            <div class="yahoo2"><?php echo ($page); ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content end -->

    <!--book edit model-->
    <div class="am-modal am-modal-no-btn" tabindex="-1" id="my-modal-edit-book">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">图书编辑
                <a href="javascript: void(0)" class="am-close am-close-spin"
                   data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                <div id="edit_modal">
                    <form id="edit_form" class="am-form-horizontal" action="/LibraryWeb-master/index.php/Index/Index/index.html/serrch/index.html/search/index.html/search/index.html/search/index.html/index/index.html/index/option1/save" method="post">

                        <div class="am-form-group">
                            <label for="edit_book_name" class="am-u-sm-2 am-form-label">书名：</label>
                            <div class="am-u-sm-10">
                                <input type="text" name="book_name" id="edit_book_name"
                                       class="am-form-field am-round" placeholder="书名" required/>
                            </div>
                            <!--<input type="text" name="username" placeholder="用户名"/>-->
                            <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                        </div>
						
						<div class ="am-form-group">
							<label for="edit_category" class="am-u-sm-2 am-form-label">类别：</label>
							<div class="am-u-sm-10">
							<input type="text" name="category" id="edit_category"
                                       class="am-form-field am-round" placeholder="类别"
                                       required/>
                            </div>
                        </div>
						
                        <div class="am-form-group">
                            <label for="edit_author" class="am-u-sm-2 am-form-label">作者：</label>
                            <div class="am-u-sm-10">
                                <input type="text" name="author" id="edit_author"
                                       class="am-form-field am-round" placeholder="作者"
                                       required/>
                            </div>
                        </div>
						
                        <div class="am-form-group">
                            <label for="edit_pub_house" class="am-u-sm-2 am-form-label">出版社：</label>
                            <div class="am-u-sm-10">
                                <input type="text" name="pub_house" id="edit_pub_house"
                                       class="am-form-field am-round" placeholder="出版社" required/>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="edit_slf_name" class="am-u-sm-2 am-form-label">所在书架：</label>
                            <div class="am-u-sm-10">
                                <input type="text" name="slf_name" id="edit_slf_name"
                                       class="am-form-field am-round" placeholder="所在书架" required/>
                            </div>
                        </div>
                        
						<div class="am-form-group">
                            <label for="edit_is_onslf" class="am-u-sm-2 am-form-label">是否在架：</label>
                            <div class="am-u-sm-10">
                                <input type="text" name="is_onslf" id="edit_is_onslf"
                                       class="am-form-field am-round" placeholder="是否在架 (在填1，不在填0)" required/>
                            </div>
                        </div>
						
						
                        <div class="am-form-group">
                            <button type="submit" style="background:#494" class="am-btn am-btn-primary">修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--./book edit model-->
	
	
	

	
	
	
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
    <div id="get_url" title="/LibraryWeb-master/index.php/Index/edit_book/id/"></div>
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
<!--thinkphp ajax-->
<script src="/LibraryWeb-master/Public/js/Jquery/jquery.js"></script>

<!--./thinkphp ajax-->
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/LibraryWeb-master/Public/js/jquery.min.js"></script>
<script src="/LibraryWeb-master/Public/js/Jquery/jquery.form.js"></script>
<!--<![endif]-->
<script src="/LibraryWeb-master/Public/js/amazeui.min.js"></script>
<!--其中有全屏实现，和图书查询的ajax实现代码-->
<script src="/LibraryWeb-master/Public/js/app.js"></script>

</body>
</html>