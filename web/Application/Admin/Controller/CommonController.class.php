<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/8/4
 * Time: 15:14
 */
namespace Admin\Controller;

use Think\Controller;

/**
 * 通用控制器
 * 主要用于验证是否登陆 以及 用户权限
 * @package Admin\Controller
 */
class CommonController extends Controller
{
    /* 定义用户workID */
    public static $workID = '';

    /**
     * 自动执行
     */
    public function _initialize()
    {
        // 判断用户是否登录
        if (session('uid')) {
            $this->workID = session('uid');

        } else {
            $this->error('对不起,您还没有登录,正跳转至登录面...', U('Login/login'));
        }
    }

}