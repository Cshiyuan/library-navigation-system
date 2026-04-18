<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/8/4
 * Time: 15:11
 */

/**
 * Class LoginController
 * @package Home\Controller
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    /**
     * 用户登录
     */
    public function login()
    {
        //判断提交方式
        if (IS_POST) {   //用POST方式提交
            //实例化Login对象
            $login = D('login');

            // 自动验证 创建数据集
            if (!$data = $login->create()) {   //如果创建失败 表示验证没有通过
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                //exit($login->getError());  //输出错误信息
                $this->error($login->getError(), U('Login/login'));
            }
            // 组合查询条件
            $where = array();
            $where['admin_name'] = $data['admin_name'];  //查询条件
            //利用where组合条件从数据表中查询result
            $result = $login->where($where)->field('workID,admin_name,password,last_date,last_ip')->find();  //安装admin_name查询表中的行，并获得各自的域

            // 验证用户名 对比 密码
            if ($result && $result['password'] == $data['password']) {   //如果存在结果，密码正确
                // 存储session  ThinkPHP函数session方法
//                session('test','test');
                session('uid', $result['workid']);          // 当前用户id //登陆状态
                session('admin_name', $result['admin_name']);   // 当前用户名
                session('last_date', $result['last_date']);   // 上一次登录时间  写入时间戳
                session('last_ip', $result['last_ip']);       // 上一次登录ip

                // 更新用户登录信息
                $where['workID'] = session('uid');   //UID用户身份证明
                M('administrator')->where($where)->setInc('login_num');   // 登录次数加 1
                M('administrator')->where($where)->save($data);   // 更新登录时间和登录ip

                $this->success('登录成功,正跳转至系统首页...', U('Index/index'));
            } else {
                $this->error('登录失败,用户名或密码不正确!');
            }
        } else {
            $this->display();
        }
    }


    /**
     * 用户注销
     */
    public function logout()
    {
        // 清楚所有session
        session(null);
        // 防止输出中文乱码
        header("Content-type: text/html; charset=utf-8");
        redirect(U('Login/login'), 2, '正在退出登录...');
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

}
