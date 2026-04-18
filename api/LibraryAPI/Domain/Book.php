<?php
/**
 * Created by PhpStorm.
 * User: bb
 * Date: 2016/12/7
 * Time: 21:50
 */
class Domain_Book
{
    public function getBookInfoByBookName($BookName)
    {
//        var_dump($BookName);

        $model = new Model_Book();
        $rs = $model->getBookInfoByBookName($BookName);

//        var_dump($BookName);

        return $rs;
    }
}