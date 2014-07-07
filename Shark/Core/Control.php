<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Control.php
* @touch date Sat 10 May 2014 03:05:37 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Core;

abstract class Control{

/*{{{ variable*/
    protected $app;
    protected $view;
    protected $pagination;
    protected $config;
/*}}}*/
/*{{{ construct */
    /**
     * Constructor
     * @param  object  $app
     */
    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
        $this->view = new \Shark\Helper\Twig();
        $this->config = array(
            'pagination' => $this->app->config('pagination'),
        );
    }
/*}}}*/
/*{{{ render */
    public function render($template, $data = array()) {
        $this->view->render($template, $data);
    }
/*}}}*/
/*{{{ display */
    public function display($template, $data = array()) {
        $this->view->display($template, $data);
    }
/*}}}*/
/*{{{ rendJSON */
    public function rendJSON($data) {
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->write(json_encode($data));
        $this->app->stop();
    }
/*}}}*/
/*{{{ pagination */
    public function pagination($param) {
        if (!$this->pagination) {
            $this->pagination = new \Shark\Helper\Pagination();
        }
        if (!isset($param['per_page'])) {
            $param['per_page'] = $this->config['pagination']['per_page'];
        }
        $this->pagination->initialize($param);

        return $this->pagination->get_links();
    }
/*}}}*/

}
?>

