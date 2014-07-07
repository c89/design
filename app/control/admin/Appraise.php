<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/** 
* @filename Appraise.php
* @touch date Sat 10 May 2014 03:54:20 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\admin;

class Appraise extends \Shark\Core\Control {

/*{{{ index */
    public function index() {
        $out = array();
        $param = array(
            'page' => $this->app->request->params('page', 1),
            'per_page' => $this->config['pagination']['per_page'],
        );
        $modelUser = new \app\model\User();
        if ($tmp = $modelUser->loadAllAppraiser($param)) {
            $out['data'] = $tmp['data'];
            $config = array(
                'total' => $tmp['total'],
                'url' => '/admin/appraise/?page=',
                'page' => $param['page'],
            );
            // Generate pagination
            $out['pagination'] = $this->pagination($config);
        }

        $this->display('admin/appraise.html', $out);
    }
/*}}}*/
/*{{{ assign */
    public function assign() {
        $out = array();
        if ($this->app->request->isGet()) {
            $param = array(
                'uid' => $this->app->request->params('uid'),
                'page' => $this->app->request->params('page', 1),
                'per_page' => $this->config['pagination']['per_page'],
            );
            if (!$param['uid']) {
                $this->redirect('/admin/appraise/');
            }
            $rule = $this->app->session->get('rule');
            $param['rid'] = $rule['rule']['id'];
            $model = new \app\model\Opus();
            if ($tmp = $model->loadForAssign($param)) {
                $out['data'] = $tmp['data'];
                $config = array(
                    'total' => $tmp['total'],
                    'url' => sprintf('/admin/appraise/assign/?uid=%s&page=', $param['uid']),
                    'page' => $param['page'],
                );
                // Generate pagination
                $out['pagination'] = $this->pagination($config);
            }
            $out['search'] = $param;

            $modelUser = new \app\model\User();
            $out['user'] = $modelUser->loadById($param['uid']);

            $this->display('admin/appraise_assign.html', $out);
            $this->app->stop();
        }

        // Assign opus to appraise
        $rule = $this->app->session->get('rule');
        $param = array(
            'uid' => $this->app->request->params('uid'),
            'pid' => $this->app->request->params('pid'),
            'rid' => $rule['rule']['id'],
        );
        $model = new \app\model\Opus();
        if ($model->assign($param)) {
            $out['status'] = 200;
            $this->rendJSON($out);
        }

        $out['status'] = 400;
        $this->rendJSON($out);
    }
/*}}}*/
/*{{{ start */
    public function start() {
        $out = array();
        if ($this->app->request->isGet()) {
            $param = array(
                'uid' => $this->app->request->params('uid'),
                'page' => $this->app->request->params('page', 1),
                'per_page' => $this->config['pagination']['per_page'],
            );
            if (!$param['uid']) {
                $this->redirect('/admin/appraise/');
            }
            $rule = $this->app->session->get('rule');
            $param['rid'] = $rule['rule']['id'];
            $model = new \app\model\Opus();
            if ($tmp = $model->loadForStart($param)) {
                $out['data'] = $tmp['data'];
                $config = array(
                    'total' => $tmp['total'],
                    'url' => sprintf('/admin/appraise/start/?uid=%s&page=', $param['uid']),
                    'page' => $param['page'],
                );
                // Generate pagination
                $out['pagination'] = $this->pagination($config);
            }
            $out['search'] = $param;

            $modelUser = new \app\model\User();
            $out['user'] = $modelUser->loadById($param['uid']);

            $this->display('admin/appraise_start.html', $out);
            $this->app->stop();
        }

        // Assign opus to appraise
        $rule = $this->app->session->get('rule');
        $param = array(
            'uid' => $this->app->request->params('uid'),
            'pid' => $this->app->request->params('pid'),
            'rid' => $rule['rule']['id'],
        );
        $model = new \app\model\Opus();
        if ($model->unassign($param)) {
            $out['status'] = 200;
            $this->rendJSON($out);
        }

        $out['status'] = 400;
        $this->rendJSON($out);
    }
/*}}}*/
/*{{{ finish */
    public function finish() {
        $out = array();

        $param = array(
            'uid' => $this->app->request->params('uid'),
            'page' => $this->app->request->params('page', 1),
            'per_page' => $this->config['pagination']['per_page'],
        );
        if (!$param['uid']) {
            $this->redirect('/admin/appraise/');
        }
        $rule = $this->app->session->get('rule');
        $param['rid'] = $rule['rule']['id'];
        $model = new \app\model\Opus();
        if ($tmp = $model->loadForFinish($param)) {
            $out['data'] = $tmp['data'];
            $config = array(
                'total' => $tmp['total'],
                'url' => sprintf('/admin/appraise/finish/?uid=%s&page=', $param['uid']),
                'page' => $param['page'],
            );
            // Generate pagination
            $out['pagination'] = $this->pagination($config);
        }
        $out['search'] = $param;

        $modelUser = new \app\model\User();
        $out['user'] = $modelUser->loadById($param['uid']);

        $this->display('admin/appraise_finish.html', $out);
    }
/*}}}*/

}
