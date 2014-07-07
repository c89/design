<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Common.php
* @touch date Thu 08 May 2014 02:34:25 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Helper;

class Common {

/*{{{ variable*/
    private $app;
    private $config;
/*}}}*/
/*{{{ construct */
    /**
     * Constructor
     * @param  object  $app
     */
    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
        $config = $this->app->config('common');
    }
/*}}}*/
/*{{{ md5 */
    public function md5($name, $salt = '') {
        return \md5($name.$salt);
    }
/*}}}*/
/*{{{ encryptPwd */
    public function encryptPwd($name) {
        return $this->md5($name, $this->config['salt']);
    }
/*}}}*/

}
