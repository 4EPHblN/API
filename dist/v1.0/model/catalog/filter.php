<?php
namespace OpenCartWebAPI;

class ModelFilter extends Model {
    public function addFilter($data) {
//        $this->event->trigger('pre.admin.filter.add', $data);
        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("INSERT INTO `" . DB_PREFIX . "filter_group` SET sort_order = '" . (int)$data['sort_order'] . "'");

        $filter_group_id = $this->db->getLastId();

        foreach ($data['filter_group_description'] as $language_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "filter_group_description` SET filter_group_id = '" . (int)$filter_group_id . "', language_id = '" . $this->getLangIdByCode($language_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        if (isset($data['filter'])) {
            foreach ($data['filter'] as $filter) {
                $filter += array('sort_order' => 0);

                $this->db->query("INSERT INTO `" . DB_PREFIX . "filter` SET filter_group_id = '" . (int)$filter_group_id . "', sort_order = '" . (int)$filter['sort_order'] . "'");

                $filter_id = $this->db->getLastId();

                foreach ($filter['filter_description'] as $language_code => $filter_description) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "filter_description` SET filter_id = '" . (int)$filter_id . "', language_id = '" . $this->getLangIdByCode($language_code) . "', filter_group_id = '" . (int)$filter_group_id . "', name = '" . $this->db->escape($filter_description['name']) . "'");
                }
            }
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.filter.add', $filter_group_id);
        return $this->getFilterGroupFull(array($filter_group_id));
    }

    public function editFilter($matches, $data) {
        $filter_group_id = $matches[0];
//        $this->event->trigger('pre.admin.filter.edit', $data);

        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("UPDATE `" . DB_PREFIX . "filter_group` SET sort_order = '" . (int)$data['sort_order'] . "' WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter_group_description` WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        foreach ($data['filter_group_description'] as $language_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "filter_group_description` SET filter_group_id = '" . (int)$filter_group_id . "', language_id = '" . $this->getLangIdByCode($language_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter` WHERE filter_group_id = '" . (int)$filter_group_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter_description` WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        if (isset($data['filter'])) {
            foreach ($data['filter'] as $filter) {
                $filter += array('sort_order' => 0);

                if ($filter['filter_id']) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "filter` SET filter_id = '" . (int)$filter['filter_id'] . "', filter_group_id = '" . (int)$filter_group_id . "', sort_order = '" . (int)$filter['sort_order'] . "'");
                } else {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "filter` SET filter_group_id = '" . (int)$filter_group_id . "', sort_order = '" . (int)$filter['sort_order'] . "'");
                }

                $filter_id = $this->db->getLastId();

                foreach ($filter['filter_description'] as $language_code => $filter_description) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "filter_description` SET filter_id = '" . (int)$filter_id . "', language_id = '" . $this->getLangIdByCode($language_code) . "', filter_group_id = '" . (int)$filter_group_id . "', name = '" . $this->db->escape($filter_description['name']) . "'");
                }
            }
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.filter.edit', $filter_group_id);
        return $this->getFilterGroupFull(array($filter_group_id));
    }

    public function deleteFilter($matches) {
        $filter_group_id = $matches[0];
//        $this->event->trigger('pre.admin.filter.delete', $filter_group_id);

        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter_group` WHERE filter_group_id = '" . (int)$filter_group_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter_group_description` WHERE filter_group_id = '" . (int)$filter_group_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter` WHERE filter_group_id = '" . (int)$filter_group_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "filter_description` WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        $this->db->commit();
//        $this->event->trigger('post.admin.filter.delete', $filter_group_id);
        return $this->db->affectedRows();
    }

    public function getFilter($matches) {
        $filter_id = $matches[0];
        
        $query = $this->db->query("SELECT *, (SELECT name FROM `" . DB_PREFIX . "filter_group_description` fgd WHERE f.filter_group_id = fgd.filter_group_id AND fgd.language_id = '" . $this->langId . "') AS `group` 
                FROM `" . DB_PREFIX . "filter` f 
                LEFT JOIN `" . DB_PREFIX . "filter_description` fd ON (f.filter_id = fd.filter_id) 
                WHERE f.filter_id = '" . (int)$filter_id . "' AND fd.language_id = '" . $this->langId . "'");

        return $query['row'];
    }

    public function getFilters() {
        $sql = "SELECT *, (SELECT name FROM `" . DB_PREFIX . "filter_group_description` fgd WHERE f.filter_group_id = fgd.filter_group_id AND fgd.language_id = '" . $this->langId . "') AS `group` 
            FROM `" . DB_PREFIX . "filter` f 
            LEFT JOIN `" . DB_PREFIX . "filter_description` fd ON (f.filter_id = fd.filter_id) 
            WHERE fd.language_id = '" . $this->langId . "'";

//        TODO: Фильтры...
//        if (!empty($data['filter_name'])) {
//            $sql .= " AND fd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
//        }
//
//        $sql .= " ORDER BY f.sort_order ASC";
//
//        if (isset($data['start']) || isset($data['limit'])) {
//            if ($data['start'] < 0) {
//                $data['start'] = 0;
//            }
//
//            if ($data['limit'] < 1) {
//                $data['limit'] = 20;
//            }
//
//            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
//        }

        $query = $this->db->query($sql);

        return $query['rows'];
    }

    public function getFilterGroupFull($matches) {
        $filter_group_id = $matches[0];
        $filter_group = null;

        $filter_group_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_group` 
            WHERE filter_group_id = '{$filter_group_id}'");

        if ($filter_group_query['num_rows'] > 0) {
            $filter_group = $filter_group_query['row'];

            $fgd_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_group_description` 
                WHERE filter_group_id = '{$filter_group['filter_group_id']}'");

            $filter_group['filter_group_description'] = array();
            foreach ($fgd_query['rows'] as $row) {
                $filter_group['filter_group_description'][$this->convertLangId2Code((int)$row['language_id'])] = $row;
            }

            $filter_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter` 
                WHERE filter_group_id = '{$filter_group['filter_group_id']}'");

            if ($filter_query['num_rows'] > 0) {
                $filter_group['filter'] = $filter_query['rows'];

                foreach ($filter_group['filter'] as $idx => $filter) {
                    $fd_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_description` 
                        WHERE filter_id = '{$filter['filter_id']}'");

                    $filter_group['filter'][$idx]['filter_description'] = array();

                    foreach ($fd_query['rows'] as $row) {
                        $filter_group['filter'][$idx]['filter_description'][$this->convertLangId2Code((int)$row['language_id'])] = $row;
                    }
                }
            }
        }

        return $filter_group;
    }

    public function getFilterGroupsFull() {
        $filters = array();

        $query = $this->db->query("SELECT filter_group_id FROM `" . DB_PREFIX . "filter_group`");

        if ($query['num_rows'] > 0) {
            foreach ($query['rows'] as $row) {
                $filters[] = $this->getFilterGroupFull(array($row['filter_group_id']));
            }
        }

        return $filters;
    }

    public function getFilterDescriptions($filter_group_id) {
        $filter_data = array();

        $filter_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter` WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        foreach ($filter_query['rows'] as $filter) {
            $filter_description_data = array();

            $filter_description_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_description` WHERE filter_id = '" . (int)$filter['filter_id'] . "'");

            foreach ($filter_description_query['rows'] as $filter_description) {
                $filter_description_data[$this->convertLangId2Code((int)$filter_description['language_id'])] = array('name' => $filter_description['name']);
            }

            $filter_data[] = array(
                'filter_id'          => $filter['filter_id'],
                'filter_description' => $filter_description_data,
                'sort_order'         => $filter['sort_order']
            );
        }

        return $filter_data;
    }

    public function getFilterGroup($filter_group_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_group` fg 
            LEFT JOIN `" . DB_PREFIX . "filter_group_description` fgd ON (fg.filter_group_id = fgd.filter_group_id) 
            WHERE fg.filter_group_id = '" . (int)$filter_group_id . "' AND fgd.language_id = '" . $this->langId . "'");

        return $query['row'];
    }

    public function getFilterGroups() {
        $sql = "SELECT * FROM `" . DB_PREFIX . "filter_group` fg 
            LEFT JOIN `" . DB_PREFIX . "filter_group_description` fgd ON (fg.filter_group_id = fgd.filter_group_id) 
            WHERE fgd.language_id = '" . $this->langId . "'";

//        TODO: Фильтры...
//        $sort_data = array(
//            'fgd.name',
//            'fg.sort_order'
//        );
//
//        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//            $sql .= " ORDER BY " . $data['sort'];
//        } else {
//            $sql .= " ORDER BY fgd.name";
//        }
//
//        if (isset($data['order']) && ($data['order'] == 'DESC')) {
//            $sql .= " DESC";
//        } else {
//            $sql .= " ASC";
//        }
//
//        if (isset($data['start']) || isset($data['limit'])) {
//            if ($data['start'] < 0) {
//                $data['start'] = 0;
//            }
//
//            if ($data['limit'] < 1) {
//                $data['limit'] = 20;
//            }
//
//            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
//        }

        $query = $this->db->query($sql);

        return $query['rows'];
    }

    public function getFilterGroupDescriptions($filter_group_id) {
        $filter_group_data = array();

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "filter_group_description` WHERE filter_group_id = '" . (int)$filter_group_id . "'");

        foreach ($query['rows'] as $result) {
            $filter_group_data[$this->convertLangId2Code((int)$result['language_id'])] = array('name' => $result['name']);
        }

        return $filter_group_data;
    }

    public function getTotalFilterGroups() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "filter_group`");

        return $query['row']['total'];
    }
}