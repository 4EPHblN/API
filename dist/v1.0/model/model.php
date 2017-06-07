<?php
namespace OpenCartWebAPI;

include "./app/db_connector.php";

class Model extends Context {
    public $db = null;
    public $langId = null;
    public $langCode = null;
    public $params = array();

    public $result = array(
        'result' => null,
        'total' => null,
        'count' => null,
        'offset' => null,
    );

    private $lang_code_to_id = array();
    private $lang_id_to_code = array();

    public function __construct() {
        parent::__construct();
        
        $mysqli = new DBConnector(DB_DRIVER); // TODO: DB_DRIVER
        $this->db = $mysqli->connect();

        $this->fillLanguages();

        $this->langId = $this->getLangIdByCode(strtolower($_POST['lang']));
        $this->langId = (($this->langId) ? $this->langId : $this->getDefaultLangId());
        $this->langCode = $this->getLangCodeById($this->langId);
        
        $this->params = $this->parseGetParams();
    }

    private function fillLanguages() {
        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "language");

        if ($result['num_rows'] > 0) {
            foreach ($result["rows"] as $row) {
                $this->lang_id_to_code[$row['language_id']] = $row['code'];
                $this->lang_code_to_id[$row['code']] = $row['language_id'];
            }
        }
    }

    /**
     * @param $langId int
     * @return string|boolean
     */
    public function convertLangId2Code($langId) {
        if (array_key_exists($langId, $this->lang_id_to_code)) {
            return $this->lang_id_to_code[$langId];
        } else {
            return false;
        }
    }

    /**
     * @param $langCode string
     * @return int|boolean
     */
    public function convertLangCode2Id($langCode) {
        if (array_key_exists($langCode, $this->lang_code_to_id)) {
            return $this->lang_code_to_id[$langCode];
        } else {
            return false;
        }
    }

    /**
     * Возвращает ID языка в базе данных по его коду.
     * @param $code_ISO2 string Код языка по стандарту ISO2, например "ru".
     * @return int ID языка в базе данных.
     */
    public function getLangIdByCode($code_ISO2) {
        $result = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE code = '" . strtolower($code_ISO2) . "'");
        return (int)$result['row']['language_id'];
    }

    /**
     * Возвращает код языка по его ID в базе данных.
     * @param $langId int ID языка в базе данных.
     * @return string Код языка в базе данных по стандарту ISO2.
     */
    public function getLangCodeById($langId) {
        $result = $this->db->query("SELECT code FROM " . DB_PREFIX . "language WHERE language_id = '" . (int)$langId . "'");
        return strtolower($result['row']['code']);
    }

    /**
     * Возвращает код языка, используемого по умолчанию (для магазина по умолчанию).
     * @return string Код языка по умолчанию.
     */
    public function getDefaultLang() {
        $result = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' AND `key` = 'config_language'");
        return $result["row"]["value"];
    }

    /**
     * Возвращает ID языка, используемого по умолчанию (для магазина по умолчанию).
     * @return int ID языка по умолчанию.
     */
    public function getDefaultLangId() {
        $result = $this->db->query("SELECT s.`value`, l.`language_id` 
                                        FROM `" . DB_PREFIX . "setting` AS s 
                                        INNER JOIN `" . DB_PREFIX . "language` l ON l.`code` = s.`value`
                                        WHERE store_id = '0' AND `key` = 'config_language'
                                        LIMIT 1");
        return (int)$result["row"]["language_id"];
    }

    /**
     * Возвращает код валюты, используемой по умолчанию (для магазина по умолчанию).
     * @return string Код валюты по умолчанию.
     */
    public function getDefaultCurrency() {
        $result = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' AND `key` = 'config_currency'");
        return $result["row"]["value"];
    }

    private function parseGetParams() {
        $params = array();

//        if (isset($_GET['fields']) && strlen($_GET['fields']) > 0) {
//            $fields = mb_split(",", $_GET['fields']);
//            $tmp = array();
//
//            foreach ($fields as $field) {
//                if (mb_ereg("[^A-Za-z0-9_]+", $field) === false) {
//                    $tmp[] = $field;
//                }
//            }
//
//            if (sizeof($tmp) > 0) {
//                $params['fields'] = $tmp;
//            }
//        } else {
//            $params['fields'] = array();
//        }

        if (isset($_GET['filter']) && strlen($_GET['filter']) > 0) {
            $filters = mb_split(",", $_GET['filter']);
            $tmp = array();

            foreach ($filters as $filter) {
                $filterSplit = mb_split(":", $filter);

                if (sizeof($filterSplit) === 2) {
                    $filterSplit[0] = strtolower(trim($filterSplit[0]));
                    $filterSplit[1] = mb_ereg_replace("[\'\"\;]+", "", trim($filterSplit[1]));

                    if ((sizeof($filterSplit[0]) > 0 && mb_ereg("[^A-Za-z0-9_]+", $filterSplit[0]) === false)
                        && (sizeof($filterSplit[1]) > 0)) {
                        $tmp[] = $filterSplit[0] . ':' . $filterSplit[1];
                    }
                }
            }

            if (sizeof($tmp) > 0) {
                $params['filter'] = $tmp;
            }
        } else {
            $params['filter'] = array();
        }

        if (isset($_GET['sort']) && strlen($_GET['sort']) > 0) {
            $sorts = mb_split(",", $_GET['sort']);
            $tmp = array();

            foreach ($sorts as $sort) {
                $sortSplit = mb_split(":", $sort);

                if (sizeof($sortSplit) === 2) {
                    $sortSplit[0] = strtolower(trim($sortSplit[0]));
                    $sortSplit[1] = strtoupper(trim($sortSplit[1]));

                    if ((sizeof($sortSplit[0]) > 0 && mb_ereg("[^A-Za-z0-9_]+", $sortSplit[0]) === false)
                        && ($sortSplit[1] == "ASC" || $sortSplit[1] == "DESC")) {
                        $tmp[] = $sortSplit[0] . ':' . $sortSplit[1];
                    }
                }
            }

            if (sizeof($tmp) > 0) {
                $params['sort'] = $tmp;
            }
        } else {
            $params['sort'] = array();
        }

        if (isset($_GET['count']) && abs((int)$_GET['count']) > 0) {
            $params['count'] = abs((int)$_GET['count']);
        } else {
            $params['count'] = API_COLLECTION_MAX_SIZE;
        }

        if (isset($_GET['offset'])) {
            $params['offset'] = abs((int)$_GET['offset']);
        }

        if (isset($_GET['type']) && strlen($_GET['type']) > 0) {
            if ($_GET['type'] == 'json' || $_GET['type'] == 'xml') {
                $params['type'] = $_GET['type'];
            } else {
                $params['type'] = 'json';
            }
        } else {
            $params['type'] = 'json';
        }

        return $params;
    }
}