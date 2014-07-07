<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/** 
* @filename Home.php
* @touch date Sat 10 May 2014 03:54:20 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\admin;

class Home extends \Shark\Core\Control {

/*{{{ index */
    public function index() {
        $this->app->redirect('/admin/appraise/');
    }
/*}}}*/

}
