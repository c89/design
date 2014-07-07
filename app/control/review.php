<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename review.php
* @touch date Wed 07 May 2014 02:23:50 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
defined('IN_SHARK') or die('Access Denined');

/*{{{ auth for  */
$auth = function() {
    $app = \Slim\Slim::getInstance();
    $user = $app->session->get('user');
    if (!$user || $user['roleId'] != 2) {
        $app->redirect('/login/');
    }
};
/*}}}*/
/*{{{ route */
// Review only have get post 
$app->map('/review/(:name+)', $auth, function($name = array()) use ($app) {
    $tmp = implode('/', $name);
    $pos = strpos($tmp, '?');
    if ($pos !== false) {
        $tmp = substr($tmp, 0, $pos);
    }
    $name = explode('/', $tmp);

    $control = (count($name) > 0 && $name[0])? $name[0]: 'home';
    $action = (count($name) > 1 && $name[1])? $name[1]: 'index';

    $control = ucfirst(strtolower($control));
    if (file_exists(sprintf('./app/control/review/%s.php', $control))) {
        $class = '\\app\control\\review\\' . $control;
        $obj = new $class($app);

        $action = str_replace('-', '', $action);
        if (!method_exists($obj, '__call') && !method_exists($obj, $action)) {
            if ($app->config('debug')) {
                throw new RuntimeException(sprintf('There is not %s method in app/control/review/%s.php file.', $action, $control));
            } else {
                $app->notFound();
            }
        }

        $obj->$action();
        return;
    }

    if ($app->config('debug')) {
        throw new RuntimeException(sprintf('There is not app/control/review/%s.php file.', $control));
    } else {
        $app->notFound();
    }

})->via('GET', 'POST');
/*}}}*/

?>
