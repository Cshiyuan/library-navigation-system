<?php

/**
 * Created by PhpStorm.
 * User: bb
 * Date: 2016/12/7
 * Time: 21:50
 */
//class Api_Group extends PhalApi_Api
class Api_Book extends PhalApi_Api
{

     /**
     * 通过Email向小组里的添加组员
     * @desc 通过Email向小组里的添加组员
     */
    public function getBookInfoByBookName()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Book();
        $result = $domain->getBookInfoByBookName($this->BookName);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = '查询失败';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }


    public function getRules()
    {

        return array(
            'getBookInfoByBookName' => array(
                'BookName' => array('name' => 'BookName', 'require' => true),
            ),
        );
    }
}