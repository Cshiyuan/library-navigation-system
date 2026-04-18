<?php

/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 17:31
 */
class Domain_User
{
    public function getBaseInfo($userId)
    {
        $rs = array();
        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
        $model = new Model_User();
        $rs = $model->getByUserId($userId);
        return $rs;
    }

    public function registerUser($username, $password, $email)
    {
        $model = new Model_User();
        $rs = $model->registerUser($username, $password, $email);
        return $rs;
    }


    public function loginUser($email, $password)
    {
        $model = new Model_User();
        $rs = $model->loginUser($email,$password);
        return $rs;
    }

    public function changeUserInformation($UID, $username, $introduction)
    {


        $model = new Model_User();
        $rs = $model->changeUserInformation($UID, $username, $introduction);
        return $rs;
    }

    public function recordUserBookSearchInformation($UID, $bookName, $slf)
    {
        $model = new Model_User();
        $rs = $model->recordUserBookSearchInformation($UID, $bookName, $slf);
        return $rs;
    }

    public function getUserSearchInformation($UID)
    {
        $model = new Model_User();
        $rs = $model->getUserSearchInformation($UID);
        return $rs;
    }

}