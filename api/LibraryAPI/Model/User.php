<?php

/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 17:31
 */
class Model_User
{
    public function getByUserId($userId)
    {
        return DI()->notorm->user->select('UID,username,email,introduction')->where('UID = ?', $userId)->fetch();
    }

    public function registerUser($username, $password, $email)
    {

        $result = array();

        if ($this->isUserExisted($email))  //如果已经存在用户
        {
            $result['code'] = 400;
            $result['msg'] = '此邮箱已被注册';
            $result['info'] = -1;
        } else {

            $user = DI()->notorm->user;
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"]; // 加密密码
            $salt = $hash["salt"]; // salt
            $data = array('email' => $email, 'username' => $username, 'encrypted_password' => $encrypted_password, 'salt' => $salt, 'created_at' => time());
            $user->insert($data);
            $id = $user->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增

            $result['code'] = 200;
            $result['msg'] = '注册成功';
            $result['info'] = $id;
        }
        return $result;
    }


    public function loginUser($email, $password)
    {

        $result = array();

        if ($this->isUserExisted($email))  //如果存在用户
        {
            $user = DI()->notorm->user->select('UID,encrypted_password,salt')->where('email', $email)->fetchOne();;

            $hash = $this->checkhashSSHA($user['salt'], $password);
            if ($user['encrypted_password'] == $hash) {  //判断密码是否正确
                $result['code'] = 200;
                $result['msg'] = '登陆成功';
                $result['info'] = $user['UID'];;
            } else {
                $result['code'] = 400;
                $result['msg'] = '登陆失败';
                $result['info'] = -1;
            }
        } else {
            $result['code'] = 400;
            $result['msg'] = '用户不存在';
            $result['info'] = -1;
        }

        return $result;
    }


    public function changeUserInformation($UID, $username, $introduction)
    {


        $date = array('username' => $username, 'introduction' => $introduction);
        $rs = DI()->notorm->user->where('UID',$UID)->update($date);
        return $rs;
    }




    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password)
    {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt , password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password)
    {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }

    /**
     * 检查用户是否存在
     */
    public function isUserExisted($email)
    {

        $num = DI()->notorm->user->select('email')->where('email', $email)->count();;
        if ($num > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function recordUserBookSearchInformation($UID, $bookName, $slf)
    {
        $record = DI()->notorm->record;
//        $hash = $this->hashSSHA($password);
//        $encrypted_password = $hash["encrypted"]; // 加密密码
//        $salt = $hash["salt"]; // salt
        $data = array('UID' => $UID, 'book_name' => $bookName, 'slf' => $slf, 'search_time' => date('Y-m-d H:i:s',time()));
        $record->insert($data);
        $id = $record->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增
        return $id;
    }

    public function getUserSearchInformation($UID)
    {
        $record = DI()->notorm->record;
        $rs = $record->select("*")->where("UID",$UID)->fetchAll();
        return $rs;
    }

}