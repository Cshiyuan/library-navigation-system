<?php

/**
 * Created by PhpStorm.
 * User: bb
 * Date: 2016/12/7
 * Time: 21:50
 */
class Model_Book
{

    public function getBookInfoByBookName($BookName)
    {
        $book = DI()->notorm->book;

//        var_dump($book);
//        var_dump($BookName);


//        $rs1 = $book->select('*')->where('book_name','数据结构')->fetch();

//        var_dump($rs1);
//        $bookName = "%" + $BookName + "%";
//        var_dump($bookName);
        // WHERE name LIKE '%dog%'
        $rs =  $book->select('*')->where('book_name LIKE ?', "%".$BookName."%")->fetchAll();



//        var_dump($rs);
//        $data = array('group_leader' => $UID,'group_name'=>$GROUPNAME,'group_description'=>$GROUPDESCRIPTION);
//        $group->insert($data);
//        $id = $group->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增
//
//        //同时插入到联系表
//        $userAndGroup = DI()->notorm->userandgroup;
//        $relation = array('UID' => $UID, 'GID' => $id);
//        $userAndGroup->insert($relation);
//
//        return $id;   //返回的是创建的GID的主键
        return $rs;
    }
}