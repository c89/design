<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Delivery.php
* @touch date Wed 07 May 2014 12:37:20 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\api;

class Delivery extends \Shark\Core\Control {

/*{{{ variable */
    private $secret;
    private $timestamp;
    private $nonce;
    private $signature;
    private $whitelist;
/*}}}*/
/*{{{ construct */
    public function __construct(){
        parent::__construct();

        $config = $this->app->config('delivery');
        $this->secret = ($this->app->config('debug'))? 'debug': $config['secret'];
        $this->whitelist = $config['whitelist'];
        // Check user ip
        if (!in_array($this->app->request->getIp(), $this->whitelist)) {
            $this->app->halt(404);
        }

        $this->timestamp = $this->app->request->params('timestamp');
        $this->nonce = $this->app->request->params('nonce');
        $this->signature = $this->app->request->params('signature');

        // Validate Sign
        $tmpArr = array($this->secret, $this->timestamp, $this->nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr != $this->signature) {
            $out = array();
            $out['status'] = 400;
            $this->rendJSON($out);
        }
    }
/*}}}*/
/*{{{ index */
    public function index() {
        $out = array();

        $model = new \app\model\Delivery();
        $tmp = $model->loadAllForExpress();
        if ($tmp === false) {
            $out['status'] = 404;
            $out['reason'] = '服务器开小差了，稍后再试。';
            $this->rendJSON($out);
        }
        $out['status'] = 200;
        $out['data'] = $tmp;

        $this->rendJSON($out);
    }
/*}}}*/
/*{{{ receive */
    public function receive() {
        $out = array();

        if (!$no = $this->app->request->params('no')) {
            $out['status'] = 400;
            $out['reason'] = '传入参数有误。';
            $this->rendJSON($out);
        }

        $model = new \app\model\Delivery();
        $no = array_map(function($val) {
            return trim($val);
        }, explode(',', $no));

        if (!$model->receiveFromExpress($no)) {
            $out['status'] = 404;
            $out['reason'] = '配送信息可能已经过期，请重新提取配送信息。';
            $this->rendJSON($out);
        }

        $out['status'] = 200;
        $this->rendJSON($out);
    }
/*}}}*/
/*{{{ feedback */
    public function feedback() {
        $out = array();

        $param = array(
            'no' => $this->app->request->params('no'),
            'status' => $this->app->request->params('status'),
            'reason' => $this->app->request->params('reason'),
        );
        if (!$param['no'] || !$param['status']) {
            $out['status'] = 400;
            $out['reason'] = '传入参数有误。';
            $this->rendJSON($out);
        }

        $model = new \app\model\Delivery();
        $param['status'] = ($param['status'] == 200)? 1: 0;
        if (!$model->feedbackFromExpress($param)) {
            $out['status'] = 404;
            $out['reason'] = '配送信息反馈失败，或因配送单不存在，请检查单号。';
            $this->rendJSON($out);
        }

        $out['status'] = 200;
        $this->rendJSON($out);
    }
/*}}}*/

}
