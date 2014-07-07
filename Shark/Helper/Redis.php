<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Redis.php
* @touch date Wed 07 May 2014 05:55:38 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Helper;

class Redis {

/*{{{ variable*/
    private $connect;
    private $redis;
    private $app;
    /*}}}*/
/*{{{ construct */
    /**
     * Constructor
     * @param  object  $app
     */
    public function __construct() {
        if (!extension_loaded('redis')) {
           throw new \RuntimeException('Redis module not loaded.');
        }

        $this->app = \Slim\Slim::getInstance();
        $config = $this->app->config('redis');

        $redis = new \Redis();
        if (!$config['pconnected']) {
            if (!$redis->connect($config['host'], $config['port'], $config['timeout'], $config['reserved'])) {
                throw new \Exception('Could not connect to Redis at ' . $config['host'] . ':' . $config['port']);
            }
            $this->connect = true;
        } else {
            if (!$redis->pconnect($config['host'], $config['port'], $config['timeout'], $config['reserved'])) {
                throw new \Exception('Could not pconnect to Redis at ' . $config['host'] . ':' . $config['port']);
            }
        }

        if ($config['password']) {
            if (!$redis->auth($config['password'])) {
                throw new \Exception('Could not connect to Redis, invalid password');
            }
        }
        $this->redis = $redis;
    }
/*}}}*/
/*{{{ __call */
    public function __call($method, $args) {
        if (method_exists($this->redis, $method)) {
            return call_user_func_array(array($this->redis, $method), $args);
        }

        return false;
    }
/*}}}*/
/*{{{ destruct */
    public function __destruct() {
        if ($this->connect) {
            $this->redis->close();
        }
    }
/*}}}*/

}
