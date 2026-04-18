<?php
/**
 * Created by PhpStorm.
 * User: bb
 * Date: 2016/12/8
 * Time: 16:19
 */

namespace Admin\Controller;

use Think\Controller;


class UploadController extends Controller
{

    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        // 上传单个文件
        $images = $upload->uploadOne($_FILES['photo']);

        if ($images) {
            $img_url = $images['savepath'] . $images['savename'];
//            var_dump($img_url);
            $info['image'] = $img_url;
//            if ($_POST['thumb'] == 'image') {//根据提交的值，判断是否生成缩略图
            $image = new \Think\Image();//实例化图片处理类
            $url = './Uploads/' . $img_url;
//            $arr = array(".jpg" => "_");
            $img_name = str_replace(".jpg", "_", $img_url);//替换图片名字
            $image->open($url);//打开图片
            $name = './Uploads/' . $img_name . 'thumb.jpg';
            if ($image->thumb(600, 600)->save($name))//生成50X50的缩略图,并保存
            {
                $info['thumb'] = $img_name . 'thumb.jpg';
            }
//            }
//            $this->ajaxReturn($info);//返回图片地址
//            echo $info;
//            var_dump($info);
        } else {
            $this->error($upload->getError());//获取失败信息
        }
    }


}