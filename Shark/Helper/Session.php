<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Session.php
* @touch date Wed 07 May 2014 09:55:11 PM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Helper;

class Session {

/*{{{ variable*/
    private $app;
/*}}}*/
/*{{{ __construct */
    public function __construct(){
        $this->app = \Slim\Slim::getInstance();

        $config = $this->app->config('session');
        $time = $config['time'];
        $name = $config['name'];

        session_cache_limiter(false);
        session_cache_expire($time);

        session_name($name);
//        session_set_cookie_params($time);
        session_start();

        $now = time();
        if (isset($_SESSION['last_activity']) 
            && (($_SESSION['last_activity'] + $time) < $now OR $_SESSION['last_activity'] > $now)) {
            $this->destroy();
            session_start();
        }
        $_SESSION['last_activity'] = $now;
    }
/*}}}*/
/*{{{ set */
    function set($key, $val){
        $_SESSION[$key] = $val;
    }   
/*}}}*/
/*{{{ get */
    function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }   

        return false;
    }   
/*}}}*/
/*{{{ del */
    public function del($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }   
    }   
/*}}}*/
/*{{{ destroy */
    public function destroy(){
        if(!isset($_SESSION)) {
            return false;
        }

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-1, '/');
        }
        session_unset();
        session_destroy();
    }
/*}}}*/

}
