<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Model.php
* @touch date Thu 08 May 2014 01:59:52 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Core;

abstract class Model {

/*{{{ variable*/
    protected $app;
    protected $db;
/*}}}*/
/*{{{ construct */
    public function __construct() {
        $this->app = \Slim\Slim::getInstance();

        if (!isset($this->app->db)) {
           throw new \Exception('Please Load db before.');
        }
        $this->db = $this->app->db;
    }
/*}}}*/
/*{{{ execute */
    /**
     * Execute for table
     * @param table: The name of table
     * @param type: The operation for table, such as insert, update, delete. 
     * @param data: The data for insert or update table, the data for delete table. 
     * @param where: The where condition for update or delete table. 
     */
    protected function execute($table, $type, $data, $where = array()) {
        if (!$table) {
           throw new \Exception('Please set table for execute method.');
        }

        $action = array('insert', 'add', 'update', 'up', 'delete', 'del');
        $type = strtolower($type);
        if (!in_array($type, $action)) {
            throw new \Exception(sprintf('Model Execute method only support: %s.', implode(',', $action)));
        }
        if (!$data) {
           throw new \Exception('Please set data or where for execute method.');
        }

        switch ($type) {
            case 'insert':
            case 'add':
                return $this->_insert($table, $data);
                break;
            case 'update':
            case 'up':
                return $this->_update($table, $data, $where);
                break;
            case 'delete':
            case 'del':
                return $this->_delete($table, $data? $data: $where);
                break;
        }

        return false;
    }
/*}}}*/

/*{{{ parase */
    private function _parse($data) {
        $feild = array();
        $bind = array();
        foreach ($data as $key => $val) {
            // *i: int, *s: str, *f: fun
            if (substr($key, -2, 1) == '*') {
                $k = substr($key, 0, -2);
                switch (strtolower(substr($key, -1))) {
                    case 'i':
                        $feild[$k] = ':' . $k;
                        $bind[$k] = array('type' => \PDO::PARAM_INT, 'val' => $val);
                        break;
                    case 's':
                        $feild[$k] = ':' . $k;
                        $bind[$k] = array('type' => \PDO::PARAM_STR, 'val' => $val);
                        break;
                    case 'f':
                        $feild[$k] = $val;
                        break;
                    default:
                        throw new \Exception(sprintf('Do not support the param %s.', $key));
                        break;
                }
            } else {
                $feild[$key] = ':' . $key;
                $bind[$key] = array('type' => \PDO::PARAM_STR, 'val' => $val);
            }
        }

        return array(
            'feild' => $feild,
            'bind' => $bind,
        );
    }
/*}}}*/
/*{{{ insert */
    private function _insert($table, $param){
        $data = $this->_parse($param);

        $q = sprintf('INSERT INTO `%s`(`%s`) VALUES(%s);', $table, implode('`, `', array_keys($data['feild'])), implode(', ', array_values($data['feild'])));
        $query = $this->db->prepare($q);

        foreach ($data['bind'] as $key => &$val) {
            $query->bindParam($key, $val['val'], $val['type']);
        }

        if ($query->execute()) {
            return $this->db->lastInsertId();
        }

        return false;
    }
    /*}}}*/
/*{{{ update */
    private function _update($table, $param, $where) {
        $updateData = $this->_parse($param);
        $updateFeild = array_map(function($k, $v) {
            return sprintf('`%s`=%s', $k, $v);
        }, array_keys($updateData['feild']), array_values($updateData['feild']));

        $whereData = $this->_parse($where);
        $whereFeild = array_map(function($k, $v) {
            $op = substr(trim($v), 0, 1);
            switch ($op) {
                case ':':
                    $out = sprintf('`%s`=%s_w', $k, $v);
                    break;
                case '<':
                case '>':
                case '=':
                    $out = sprintf('`%s`%s', $k, $v);
                    break;
                default:
                    $out = sprintf('`%s`=%s', $k, $v);
                    break;
            }
            return $out;
        }, array_keys($whereData['feild']), array_values($whereData['feild']));

        $q = sprintf('UPDATE `%s` SET %s WHERE %s;', $table, implode(', ', $updateFeild), implode(' AND ', $whereFeild));
        $query = $this->db->prepare($q);

        // Bind param for update feild
        foreach ($updateData['bind'] as $key => &$val) {
            $query->bindParam($key, $val['val'], $val['type']);
        }
        // Bind param for where feild
        foreach ($whereData['bind'] as $key => &$val) {
            $query->bindParam($key . '_w', $val['val'], $val['type']);
        }

        if ($query->execute() && $query->rowCount()) {
            return true;
        }
        return false;
    }
/*}}} */
/*{{{ delete */
    private function _delete($table, $where) {
        $whereData = $this->_parse($where);
        $whereFeild = array_map(function($k, $v) {
            $op = substr(trim($v), 0, 1);
            switch ($op) {
                case '<':
                case '>':
                case '=':
                    $out = sprintf('`%s`%s', $k, $v);
                    break;
                case ':':
                default:
                    $out = sprintf('`%s`=%s', $k, $v);
                    break;
            }
            return $out;
        }, array_keys($whereData['feild']), array_values($whereData['feild']));

        $q = sprintf('DELETE FROM `%s` WHERE %s;', $table, implode(' AND ', $whereFeild));
        $query = $this->db->prepare($q);

        // Bind param for where feild
        foreach ($whereData['bind'] as $key => &$val) {
            $query->bindParam($key, $val['val'], $val['type']);
        }

        if ($query->execute() && $query->rowCount()) {
            return true;
        }

        return false;
    }
/*}}} */

}
