<?php
namespace OpenCartWebAPI;

class ModelSetting extends Model {
    public function getSettings() {
        $settings = array();

        $lang = new ModelLanguage();
        $curr = new ModelCurrency();
        $store = new ModelStore();

        $settings['default_language'] = $this->getDefaultLang();
        $settings['default_currency'] = $this->getDefaultCurrency();

        $settings['languages'] = $lang->getLanguages();
        $settings['currencies'] = $curr->getCurrencies();
        $settings['stores'] = $store->getStores();

        $settings['check_device_id'] = API_CHECK_DEVICE_ID;
        $settings['debug_mode'] = API_DEBUG_MODE;
        $settings['base64_encode'] = API_BASE64_ENCODE;
        $settings['full_url'] = API_FULL_URL;

        $settings['temp_dir_name'] = API_TEMP_DIR_NAME;

        return $settings;
//        echo var_export($store->getStores(), true); exit();
    }
}
