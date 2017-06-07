<?php
namespace OpenCartWebAPI;

class ModelAttribute extends Model {
    public function addAttributeGroup($data) {
//        $this->event->trigger('pre.admin.attribute_group.add', $data);
        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute_group` SET sort_order = '" . (int)$data['sort_order'] . "'");

        $attribute_group_id = $this->db->getLastId();

        foreach ($data['attribute_group_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute_group_description` SET attribute_group_id = '" . (int)$attribute_group_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute_group.add', $attribute_group_id);
        return $this->getAttributeGroupFull(array($attribute_group_id));
    }

    public function editAttributeGroup($matches, $data) {
        $attribute_group_id = $matches[0];
//        $this->event->trigger('pre.admin.attribute_group.edit', $data);
        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("UPDATE `" . DB_PREFIX . "attribute_group` SET sort_order = '" . (int)$data['sort_order'] . "' WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");

        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute_group_description` WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");
        foreach ($data['attribute_group_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute_group_description` SET attribute_group_id = '" . (int)$attribute_group_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute_group.edit', $attribute_group_id);
        return $this->getAttributeGroupFull(array($attribute_group_id));
    }

    public function deleteAttributeGroup($matches) {
        $attribute_group_id = $matches[0];
//        $this->event->trigger('pre.admin.attribute_group.delete', $attribute_group_id);

        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute_group` WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute_group_description` WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute_group.delete', $attribute_group_id);
        $this->db->affectedRows();
    }

    public function getAttributeGroup($matches) {
        $attribute_group_id = $matches[0];

        $query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "attribute_group` ag
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = ag.attribute_group_id) 
            WHERE ag.attribute_group_id = '" . (int)$attribute_group_id . "' AND agd.language_id = '{$this->langId}'");

        return $query['row'];
    }

    public function getAttributeGroupFull($matches) {
        $attribute_group_id = $matches[0];
        $attribute_group = array();

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "attribute_group` ag 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = ag.attribute_group_id) 
            WHERE ag.attribute_group_id = '" . (int)$attribute_group_id . "' AND agd.language_id = '{$this->langId}'");

        if ($query['num_rows'] > 0) {
            $attribute_group = $query['row'];
            $attribute_group['attribute_group_description'] = $this->getAttributeGroupDescriptions($attribute_group_id);
        }

        return $attribute_group;
    }

    public function getAttributeGroups() {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "attribute_group` ag 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (ag.attribute_group_id = agd.attribute_group_id) 
            WHERE agd.language_id = '" . $this->langId . "'";

//        TODO: Фильтры...
//        $sort_data = array(
//            'agd.name',
//            'ag.sort_order'
//        );
//
//        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//            $sql .= " ORDER BY " . $data['sort'];
//        } else {
//            $sql .= " ORDER BY agd.name";
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

    public function getAttributeGroupsFull() {
        $attribute_groups = array();

        $query = $this->db->query("SELECT attribute_group_id FROM `" . DB_PREFIX . "attribute_group`");

        if ($query['num_rows'] > 0) {
            foreach ($query['rows'] as $row) {
                $attribute_groups[] = $this->getAttributeGroupFull(array($row['attribute_group_id']));
            }
        }

        return $attribute_groups;
    }

    public function getAttributeGroupDescriptions($attribute_group_id) {
        $attribute_group_data = array();

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "attribute_group_description` 
            WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");

        foreach ($query['rows'] as $result) {
            $attribute_group_data[$this->convertLangId2Code($result['language_id'])] = array('name' => $result['name']);
        }

        return $attribute_group_data;
    }

    public function getTotalAttributeGroups() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "attribute_group`");

        return $query['row']['total'];
    }

//    ======================================================================

    public function addAttribute($data) {
//        $this->event->trigger('pre.admin.attribute.add', $data);
        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute` SET attribute_group_id = '" . (int)$data['attribute_group_id'] . "', sort_order = '" . (int)$data['sort_order'] . "'");

        $attribute_id = $this->db->getLastId();

        foreach ($data['attribute_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute_description` SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute.add', $attribute_id);
        return $this->getAttributeFull(array($attribute_id));
    }

    public function editAttribute($matches, $data) {
        $attribute_id = $matches[0];
//        $this->event->trigger('pre.admin.attribute.edit', $data);
        $template = array(
            'sort_order' => 0,
        );
        $data += $template;

        $this->db->query("UPDATE `" . DB_PREFIX . "attribute` SET attribute_group_id = '" . (int)$data['attribute_group_id'] . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE attribute_id = '" . (int)$attribute_id . "'");

        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute_description` WHERE attribute_id = '" . (int)$attribute_id . "'");
        foreach ($data['attribute_description'] as $lang_code => $value) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "attribute_description` SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . $this->convertLangCode2Id($lang_code) . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute.edit', $attribute_id);
        return $this->getAttributeFull(array($attribute_id));
    }

    public function deleteAttribute($matches) {
        $attribute_id = $matches[0];
//        $this->event->trigger('pre.admin.attribute.delete', $attribute_id);

        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute` WHERE attribute_id = '" . (int)$attribute_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "attribute_description` WHERE attribute_id = '" . (int)$attribute_id . "'");

        $this->db->commit();
//        $this->event->trigger('post.admin.attribute.delete', $attribute_id);
        $this->db->affectedRows();
    }

    public function getAttribute($matches) {
        $attribute_id = (int)$matches[0];

        $sql = "SELECT a.*, ad.name, agd.name AS attribute_group FROM `" . DB_PREFIX . "attribute` a 
            LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id) 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = a.attribute_group_id) 
            WHERE a.attribute_id = '{$attribute_id}' AND ad.language_id = '{$this->langId}' AND agd.language_id = '{$this->langId}'";

        $query = $this->db->query($sql);

        return $query['row'];
    }

    public function getAttributeFull($matches) {
        $attribute_id = (int)$matches[0];
        $attribute = array();

        $sql = "SELECT a.*, ad.name, agd.name AS attribute_group FROM `" . DB_PREFIX . "attribute` a 
            LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id) 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = a.attribute_group_id) 
            WHERE a.attribute_id = '{$attribute_id}' AND ad.language_id = '{$this->langId}' AND agd.language_id = '{$this->langId}'";

        $query = $this->db->query($sql);

        if ($query['num_rows'] > 0) {
            $attribute = $query['row'];
            $attribute['attribute_description'] = $this->getAttributeDescriptions($attribute_id);
        }

        return $attribute;
    }

    public function getAttributes() {
        $sql = "SELECT a.*, ad.name, agd.name AS attribute_group FROM `" . DB_PREFIX . "attribute` a 
            LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id) 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = a.attribute_group_id) 
            WHERE ad.language_id = '{$this->langId}' AND agd.language_id = '{$this->langId}'";

//        TODO: Фильтры...
//        if (!empty($data['filter_name'])) {
//            $sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
//        }
//
//        if (!empty($data['filter_attribute_group_id'])) {
//            $sql .= " AND a.attribute_group_id = '" . $this->db->escape($data['filter_attribute_group_id']) . "'";
//        }
//
//        $sort_data = array(
//            'ad.name',
//            'attribute_group',
//            'a.sort_order'
//        );
//
//        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//            $sql .= " ORDER BY " . $data['sort'];
//        } else {
//            $sql .= " ORDER BY attribute_group, ad.name";
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

    public function getAttributesFull() {
        $attributes = array();

        $sql = "SELECT attribute_id FROM `" . DB_PREFIX . "attribute`";

        $query = $this->db->query($sql);

        if ($query['num_rows'] > 0) {
            foreach ($query['rows'] as $row) {
                $attributes[] = $this->getAttributeFull(array($row['attribute_id']));
            }
        }

        return $attributes;
    }

    public function getAttributeDescriptions($attribute_id) {
        $attribute_data = array();

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "attribute_description` WHERE attribute_id = '" . (int)$attribute_id . "'");

        foreach ($query['rows'] as $result) {
            $attribute_data[$this->convertLangId2Code($result['language_id'])] = array('name' => $result['name']);
        }

        return $attribute_data;
    }

    public function getAttributesByAttributeGroup($matches) {
        $attribute_group_id = $matches[0];

        $sql = "SELECT a.*, ad.name, agd.name AS attribute_group FROM `" . DB_PREFIX . "attribute` a 
            LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id) 
            LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (agd.attribute_group_id = a.attribute_group_id) 
            WHERE a.attribute_group_id = '{$attribute_group_id}' AND ad.language_id = '{$this->langId}' AND agd.language_id = '{$this->langId}'";

//        TODO: Фильтры...
//        if (!empty($data['filter_name'])) {
//            $sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
//        }
//
//        if (!empty($data['filter_attribute_group_id'])) {
//            $sql .= " AND a.attribute_group_id = '" . $this->db->escape($data['filter_attribute_group_id']) . "'";
//        }
//
//        $sort_data = array(
//            'ad.name',
//            'attribute_group',
//            'a.sort_order'
//        );
//
//        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//            $sql .= " ORDER BY " . $data['sort'];
//        } else {
//            $sql .= " ORDER BY ad.name";
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

    public function getAttributesByAttributeGroupFull($matches) {
        $attribute_group_id = $matches[0];
        $attributes = null;

        $sql = "SELECT attribute_id FROM `" . DB_PREFIX . "attribute` WHERE attribute_group_id = {$attribute_group_id}";

        $query = $this->db->query($sql);

        if ($query['num_rows'] > 0) {
            foreach ($query['rows'] as $row) {
                $attributes[] = $this->getAttributeFull(array($row['attribute_id']));
            }
        }

        return $attributes;
    }

    public function getTotalAttributes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "attribute`");

        return $query['row']['total'];
    }

    public function getTotalAttributesByAttributeGroup($attribute_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "attribute` WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");

        return $query['row']['total'];
    }

//    ======================================================================

}