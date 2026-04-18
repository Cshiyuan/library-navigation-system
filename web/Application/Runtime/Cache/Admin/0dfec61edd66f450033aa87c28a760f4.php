<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head lang="zh-cmn-Hans">
    <meta charset="UTF-8">
    <title>用户登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/LibraryWeb/Public/i/favicon.png">
    <link rel="stylesheet" href="/LibraryWeb/Public/css/amazeui.min.css"/>
    <style>
		*{
		padding: 0;
		margin: 0;
		}
        .header {
            text-align: center;
			background:#494;
        }

        .header h1 {
            font-size: 250%;
            color: #FFF;
            margin-top: 20px;
        }

        .header p {
            font-size: 14px;
        }
		.sub-mainbox
			{
				width: 400px;
				height: 450px;
				margin: -30px auto 30px auto;
				//border:1px solid white;
				border-radius: 50px;
				background-color:#000;
				/**background:url(\LibraryWeb-master\Application\Admin\View\images/scnu7.jpg) no-repeat center center scroll;**/
				opacity: 0.75;
				filter:alpha(opacity=75);
				position:static; 
				*zoom:1;
			}
		.sub-mainbox label{
			color: #FFFFFF;
			position: relative;/* 设置子元素为相对定位，可让子元素不继承Alpha值，保证字体颜色不透明 */
		}   
	}
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>图书馆图书定位系统</h1>
        <!--<p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>-->
    </div>
</div>


<!--[if lt IE 9]><script src="/resources/js/ie/ie8-responsive-file-warning.js"></script><![endif]-->
 <!--[if lt IE 9]>
  <script src="/resources/js/ie/html5shiv.js"></script>
  <script src="/resources/js/ie/respond.min.js"></script>
 <![endif]-->
	<div class="school-bg">
 	
			<div style = "position:relative;">
 			<img src="\LibraryWeb\Application\Admin\View\images\scnu5.jpg" style="width:100%;height:500px;"/>
			<div style = "position:absolute;left:850px;top:50px">
			<div class = "sub-mainbox">
			<div class="am-g">
				<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
				
					<form action="/LibraryWeb/index.php/Login/login.html" method="post" class="am-form">
						<fieldset><legend><label>管理员登录</label></legend>
							<div class="am-form-group">
								<label>用户名：</label> <input type="text" name="admin_name"
														   class="am-form-field am-round" placeholder="输入用户名 " required/>
							</div>
							<div class="am-form-group ">
								<label>密码:</label> <input type="password" name="password"
														 class="am-form-field am-round" placeholder="输入密码 "/>
							</div>
							<div class="am-form-group">
								<label>验证码:</label><input type="text" name="verify" class="am-form-field am-round" placeholder="验证码"
									   style="width:200px;"/>
							</div>
							<div class="am-form-group">
								<img class="verify am-round am-img-responsive" src="<?php echo U(verify);?>" alt="验证码"
									 onClick="this.src=this.src+'?'+Math.random()"/>
							</div>
							<div class="am-form-group">
								<input type="submit" name="" value="登 录"
									   class="am-btn am-btn-success am-btn-block am-animation-reverse"
									   data-doc-animation="slide-right">
							</div>
						</fieldset>
					</form>
					</div>
					
				
			</div>
			</div>
			</div>
	</div>

	</div>





<footer>
    <hr>
    <p class="am-padding-left">© 2016 Test</p>
</footer>
</body>
</html>