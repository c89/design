<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename login.php
* @touch date Thu 08 May 2014 10:40:28 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
defined('IN_SHARK') or die('Access Denied');

/*{{{ Login Get*/
$app->get('/login/', function() use ($app) {
    if ($user = $app->session->get('user')) {
        switch ($user['roleId']) {
            case 0:
                $app->response->redirect('/admin/');
                break;
            case 1:
                $app->response->redirect('/user/');
                break;
            case 2:
                $app->response->redirect('/review/');
                break;
        }
        return;
    }
    $app->render('admin/login.php');
});
/*}}}*/
/*{{{ Login Post */
// Login
$app->post('/login/', function() use ($app) {
    $app->response->headers->set('Content-Type', 'application/json');

    $post = $app->request->post();
    $user = $post['user'];
    $pwd = $post['pwd'];
    $hmac = $post['hmac'];
    if ($hmac !== md5($user . $pwd)) {
        $out = array('status' => 500, 'msg' => '系统忙，请稍后再试');
        $app->response->write(json_encode($out));
        return;
    }

    $model = new app\model\User($app);
    if (!$user = $model->loadByName($user)) {
        $out = array('status' => 403, 'msg' => '用户不存在或密码有误');
        $app->response->write(json_encode($out));
        return;
    }
    if ($user['password'] != $app->common->encryptPwd($pwd)) {
        $out = array('status' => 403, 'msg' => '用户不存在或密码有误');
        $app->response->write(json_encode($out));
        return;
    }

    $app->session->set('user', $user);
    // Appraiser
    if (in_array($user['roleId'],  array(0, 2))) {
        $modelAppraiser = new \app\model\Appraiser();
        if ($data = $modelAppraiser->loadRule()) {
            $app->session->set('rule', $data);
        }
    }
    $out = array('status' => 200, 'msg' => '登录成功');
    $app->response->write(json_encode($out));
});
/*}}}*/
/*{{{ Logout Get */
$app->get('/login/out/', function() use ($app) {
    $app->session->destroy();
    $app->response->redirect('/login/');
});
/*}}}*/

?>
