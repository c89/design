<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename api.php
* @touch date Wed 07 May 2014 12:37:20 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\api;

class Area extends \Shark\Core\Control {
/*{{{ index */
    public function index() {
        $model = new \app\model\Area($this->app);
        $out = $model->loadAll();

        $this->rendJSON($out);
    }
/*}}}*/
}

?>
