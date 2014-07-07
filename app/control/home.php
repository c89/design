<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename home.php
* @touch date Wed 07 May 2014 01:51:47 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
defined('IN_SHARK') or die('Access Denined');

$app->get('/', function() use ($app) {
    $app->redirect('/login/');
});
