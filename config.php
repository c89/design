<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename config.php
* @touch date Wed 07 May 2014 12:29:38 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
defined('IN_SHARK') or die('Access Denied');

ini_set('display_errors', 1);

/*
|--------------------------------------------------------------------------
| Setting
|--------------------------------------------------------------------------
|
| Setting for core framework Slim.
|
*/
// Application
$setting['mode'] = 'development';
// Debugging
$setting['debug'] = true;
// Logging
$setting['log.writer'] = new \Shark\Helper\Filelog(array('path' => './app/log/'));
$setting['log.level'] = \Slim\Log::DEBUG;
$setting['log.enabled'] = true;
// View
$setting['templates.path'] = './app/templates';
$setting['view'] = '\Slim\View';
// Cookies
$setting['cookies.encrypt'] = false;
$setting['cookies.lifetime'] = '20 minutes';
$setting['cookies.path'] = '/';
$setting['cookies.domain'] = null;
$setting['cookies.secure'] = false;
$setting['cookies.httponly'] = false;
// Encryption
$setting['cookies.secret_key'] = 'CHANGE_ME';
$setting['cookies.cipher'] = MCRYPT_RIJNDAEL_256;
$setting['cookies.cipher_mode'] = MCRYPT_MODE_CBC;
// HTTP
$setting['http.version'] = '1.1';
// Routing
$setting['routes.case_sensitive'] = true;

/*
|--------------------------------------------------------------------------
| Common
|--------------------------------------------------------------------------
|
| Common configure, such as name, time. 
|
*/
$config['common']['salt'] = 'MwMHvPYAs28Z7wtz';
$config['common']['domain'] = 'http://localhost:2040/';

/*
|--------------------------------------------------------------------------
| Session
|--------------------------------------------------------------------------
|
| Session configure, such as name, time. 
|
*/
$config['session']['name'] = 'suid';
$config['session']['time'] = '3600';

/*
|--------------------------------------------------------------------------
| MySQL
|--------------------------------------------------------------------------
|
| MySQL configure, such as host, name, port, pwd, db, charset, dbcollat.
|
*/
$config['mysql']['dsn'] = 'mysql:host=localhost;dbname=design_success;port=3306;charset=utf8';
$config['mysql']['username'] = 'design';
$config['mysql']['password'] = 'wzhTCeRfyY5W3qDM';

/*
|--------------------------------------------------------------------------
| Redis
|--------------------------------------------------------------------------
|
| Redis configure, such as host, port, timeout, reserved, password
| pconnected.
|
*/
$config['redis']['host'] = '127.0.0.1';
$config['redis']['port'] = 6379;
$config['redis']['timeout'] = 0;
$config['redis']['reserved'] = null;
$config['redis']['password'] = null;
$config['redis']['pconnected'] = false;

/*
|--------------------------------------------------------------------------
| Twig
|--------------------------------------------------------------------------
|
| Twig setting
|
*/
$config['twig']['cache'] = './app/cache/twig';

/*
|--------------------------------------------------------------------------
| Autorun
|--------------------------------------------------------------------------
|
| Autorun Helper, Middleware, Hook
|
*/
$config['auto']['helper'] = array('common', 'session', 'db');
$config['auto']['middleware'] = array('nocache');
$config['auto']['hook'] = array();

/*
|--------------------------------------------------------------------------
| Upload
|--------------------------------------------------------------------------
|
| Upload File setting
|
*/
$config['upload']['image'] = array('jpg', 'jpeg', 'png');
$config['upload']['save_path'] = './assets/upload/';
$config['upload']['save_url'] = $config['common']['domain'] . 'assets/upload/';
$config['upload']['max_size'] = 1000000;

/*
|--------------------------------------------------------------------------
| Pagenation
|--------------------------------------------------------------------------
|
| Pagenation tool setting
|
*/
$config['pagination']['per_page'] = 2;
