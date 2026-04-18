<?php

/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 17:30
 */
class Api_User extends PhalApi_Api
{

    /**
     * 获得用户的基本信息
     * @desc 通过UID获得用户的基本信息
     */
    public function getUserBaseInfo()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        //echo $this->username;
        // echo $this->test;

        $domain = new Domain_User();
        $info = $domain->getBaseInfo($this->userid);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userid);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;
        //$rs['info']['username11'] = $this->username;

        return $rs;
    }

    /**
     * 通过相应的信息进行注册
     * @desc 通过相应的信息进行注册
     */
    public function registerUser()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->registerUser($this->username, $this->password, $this->email); //交由domain注册并返回注册信息

        $rs['code'] = $result['code'];
        $rs['msg'] = $result['msg'];
        $rs['info'] = $result['info'];
        return $rs;

    }

    /**
     * 通过邮箱和密码进行登陆认证
     * @desc 通过邮箱和密码进行登陆认证
     */
    public function loginUser()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->loginUser($this->email, $this->password); //交由domain注册并返回注册信息

        $rs['code'] = $result['code'];
        $rs['msg'] = $result['msg'];
        $rs['info'] = $result['info'];
        return $rs;
    }

    /**
     * 修改用户简介
     * @desc 通过UID修改用户简介
     */
    public function changeUserInformation()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->changeUserInformation($this->UID, $this->username, $this->introduction);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'User';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '修改成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    //记录图书查询记录
    public function recordUserBookSearchInformation()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->recordUserBookSearchInformation($this->UID, $this->bookName, $this->slf);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'User';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '修改成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    //获得用户图书记录
    public function getUserSearchInformation()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->getUserSearchInformation($this->UID);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'User';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '修改成功';
            $rs['info'] = $result;
        }
        return $rs;
    }


    public function getRules()
    {
        return array(
            'getUserBaseInfo' => array(
                'userid' => array('name' => 'userid', 'type' => 'int', 'min' => 1, 'require' => true),
            ),

            'registerUser' => array(
                'username' => array('name' => 'username','require' => true),
                'password' => array('name' => 'password','require' => true),
                'email' => array('name' => 'email','require' => true),
            ),

            'loginUser' => array(
                'email' => array('name' => 'email','require' => true),
                'password' => array('name' => 'password','require' => true),
            ),
            'changeUserInformation' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'username' => array('name' => 'username','require' => true),
                'introduction' => array('name' => 'introduction','require' => true),
            ),
            'recordUserBookSearchInformation' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'bookName' => array('name' => 'bookName','require' => true),
                'slf' => array('name' => 'slf','require' => true),
            ),
            'getUserSearchInformation' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
            )
        );
    }



}