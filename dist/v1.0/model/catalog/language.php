<?php
namespace OpenCartWebAPI;

class ModelLanguage extends Model {
    public function getLanguages() {
        $query = "SELECT * FROM " . DB_PREFIX . "language";
        $result = $this->db->query($query);

        $defLang = $this->getDefaultLang();

        foreach ($result["rows"] as $idx => $row) {
            $result["rows"][$idx]["is_default"] = ($row["code"] == $defLang) ? 1 : 0;
        }

        return $result["rows"];
    }
}