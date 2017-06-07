<?php
namespace OpenCartWebAPI;

class ModelCurrency extends Model {
    public function getCurrencies() {
        $query = "SELECT * FROM " . DB_PREFIX . "currency WHERE status = '1'";
        $result = $this->db->query($query);

        $defCurr = $this->getDefaultCurrency();

        foreach ($result["rows"] as $idx => $row) {
            $result["rows"][$idx]["is_default"] = ($row["code"] == $defCurr) ? 1 : 0;
        }

        return $result["rows"];
    }
}