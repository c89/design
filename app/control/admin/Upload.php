<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Upload.php
* @touch date Mon 12 May 2014 06:17:09 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0'
* @version 1.0.0
*/
namespace app\control\admin;

class Upload extends \Shark\Core\Control {

/*{{{ json */
    public function json() {
        $config = $this->app->config('upload');

        //文件保存目录路径
        $save_path = $config['save_path'];;
        //文件保存目录URL
        $save_url = $config['save_url'];
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => $config['image'],
            'file' => $config['image'],
        );
        //最大文件大小
        $max_size = $config['max_size'];

        $save_path = realpath($save_path) . '/';

        //PHP上传失败
        if (!empty($_FILES['imgFile']['error'])) {
            switch($_FILES['imgFile']['error']){
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            $this->rendJSON(array('status' => 1, 'msg' => $error));
        }

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                $this->rendJSON(array('error' => 1, 'message' => '请选择文件。'));
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                $this->rendJSON(array('error' => 1, 'message' => '上传目录不存在。'));
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                $this->rendJSON(array('error' => 1, 'message' => '上传目录没有写权限。'));
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                $this->rendJSON(array('error' => 1, 'message' => '上传失败。'));
            }
            //检查文件大小
            if ($file_size > $max_size) {
                $this->rendJSON(array('error' => 1, 'message' => '上传文件大小超过限制。'));
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                $this->rendJSON(array('error' => 1, 'message' => '目录名不正确。'));
            }
            //获得文件扩展名
            $temp_arr = explode('.', $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                $this->rendJSON(array('error' => 1,  'message' => "上传文件扩展名是不允许的扩展名。\n只允许" . implode(',', $ext_arr[$dir_name]) . '格式。'));
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . '/';
                $save_url .= $dir_name . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
            }
            $ymd = date('Ymd');
            $save_path .= $ymd . '/';
            $save_url .= $ymd . '/';
            if (!file_exists($save_path)) {
                mkdir($save_path);
            }
            //新文件名
            $new_file_name = date('YmdHis') . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                $this->rendJSON(array('error' => 1, 'message' => '上传文件失败。'));
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            $absolate_name = substr($file_url, strlen($config['save_url']));

            $this->rendJSON(array('error' => 0, 'url' => $file_url, 'file' => $absolate_name, 'title' => $absolate_name));
        }
    }
/*}}}*/

}
