<?php

namespace Mod\rbcity\Model;
use Zend_Db_Table_Abstract;

/**
 * Class Modules
 */
class City extends Zend_Db_Table_Abstract
{

    protected $_name = 'module_city';

    /**
     * @param string $id
     * @return mixed
     */
    public function getRbcityById($id)
    {
        $res = $this->_db->fetchRow("
            SELECT 
                    id, name, code
                FROM
                    module_city
                where id  = ? 
            LIMIT 1
        ", $id);
        return $res;
    }
}