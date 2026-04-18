<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

/**
 * 首页控制器
 * @property  search_info
 * @package Admin\Controller
 */
class IndexController extends CommonController
{
    /**
     * 系统首页
     */
    //public static $search_info = '';

    public function index()
    {
        // 获取当前账户的登录信息

        //自定义
        $Form = M('Book');
//        import("@.ORG.Page");       //导入分页类
        $count = $Form->count();    //计算总数
        $p = new Page($count, 10);

        if (session('search_info') == 'null')
            $list = $Form->field('book_ID,category, book_name,slf_name,author,pub_house,search_time,is_onslf,cover_thumb')->limit($p->firstRow . ',' . $p->listRows)->order('book_ID desc')->select();
        else {
            $where = array();
            $where['book_name'] = array('like', '%' . session('search_info') . '%');  //模糊查询
            $list = $Form->where($where)->field('book_ID,category, book_name,slf_name,author,pub_house,search_time,is_onslf,cover_thumb')->limit($p->firstRow . ',' . $p->listRows)->order('book_ID desc')->select();
        }
        //$p->firstRow 当前页开始记录的下标，$p->listRows 每页显示记录数
        //一般定义分页样式 通过分页对象的setConfig定义其config属性；
        /*
          默认值为$config = array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页',
          'theme'=>' %totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
          修改显示的元素的话设置theme就行了，可对其元素加class
         */
        session('search_info', 'null');
        $p->setConfig('header', '条数据');
        $p->setConfig('prev', "<");
        $p->setConfig('next', '>');
        $p->setConfig('first', '<<');
        $p->setConfig('last', '>>');
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("list", $list); //数据循环变量
        $this->display();

    }
	
	
	public function cate()
    {
        // 获取当前账户的登录信息

        //自定义
        $Form = M('Book');
//        import("@.ORG.Page");       //导入分页类
        $count = $Form->count();    //计算总数
        $p = new Page($count, 10);

        if (session('search_info') == 'null')
            $list = $Form->field('book_ID,category, book_name,slf_name,author,pub_house,search_time,is_onslf,cover_thumb')->limit($p->firstRow . ',' . $p->listRows)->order('book_ID desc')->select();
        else {
            $where = array();
            $where['category'] = array('like', '%' . session('search_info') . '%');  //模糊查询
            $list = $Form->where($where)->field('book_ID,category, book_name,slf_name,author,pub_house,search_time,is_onslf,cover_thumb')->limit($p->firstRow . ',' . $p->listRows)->order('book_ID desc')->select();
        }
        //$p->firstRow 当前页开始记录的下标，$p->listRows 每页显示记录数
        //一般定义分页样式 通过分页对象的setConfig定义其config属性；
        /*
          默认值为$config = array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页',
          'theme'=>' %totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
          修改显示的元素的话设置theme就行了，可对其元素加class
         */
        session('search_info', 'null');
        $p->setConfig('header', '条数据');
        $p->setConfig('prev', "<");
        $p->setConfig('next', '>');
        $p->setConfig('first', '<<');
        $p->setConfig('last', '>>');
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("list", $list); //数据循环变量
        $this->display();

    }
	
	

    /**
     * 删除数据
     */
    public function delete($id)
    {
        $Book = M("Book");
        $result = $Book->delete($id);
        if (false !== $result) {
            $this->success('删除成功', U('Index/index'), 1);
        } else {
            $this->error('删除出错！');
        }
    }

    /**
     * 搜索图书
     */
    public function search()
    {
        //有提交数据
        if (IS_POST) {

            //  $this->search_info = $_POST['search_info'];
            // $this->success(U('Index/index/'));
            session('search_info', $_POST['search_info']);
            $this->success('查询中', U('Index/index/'), 1);
        }

        /*            $Book = D("Book");
                    $where = array();
                    $where['book_name'] = array('like', '%' . $_POST[search_info] . '%');  //模糊查询
                    //利用where组合条件从数据表中查询result


                    $result = $Book->where($where)->field('book_name,slf_name,author,pub_house,search_time,is_onslf')->select();
                    $count = $Book->where($where)->field('book_name,slf_name,author,pub_house,search_time,is_onslf')->Count();
                    //$vo['book_name'] = $result['book_name'];
                   // $count = $result->Count();
                    if ($result) {
                        $result['status'] = 1;
                        $result['count'] = $count;
                        $this->ajaxReturn($result);
                    } else {
                        $result['status'] = 0;
                        $this->ajaxReturn($result);
                    }*/
        //ajax方式返回的数据用ajaxReturn函数
        /*
            系统支持任何的AJAX类库，Action类提供了ajaxReturn方法用于AJAX调用后返回数据给客户端。
            并且支持JSON、XML和EVAL三种方式给客户端接受数据，通过配置DEFAULT_AJAX_RETURN进行设置，
            默认配置采用JSON格式返回数据，在选择不同的AJAX类库的时候可以使用不同的方式返回数据。
            要使用ThinkPHP的ajaxReturn方法返回数据的话，需要遵守一定的返回数据的格式规范。ThinkPHP返回的数据格式包括：
            status 操作状态
            info 提示信息
            data 返回数据
            返回数据data可以支持字符串、数字和数组、对象，返回客户端的时候根据不同的返回格式进行编码后传输。
            如果是JSON格式，会自动编码成JSON字符串，如果是XML方式，会自动编码成XML字符串，如果是EVAL方式的话，
            只会输出字符串data数据，并且忽略status和info信息。
         */
        //注意在调试过程中，在ajaxReturn方法前输出任何信息的话，js端ajax 请求的返回状态不是success（如jquery的ajax）
        //信息会进入error function 中才能捕获到

    }

    /**
     * 添加注册用户
     */
    public function register()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $administrator = D('administrator');

            // 自动验证 创建数据集
            if (!$data = $administrator->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
//                exit($user->getError());
                $this->error($administrator->getError(), U('index/register'));
            }

            //插入数据库
            if ($id = $administrator->add($data)) {
                /* 直接注册用户为超级管理员,子用户采用邀请注册的模式,
                   遂设置公司id等于注册用户id,便于管理公司用户*/
//                $administrator->where("userid = $id")->setField('companyid', $id);
                $this->success('注册成功', U('Index/index'), 2);
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 添加图书
     */
    public function add()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {


            // 实例化User对象
            $book = D('book');

            // 自动验证 创建数据集
            if (!$data = $book->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
//                exit($user->getError());
                $this->error($book->getError(), U('index/add'));
            }

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = __ROOT__.'/Uploads/'; // 设置附件上传根目录
            var_dump(__ROOT__);
            // 上传单个文件
            $images = $upload->uploadOne($_FILES['photo']);

            if ($images) {
                $img_url = $images['savepath'] . $images['savename'];
//                $date['cover']
                $info['image'] = $img_url;
                $image = new \Think\Image();//实例化图片处理类
                $url = './Uploads/' . $img_url;
                $img_name = str_replace(".jpg", "_", $img_url);//替换图片名字
                $image->open($url);//打开图片
                $name = './Uploads/' . $img_name . 'thumb.jpg';
                if ($image->thumb(600, 600)->save($name))//生成50X50的缩略图,并保存
                {
                    $info['thumb'] = $img_name . 'thumb.jpg';
                    $data['cover_thumb'] = $info['thumb'];   //传入数据库
//                    var_dump($info['image']);
                    $data['cover'] = $info['image'];
//                    var_dump($dat)
                }
            } else {
                $this->error($upload->getError());//获取失败信息
            }



            //插入数据库
            if ($id = $book->add($data)) {
                /* 直接注册用户为超级管理员,子用户采用邀请注册的模式,
                   遂设置公司id等于注册用户id,便于管理公司用户*/
//                $administrator->where("userid = $id")->setField('companyid', $id);
                $this->success('添加成功', U('Index/index'), 2);
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->display();
        }
    }


    /**
     * 验证码
     */
    public function verify()
    {
        // 实例化Verify对象
        $verify = new \Think\Verify();
        // 配置验证码参数
        $verify->fontSize = 14;     // 验证码字体大小
        $verify->length = 4;        // 验证码位数
        $verify->imageH = 34;       // 验证码高度
        $verify->useImgBg = false;   // 关闭验证码背景
        $verify->useNoise = false;  // 关闭验证码干扰杂点
        $verify->entry();
    }

    /**
     * 个人资料
     */
    public function information()
    {

        //实例化Login对象
        $login = D('login');
        //组合查询条件
        $where = array();
        $where['workID'] = session('uid');
        //利用where组合条件从数据表中查询result
        $result = $login->where($where)->field('workID,admin_name,email,telephone,last_date,last_ip,login_num,regdate')->find();
        $this->assign("administrator", $result);
//        时间戳转化为正常时间输出
        $this->assign("last_date", date('Y-m-d H:i', $result["last_date"]));

        $this->assign("regdate", date('Y-m-d H:i', $result["regdate"]));

        $this->display();
    }

    /**
     * 二维码
     */
    public function createqr()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {


            $this->assign("data", $_POST['slf_name']);
            $this->display();
        } else {
            $this->display();
        }
    }

    /**
     * 二维码
     */
    public function qrcode($data)
    {
        Vendor('phpqrcode.phpqrcode');
        $data = urldecode($data);
        $object = new \QRcode();
        ob_clean();//这个一定要加上，清除缓冲区
        $object->png($data, false, 'Q', '6', '2');
    }

    /**
     * 编辑图书
     */
    public function edit_book($id)
    {
        if (IS_POST) {
            $Book = D("Book");
            // $where = array();
            //$where['book_name'] = array('like', '%' . $_POST[search_info] . '%');  //模糊查询
            //利用where组合条件从数据表中查询result

            $result = $Book->find($id);
			//$result = $Book->where($where)->field('book_name, category, slf_name,author,pub_house,search_time,is_onslf')->find();
            //$count = $Book->where($where)->field('book_name, category, slf_name,author,pub_house,search_time,is_onslf')->Count();
            //$vo['book_name'] = $result['book_name'];
            // $count = $result->Count();
            if ($result) {
                $result['status'] = 1;
                // $result['count'] = $count;
                $this->ajaxReturn($result);
            } else {
                $result['status'] = 0;
                $this->ajaxReturn($result);
            }
        }
    }

    public function save($id)
    {
        if (IS_POST) {
            // 实例化User对象
            $book = D('Book');

            // 自动验证 创建数据集
            if (!$data = $book->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
//                exit($user->getError());
                $this->error($book->getError(), U('index/add'));
            }
            $where = array();
            $where['book_ID'] = $id;
            $book->where($where)->save($data);
            $this->success('修改成功', U('Index/index'), 1);
        }
    }
	
	 /**
     * 编辑用户资料
     */
    public function edit_user($id)
    {
        if (IS_POST) {
            $administrator = D("administrator");
            // $where = array();
            //$where['book_name'] = array('like', '%' . $_POST[search_info] . '%');  //模糊查询
            //利用where组合条件从数据表中查询result

            $result = $administrator->find($id);
			//$result = $administrator->where($where)->field('admin_name, edit_email, edit_telephone')->find();
            //$count = $Book->where($where)->field('book_name, category, slf_name,author,pub_house,search_time,is_onslf')->Count();
            //$vo['book_name'] = $result['book_name'];
            // $count = $result->Count();
            if ($result) {
                $result['status'] = 1;
                // $result['count'] = $count;
                $this->ajaxReturn($result);
            } else {
                $result['status'] = 0;
                $this->ajaxReturn($result);
            }
        }
    }

	public function save2($id)
    {
        if (IS_POST) {
            // 实例化User对象
            $administrator = M('administrator');
			
            // 自动验证 创建数据集
            if (!$data = $administrator->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
//                exit($user->getError());
                $this->error($administrator->getError(), U('index/information'));
            }
            $where = array(); 
            $where['workID'] = $id;
			//$where['password'] = $administrator.password;
            $administrator->where($where)->save($data);
            $this->success('修改成功', U('Index/information'), 1);
        }
    }

	
}