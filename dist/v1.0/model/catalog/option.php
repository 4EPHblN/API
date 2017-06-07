<?php
namespace OpenCartWebAPI;

class ModelOption extends Model {
    /**
     * 
     * @param $data
     * @return object
     */
    public function addOption($data) {
//        $this->event->trigger('pre.admin.option.add', $data);
        $template = array(
            'type' => '',
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = '" . $this->db->escape($data['type']) . "', sort_order = '" . (int)$data['sort_order'] . "'");
        $option_id = $this->db->getLastId();

        foreach ($data['option_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "option_description` SET option_id = '" . (int)$option_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        if (isset($data['option_value'])) {
            foreach ($data['option_value'] as $option_value) {
                $option_value += array(
                    'image' => '',
                    'sort_order' => 0,
                );
                $this->db->query("INSERT INTO `" . DB_PREFIX . "option_value` SET option_id = '" . (int)$option_id . "', image = '" . $this->db->escape(html_entity_decode($option_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$option_value['sort_order'] . "'");

                $option_value_id = $this->db->getLastId();

                foreach ($option_value['option_value_description'] as $lang_code => $option_value_description) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "option_value_description` SET option_value_id = '" . (int)$option_value_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', option_id = '" . (int)$option_id . "', name = '" . $this->db->escape($option_value_description['name']) . "'");
                }
            }
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.option.add', $option_id);
        return $this->getOptionFull(array($option_id));
    }

    /**
     *
     * @param $matches
     * @param $data
     * @return object
     */
    public function editOption($matches, $data) {
        $option_id = $matches[0];
//        $this->event->trigger('pre.admin.option.edit', $data);
        $template = array(
            'type' => '',
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("UPDATE `" . DB_PREFIX . "option` SET type = '" . $this->db->escape($data['type']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE option_id = '" . (int)$option_id . "'");

        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_description` WHERE option_id = '" . (int)$option_id . "'");
        foreach ($data['option_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "option_description` SET option_id = '" . (int)$option_id . "', language_id = '" . $this->getLangIdByCode($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_value` WHERE option_id = '" . (int)$option_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_value_description` WHERE option_id = '" . (int)$option_id . "'");
        if (isset($data['option_value'])) {
            foreach ($data['option_value'] as $option_value) {
                $data['option_value'] += array(
                    'image' => '',
                    'sort_order' => 0,
                );
                if ($option_value['option_value_id']) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "option_value` SET option_value_id = '" . (int)$option_value['option_value_id'] . "', option_id = '" . (int)$option_id . "', image = '" . $this->db->escape(html_entity_decode($option_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$option_value['sort_order'] . "'");
                } else {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "option_value` SET option_id = '" . (int)$option_id . "', image = '" . $this->db->escape(html_entity_decode($option_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$option_value['sort_order'] . "'");
                }

                $option_value_id = $this->db->getLastId();

                foreach ($option_value['option_value_description'] as $lang_code => $option_value_description) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "option_value_description` SET option_value_id = '" . (int)$option_value_id . "', language_id = '" . $this->getLangIdByCode($lang_code) . "', option_id = '" . (int)$option_id . "', name = '" . $this->db->escape($option_value_description['name']) . "'");
                }
            }

        }

        $this->db->commit();
//        $this->event->trigger('post.admin.option.edit', $option_id);
        return $this->getOptionFull(array($option_id));
    }

    /**
     *
     * @param $matches
     * @return int
     */
    public function deleteOption($matches) {
        $option_id = $matches[0];
//        $this->event->trigger('pre.admin.option.delete', $option_id);

        $this->db->query("DELETE FROM `" . DB_PREFIX . "option` WHERE option_id = '" . (int)$option_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_description` WHERE option_id = '" . (int)$option_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_value` WHERE option_id = '" . (int)$option_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "option_value_description` WHERE option_id = '" . (int)$option_id . "'");

        $this->db->commit();
//        $this->event->trigger('post.admin.option.delete', $option_id);
        return $this->db->affectedRows();
    }

    /**
     *
     * @param $matches
     * @return object
     */
    public function getOption($matches) {
        $option_id = $matches[0];

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o 
            LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) 
            WHERE o.option_id = '" . (int)$option_id . "' AND od.language_id = '" . $this->langId . "'");

        return $query['row'];
    }

    /**
     *
     * @return array 
     */
    public function getOptions() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o 
            LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) 
            WHERE od.language_id = '" . $this->langId . "'");

        return $query['rows'];
    }

    /**
     *
     * @param $matches
     * @return object
     */
    public function getOptionFull($matches) {
        $option_id = $matches[0];
        $option = null;

        $option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` 
            WHERE option_id = '" . (int)$option_id . "'");

        if ($option_query['num_rows'] > 0) {
            $option = $option_query['row'];

            $od_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_description` 
                WHERE option_id = '" . (int)$option_id . "'");

            $option['option_description'] = array();
            foreach ($od_query['rows'] as $row) {
                $option['option_description'][$this->convertLangId2Code((int)$row['language_id'])] = $row;
            }

            $ov_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_value` 
                WHERE option_id = '" . (int)$option_id . "'");

            if ($ov_query['num_rows'] > 0) {
                $option['option_value'] = $ov_query['rows'];

                foreach ($option['option_value'] as $idx => $option_value) {
                    $ovd_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_value_description` 
                        WHERE option_value_id = '{$option_value['option_value_id']}'");

                    $option['option_value'][$idx]['option_value_description'] = array();

                    foreach ($ovd_query['rows'] as $row) {
                        $option['option_value'][$idx]['option_value_description'][$this->convertLangId2Code((int)$row['language_id'])] = $row;
                    }
                }
            }
        }

        return $option;
    }

    /**
     *
     * @return array
     */
    public function getOptionsFull() {
        $options = array();

        $sql = "SELECT DISTINCT o.option_id FROM `" . DB_PREFIX . "option` AS o";

        if (sizeof($this->params['filter']) > 0 || sizeof($this->params['sort']) > 0) {
            $sql .= " INNER JOIN `" . DB_PREFIX . "option_description` od ON (od.option_id = o.option_id) ";
        }

        if (sizeof($this->params['filter']) > 0) {
            $joinedArgs = 0;
            $filter = array(
                'option_id',
                'name',
                'type',
                'sort_order',
            );
            foreach ($this->params['filter'] as $rule) {
                $spl_arr = mb_split(":", $rule);
                if (in_array($spl_arr[0], $filter)) {
//                    $sql .= ($joinedArgs++ > 0) ? " AND " : " WHERE ";
                    // TODO: AND |?& OR ???????????????????????????
                    $sql .= ($joinedArgs++ > 0) ? " OR " : " WHERE ";

                    if      ($spl_arr[0] == 'option_id')  $sql .= " o.option_id = '{$this->db->escape($spl_arr[1])}'";
                    else if ($spl_arr[0] == 'name')       $sql .= " od.name = '{$this->db->escape($spl_arr[1])}' AND od.language_id = '{$this->langId}'";
                    else if ($spl_arr[0] == 'type')       $sql .= " o.type = '{$this->db->escape($spl_arr[1])}'";
                    else if ($spl_arr[0] == 'sort_order') $sql .= " o.sort_order = '{$this->db->escape($spl_arr[1])}'";
                }
            }
        }

        $totalQuery = $this->db->query($sql);

        if (sizeof($this->params['sort']) > 0) {
            $joinedArgs = 0;
            $sort = array(
                'option_id',
                'name',
                'type',
                'sort_order',
            );
            foreach ($this->params['sort'] as $rule) {
                $spl_arr = mb_split(":", $rule);
                if (in_array($spl_arr[0], $sort)) {
                    $sql .= ($joinedArgs++ > 0) ? ", " : " ORDER BY ";

                    if      ($spl_arr[0] == 'option_id')  $sql .= " o.option_id {$this->db->escape($spl_arr[1])}";
                    else if ($spl_arr[0] == 'name')       $sql .= " od.name {$this->db->escape($spl_arr[1])}";
                    else if ($spl_arr[0] == 'type')       $sql .= " o.type {$this->db->escape($spl_arr[1])}";
                    else if ($spl_arr[0] == 'sort_order') $sql .= " o.sort_order {$this->db->escape($spl_arr[1])}";
                }
            }
        } else {
            $sql .= " ORDER BY o.sort_order ASC";
        }

        $sql .= " LIMIT {$this->params['offset']},{$this->params['count']}";

//        echo var_export($sql, true);
//        exit;

        $query = $this->db->query($sql);

        if ($query['num_rows'] > 0) {
            foreach ($query['rows'] as $row) {
                $options[] = $this->getOptionFull(array($row['option_id']));
            }
        }

        $this->result['result'] = $options;
        $this->result['total'] = $totalQuery['num_rows'];
        $this->result['count'] = $query['num_rows'];
        $this->result['offset'] = $this->params['offset'];
        
        return $options;
    }
}
