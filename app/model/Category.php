<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Category.php
* @touch date Wed 02 Jul 2014 03:16:08 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\model;

class Category extends \Shark\Core\Model {

/*{{{ loadAll */
    public function loadAll() {
        $q = 'SELECT * FROM Category;';
        $query = $this->db->prepare($q);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
/*}}}*/

}
?>
