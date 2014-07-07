<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename User.php
* @touch date Thu 08 May 2014 01:53:12 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\model;

class User extends \Shark\Core\Model {

/*{{{ loadAll */
	public function loadAllAppraiser($param){
        $out = array();

        $f = 'SELECT %s FROM User WHERE roleId=2';
        // Get total
        $q = sprintf($f, 'COUNT(1)');
        $query = $this->db->prepare($q);
        $query->execute();
        if ($tmp = $query->fetchColumn()) {
            $out['total'] = $tmp;

            // Get data
            $q = sprintf($f, 'userId, nickName') . sprintf(' LIMIT %d, %d;', ($param['page'] - 1) * $param['per_page'], $param['per_page']);
            $query = $this->db->prepare($q);
            $query->execute();

            $out['data'] = array();
            while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                $out['data'][] = $row;
            }
        }

		return $out;
	}
/*}}}*/
/*{{{ loadById */
    public function loadById($uid) {
        $q = 'SELECT * FROM User WHERE userId=:uid LIMIT 1';
        $query = $this->db->prepare($q);
        $query->bindParam(':uid', $uid);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }
/*}}}*/
/*{{{ loadByName */
    public function loadByName($name) {
        $q = 'SELECT * FROM User WHERE userName=:name LIMIT 1';
        $query = $this->db->prepare($q);
        $query->bindParam(':name', $name);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }
/*}}}*/

}
