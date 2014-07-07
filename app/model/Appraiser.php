<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Appraiser.php
* @touch date Thu 08 May 2014 01:53:12 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace app\model;

class Appraiser extends \Shark\Core\Model {

/*{{{ loadRule */
    public function loadRule() {
        $q = 'SELECT AR.ruleId, AR.name, AR.description, AR.startTime, AR.endTime, AI.appraiseItemId, AI.name, AI.itemType, AI.itemValue
        FROM AppraiseRule AR 
        INNER JOIN AppraiseRuleItem ARI ON ARI.ruleId=AR.ruleId 
        INNER JOIN AppraiseItem AI ON AI.appraiseItemId=ARI.appraiseItemId
        WHERE AR.startTime<=now() AND AR.endTime>now();';
        $query = $this->db->prepare($q);
        $query->execute();

        $out = array();
        while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $out[$row['ruleId']]['rule'] = array(
                'id' => $row['ruleId'],
                'name' => $row['name'],
                'desc' => $row['description'],
                'start' => $row['startTime'],
                'end' => $row['endTime'],
            );

            $out[$row['ruleId']]['item'][$row['appraiseItemId']] = array(
                'id' => $row['appraiseItemId'],
                'name' => $row['name'],
                'type' => $row['itemType'],
                'value' => $row['itemValue'],
            );
        }

        return $out? array_shift($out): false;
    }
/*}}}*/
/*{{{ fillout */
    public function fillout($param) {
        $data = array(
            'status' => '1',
        );
        $where = array(
            'productionId' => $param['pid'],
            'userId' => $param['uid'],
            'ruleId' => $param['rid'],
            'status*f' => '<>1',
        );
        if (!$this->execute('Appraise', 'up', $data, $where)) {
            return false;
        }

        $data = array(
            'appraiseId' => $param['aid'],
            'ruleItemId' => $param['rid'],
        );
        foreach ($param['rule'] as $key => $val) {
            $data['appraiseItemId'] = $val['id'];
            $data['content'] = json_encode($val);
            if(!$this->execute('AppraiseContent', 'add', $data)) {
                return false;
            }
        }

        return true;
    }
/*}}}*/

}
