<?php
namespace OpenCartWebAPI;

class ModelCategory extends Model {
    
    
    public function getCategoriesList() {
        $query = "SELECT DISTINCT c.*, cd.name, cd.description,
                    (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = CONCAT('category_id=', c.category_id)) AS keyword
                    FROM " . DB_PREFIX . "category c
                    LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)
                    WHERE cd.language_id = '" . $this->langId . "'";

        $result = $this->db->query($query);

        // TODO: УБРАТЬ В РАБОЧЕЙ ВЕРСИИ!!
        if (API_DEBUG_MODE) {
            if (!API_BASE64_ENCODE) {
                foreach ($result["rows"] as $rowId => $row) {
                    $result["rows"][$rowId]['description'] = base64_encode($row['description']);
                }
            }
        }

        foreach ($result["rows"] as $rowId => $row) {
            if (isset($row["image"]) && !empty($row["image"])) {
                $result["rows"][$rowId]["image"] = ((API_FULL_URL) ? $this->URL_IMAGE_DIR : '') . $row["image"];
            }
            
            $result["rows"][$rowId]['category_description'] = array(
                $this->langCode => array(
                    'name' => $row['name'],
                    'description' => $row['description']
                )
            );

            unset($result["rows"][$rowId]['name']);
            unset($result["rows"][$rowId]['description']);
        }

        return $result["rows"];
    }


}