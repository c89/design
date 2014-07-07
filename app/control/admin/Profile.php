<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Profile.php
* @touch date Mon 30 Jun 2014 03:57:46 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\control\admin;

class Profile extends \Shark\Core\Control {

/*{{{ index */
    public function index() {
        $out = array();
        $out['data'] = $this->app->session->get('user');

        $this->display('admin/profile.html', $out);
    }
/*}}}*/

}

?>
