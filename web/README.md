1.后台登陆界面
 
输入正确用户名和密码，并且输入验证码后可以登陆到后台

2.后台主界面（默认为图书信息模块）
 
右边有查看图书信息模块、添加图书模块、和添加管理员模块

3.图书信息模块
 
可以查看图书的相关信息。比如所在书架，是否借出等。并且可以进行编辑和删除图书。
搜索图书书名，可以得到搜索结果。


4.添加图书模块



 
 

可以添加新的图书，并且附有可以拖动查看，和缩放的室内地图，可以参考进行图书的位置和信息编辑。

5．添加管理员模块
 
输入管理员相关信息和填写正确验证码可以注册管理员。

6.个人资料模块
 



可以查看此账号的
账号信息（比如Email，手机号，用户名，注册时间），
登陆信息（登陆次数，上次登陆IP，上次登陆时间）

 
点击退出，可以退出登陆。


源码文件结构


 
ThinkPHP ： 为ThinkPHP核心文件
 
css : 网站相关css文件
data : 主要是网站用到的蜂鸟室内地图的相关地图和主题文件
fonts : 字体文件
i和image : 主要是网站用到的相关图片
js : 网站相关的js文件
lib :也是网站相关的js文件
 
Admin : Admin模块，是目前的主要模块
Common : 公用模块，暂时没有开发
Home : Home，暂时没有开发
Runtime : 网站运行时会生成的缓存文件

 
common : 公用方法

conf : 相关设置

Controller : 控制器，主要有CommonController公用控制器,indexController首页控制器,LoginController登陆控制器

Model : 模型，主要是与数据库连接的模型，目前有LoginModel登陆者模型，BookModel图书模型，Administrator管理员模型。

View : 与模型相关的相关视图

<img src="https://github.com/Cshiyuan/LibraryWeb/blob/master/image/D310DAA6-7A12-4EFB-91A3-93D2BFDEDF72.png" width = "80%" />

