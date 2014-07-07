<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Opus.php
* @touch date Wed 02 Jul 2014 03:16:08 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\model;

class Opus extends \Shark\Core\Model {

/*{{{ loadAllForReviewer */
    public function loadAllForReviewer($param) {
        $out = array();

        $join = array();
        $bind = array();
        $where = array('P.state=\'A\'');

        $join[] = 'INNER JOIN Appraise A ON A.productionId=P.productionId AND A.userId=:uid AND A.ruleId=:rid';
        $bind['uid'] = $param['uid'];
        $bind['rid'] = $param['rid'];
        if (isset($param['status'])) {
            $where[] = 'A.status=:status';
            $bind['status'] = $param['status'];
        }

        if ($param['category']) {
            $join[] = 'INNER JOIN ProductionCategory PC ON PC.productionId=P.productionId AND PC.categoryId=:category';
            $bind[':category'] = $param['category'];
        }
        if ($param['name']) {
            $where[] = '(P.number=:name OR P.company=:name OR P.name=:name)';
            $bind[':name'] = $param['name'];
        }

        $f = sprintf('SELECT %%s FROM Production P %s WHERE %s', implode(' ', $join), implode(' AND ', $where));
        // Get total
        $q = sprintf($f, 'COUNT(1)');
        $query = $this->db->prepare($q);
        foreach ($bind as $key => &$val) {
            $query->bindParam($key, $val);
        }
        $query->execute();
        if ($tmp = $query->fetchColumn()) {
            $out['total'] = $tmp;

            // Get data
            $q = sprintf($f, 'P.*, A.appraiseId, A.status') . sprintf(' LIMIT %d, %d;', ($param['page'] - 1) * $param['per_page'], $param['per_page']);
            $query = $this->db->prepare($q);
            foreach ($bind as $key => &$val) {
                $query->bindParam($key, $val);
            }
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
    public function loadById($id) {
        $q = 'SELECT * FROM Production WHERE productionId=:id;';
        $query = $this->db->prepare($q);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
/*}}}*/
/*{{{ loadForAppraiser */
    public function loadForAppraiser($param) {
        $q = 'SELECT * FROM Production P 
        INNER JOIN Appraise A ON P.productionId=A.productionId AND A.userId=:uid ANd A.ruleId=:rid
        WHERE P.productionId=:pid AND P.state=\'A\'';
        if (isset($param['status'])) {
            $q .= ' AND A.status=' . $param['status'];
        }
        $query = $this->db->prepare($q);
        $query->bindParam(':pid', $param['pid']);
        $query->bindParam(':uid', $param['uid']);
        $query->bindParam(':rid', $param['rid']);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
/*}}}*/
/*{{{ loadContent */
    public function loadContent($id) {
        $q = 'SELECT * FROM AppraiseContent WHERE appraiseId=:id;';
        $query = $this->db->prepare($q);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
/*}}}*/
/*{{{ loadNeighbour */
    public function loadNeighbour($param) {
        $out = array();

        $q = 'SELECT productionId FROM Appraise WHERE productionId<:pid AND userId=:uid ANd ruleId=:rid %s ORDER BY productionId DESC LIMIT 1;';
        if (isset($param['status'])) {
            $q = sprintf($q, ' AND status=' . $param['status']);
        } else {
            $q = sprintf($q, '');
        }
        $query = $this->db->prepare($q);
        $query->bindParam(':pid', $param['pid']);
        $query->bindParam(':uid', $param['uid']);
        $query->bindParam(':rid', $param['rid']);
        $query->execute();
        $out['prev'] = $query->fetch(\PDO::FETCH_ASSOC);

        $q = 'SELECT productionId FROM Appraise WHERE productionId>:pid AND userId=:uid ANd ruleId=:rid %s ORDER BY productionId ASC LIMIT 1;';
        if (isset($param['status'])) {
            $q = sprintf($q, ' AND status=' . $param['status']);
        } else {
            $q = sprintf($q, '');
        }
        $query = $this->db->prepare($q);
        $query->bindParam(':pid', $param['pid']);
        $query->bindParam(':uid', $param['uid']);
        $query->bindParam(':rid', $param['rid']);
        $query->execute();
        $out['next'] = $query->fetch(\PDO::FETCH_ASSOC);

        return $out;
    }
/*}}}*/

/*{{{ loadForAssign */
    public function loadForAssign($param) {
        $out = array();
 
        $f = sprintf('SELECT %%s FROM Production P 
        WHERE P.state=\'A\' AND P.productionId NOT IN (SELECT productionId FROM Appraise WHERE ruleId=%d)', $param['rid']);
        // Get total
        $q = sprintf($f, 'COUNT(1)');
        $query = $this->db->prepare($q);
        $query->execute();
        if ($tmp = $query->fetchColumn()) {
            $out['total'] = $tmp;
 
            // Get data
            $q = sprintf($f, 'productionId, number, company, name') . sprintf(' LIMIT %d, %d;', ($param['page'] - 1) * $param['per_page'], $param['per_page']);
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
/*{{{ assign */
    public function assign($param) {
        $q = 'SELECT COUNT(1) FROM Appraise WHERE productionId=:pid AND userId=:uid AND ruleId=:rid;';
        $query = $this->db->prepare($q);
        $query->bindParam(':pid', $param['pid']);
        $query->bindParam(':uid', $param['uid']);
        $query->bindParam(':rid', $param['rid']);
        $query->execute();
        if ($query->fetchColumn()) {
            return false;
        }

        $data = array(
            'productionId' => $param['pid'],
            'userId' => $param['uid'],
            'ruleId' => $param['rid'],
            'status' => 0,
            'createTime*f' => 'now()',
        );

        return $this->execute('Appraise', 'add', $data);
    }
/*}}}*/
/*{{{ loadForStart */
    public function loadForStart($param) {
        $out = array();
 
        $f = sprintf('SELECT %%s FROM Production P 
        WHERE P.state=\'A\' AND P.productionId IN (SELECT productionId FROM Appraise WHERE ruleId=%d AND userId=%d AND status=0)', $param['rid'], $param['uid']);
        // Get total
        $q = sprintf($f, 'COUNT(1)');
        $query = $this->db->prepare($q);
        $query->execute();
        if ($tmp = $query->fetchColumn()) {
            $out['total'] = $tmp;
 
            // Get data
            $q = sprintf($f, 'productionId, number, company, name') . sprintf(' LIMIT %d, %d;', ($param['page'] - 1) * $param['per_page'], $param['per_page']);
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
/*{{{ unassign */
    public function unassign($param) {
        $q = 'SELECT COUNT(1) FROM Appraise WHERE productionId=:pid AND userId=:uid AND ruleId=:rid AND status<>1;';
        $query = $this->db->prepare($q);
        $query->bindParam(':pid', $param['pid']);
        $query->bindParam(':uid', $param['uid']);
        $query->bindParam(':rid', $param['rid']);
        $query->execute();
        if (!$query->fetchColumn()) {
            return false;
        }

        $data = array(
            'productionId' => $param['pid'],
            'userId' => $param['uid'],
            'ruleId' => $param['rid'],
        );

        return $this->execute('Appraise', 'del', $data);
    }
/*}}}*/
/*{{{ loadForFinish */
    public function loadForFinish($param) {
        $out = array();
 
        $f = sprintf('SELECT %%s FROM Production P 
        WHERE P.state=\'A\' AND P.productionId IN (SELECT productionId FROM Appraise WHERE ruleId=%d AND userId=%d AND status=1)', $param['rid'], $param['uid']);
        // Get total
        $q = sprintf($f, 'COUNT(1)');
        $query = $this->db->prepare($q);
        $query->execute();
        if ($tmp = $query->fetchColumn()) {
            $out['total'] = $tmp;
 
            // Get data
            $q = sprintf($f, 'productionId, number, company, name') . sprintf(' LIMIT %d, %d;', ($param['page'] - 1) * $param['per_page'], $param['per_page']);
            $query = $this->db->prepare($q);
            $query->execute();
 
            $out['data'] = array();
            $ids = array();
            while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                $out['data'][$row['productionId']] = $row;
                $ids[] = $row['productionId'];
            }
            
            // Get content for appraise
            $q = sprintf('SELECT A.productionId, AC.content 
                FROM AppraiseContent AC 
                INNER JOIN Appraise A ON A.appraiseId=AC.appraiseId AND ruleId=%d AND userId=%d AND status=1 AND A.productionId IN(%s)
            ', $param['rid'], $param['uid'], implode(',', $ids));
            $query = $this->db->prepare($q);
            $query->execute();
            while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                $out['data'][$row['productionId']]['content'][] = $row['content'];
            }
        }
 
        return $out;
    }
/*}}}*/

}
?>
