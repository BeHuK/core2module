<?php
require_once("core2/inc/ajax.func.php");

/**
 * Class ModAjax
 */
class ModAjax extends ajaxFunc
{
    public function axSaveCity($data)
    {
        $this->db->beginTransaction();
        try {
            if ($data['params']['edit'] && $data['params']['edit'] !== 0) {
                foreach ($data['control'] as $field => $value) {
                    $where = $this->db->quoteInto("id = ?", $data['params']['edit']);
                    $this->db->update('module_city',
                        array(
                            $field => $value
                        ),
                        $where
                    );
                }
            } else {
                $this->db->insert('module_city', $data['control']);
            }

            $this->db->commit();
            $this->done($data);
        } catch (Exception $e) {
            $this->db->rollback();
            $this->error[] = $e->getMessage();
            $this->displayError($data);
        }
        return $this->response;
    }


}