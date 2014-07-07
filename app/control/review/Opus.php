<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Opus.php
* @touch date Mon 30 Jun 2014 03:57:46 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\review;

class Opus extends \Shark\Core\Control {

/*{{{ index */
    public function index($status = null, $url = '/review/opus/?') {
        $param = array(
            'category' => $this->app->request->get('category'),
            'name' => $this->app->request->get('name'),
            'page' => $this->app->request->get('page', 1),
        );
        if (isset($status)) {
            $param['status'] = $status;
        }

        $out = array();

        $modelCategory = new \app\model\Category();
        $out['category'] = $modelCategory->loadAll();

        // Check user role
        $user = $this->app->session->get('user');
        $param['uid'] = $user['userId'];
        if (!$rule = $this->app->session->get('rule')) {
            $this->display('site/opus.html', $out);
            $this->app->stop();
        }

        // Get opus data
        $param['rid'] = $rule['rule']['id'];
        $param['per_page'] = $this->config['pagination']['per_page'];
        $out['search'] = $param;

        $model = new \app\model\Opus();
        if ($tmp = $model->loadAllForReviewer($param)) {
            $out['data'] = $tmp['data'];

            // Pagination url generate
            $arr = array_filter(array(
                'category' => $param['category'],
                'name' => $param['name'],
            ), function($val) {
                return $val;
            });
            if ($arr) {
                $uri = http_build_query($arr) . '&page=';
            } else {
                $uri = 'page=';
            }
            $config = array(
                'total' => $tmp['total'],
                'url' => $url . $uri,
                'page' => $param['page'],
            );
            // Generate pagination
            $out['pagination'] = $this->pagination($config);
        }

        $this->display('site/opus.html', $out);
    }
/*}}}*/
/*{{{ show*/
    public function show() {
        if (!$pid = $this->app->request->params('id')) {
            $this->app->redirect('/review/opus/');
        }
        $user = $this->app->session->get('user');
        $rule = $this->app->session->get('rule');

        $out = array();
        $model = new \app\model\Opus();
        $param = array(
            'pid' => $pid,
            'uid' => $user['userId'],
            'rid' => $rule['rule']['id'],
        );
        $uri = explode('/', substr($this->app->request->getResourceUri(), strlen('/review/opus/show/')));
        if ($uri[0] == 'start') {
            $param['status'] = '0';
        } elseif ($uri[0] == 'finish') {
            $param['status'] = '1';
        }
        if (!$out['data'] = $model->loadForAppraiser($param)) {
            $this->app->redirect('/review/opus/');
        }

        // Get previous and next
        $out['neighbour'] = $model->loadNeighbour($param);

        if ($out['data']['status'] == '1') {
            // Get content for opus
            $out['content'] = $model->loadContent($out['data']['appraiseId']);
        } else {
            $out['rule'] = $rule['item'];
        }
        $out['search'] = $param;

        $this->display('site/opus_show.html', $out);
    }
/*}}}*/
/*{{{ Appraise */
    public function Appraise() {
        $user = $this->app->session->get('user');
        $rule = $this->app->session->get('rule');
        $param = array(
            'pid' => $this->app->request->post('pid'),
            'aid' => $this->app->request->post('aid'),
            'rule' => $this->app->request->post('rule'),
            'uid' => $user['userId'],
            'rid' => $rule['rule']['id'],
        );
        $model = new \app\model\Appraiser();
        if ($model->fillout($param)) {
            $out['status'] = 200;
            $out['msg'] = '评审成功';
            $this->rendJSON($out);
        }

        $out['status'] = 400;
        $out['msg'] = '系统忙，请稍后...';
        $this->rendJSON($out);
    }
/*}}}*/
/*{{{ start */
    public function start() {
        $this->index(0, '/review/opus/start/?');
    }
/*}}}*/
/*{{{ finish */
    public function finish() {
        $this->index(1, '/review/opus/finish/?');
    }
/*}}}*/

}

?>
