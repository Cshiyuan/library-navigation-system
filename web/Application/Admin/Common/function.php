<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/8/4
 * Time: 16:11
 */
/**
 * 检测验证码
 * @param $code 输入的验证码
 * @param string $id 验证码标识,多个验证码时可用
 * @return bool 用户验证码 true or false
 */
//自定义函数库
function verify_check($code, $id = '')
{
    // 实例化验证码类
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}