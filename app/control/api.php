<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename api.php
* @touch date Wed 07 May 2014 04:12:31 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
defined('IN_SHARK') or die('Access Denied');

// admin only have get post 
$app->map('/api/(:control/(:action/(:param)))', function($control = 'home', $action = 'index') use ($app) {
    $control = ucfirst(strtolower($control));
    if (file_exists(sprintf('./app/control/api/%s.php', $control))) {
        $class = '\\app\control\\api\\' . $control;
        $obj = new $class($app);

        if (!method_exists($obj, $action)) {
            if ($app->config('debug')) {
                throw new RuntimeException(sprintf('There is not %s method in app/control/api/%s.php file.', $action, $control));
            } else {
                $app->notFound();
            }
        }

        $obj->$action();
        return;
    }

    if ($app->config('debug')) {
        throw new RuntimeException(sprintf('There is not app/control/api/%s.php file.', $control));
    } else {
        $app->notFound();
    }

})->via('GET', 'POST');

?>
