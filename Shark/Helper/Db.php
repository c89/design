<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Db.php
* @touch date Wed 07 May 2014 10:12:54 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Helper;

class Db {

/*{{{ variable*/
    private $connect;
    private $pdo;
    private $app;
    private $orm;
/*}}}*/
/*{{{ construct */
    /**
     * Constructor
     * @param  object  $app
     */
    public function __construct() {
        if (!extension_loaded('pdo')) {
           throw new \RuntimeException('Pdo module not loaded.');
        }

        $this->app = \Slim\Slim::getInstance();
        $config = $this->app->config('mysql');
        $this->pdo = new \PDO($config['dsn'], $config['username'], $config['password']); 
    }
/*}}}*/
/*{{{ orm */
    public function orm() {
        if (!$this->orm) {
            include('NotORM\NotORM.php');
            $this->orm = new NotORM($this->pdo);
        }

        return $this->orm;
    }
/*}}}*/
/*{{{ __call */
    public function __call($method, $args) {
        if (method_exists($this->pdo, $method)) {
            return call_user_func_array(array($this->pdo, $method), $args);
        }

        return false;
    }
/*}}}*/
/*{{{ destruct */
    public function __destruct() {
        if ($this->pdo) {
            $this->pdo = null;
        }
    }
/*}}}*/

}
