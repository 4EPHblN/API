<?php
namespace OpenCartWebAPI;

class ModelStore extends Model {
    public function getStores() {
        $stores = array();
        $resultIds = $this->db->query("SELECT store_id FROM  " . DB_PREFIX . "setting GROUP BY store_id");

        foreach ($resultIds['rows'] as $value) {
            $resultStore = $this->db->query("SELECT * FROM  " . DB_PREFIX . "setting WHERE store_id = '{$value['store_id']}' AND code = 'config'");
            $store = array('store_id' => (int)$value['store_id']);

            foreach ($resultStore['rows'] as $row) {
                $store[$row['key']] = $row['value'];
            }
            
            $stores[] = $store;
        }

        return $stores;
    }
}