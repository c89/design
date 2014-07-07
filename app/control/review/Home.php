<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename home.php
* @touch date Wed 07 May 2014 02:23:50 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\review;

class Home extends \Shark\Core\Control {

/*{{{ index */
    public function index() {
        $out = array();
        if ($rule = $this->app->session->get('rule')) {
            $out['rule'] = $rule['rule'];
        }
        $this->display('site/home.html', $out);
    }
/*}}}*/

}

?>
