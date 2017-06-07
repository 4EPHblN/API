<?php
namespace OpenCartWebAPI;

class ModelProduct extends Model {
    /**
     *
     * @param $data
     * @return array Created product.
     */
    public function addProduct($data) {
        $template = array(
            'model' => '',
            'sku' => '',
            'upc' => '',
            'ean' => '',
            'jan' => '',
            'isbn' => '',
            'mpn' => '',
            'location' => '',
            'quantity' => 0,
            'minimum' => 1,
            'subtract' => 1,
            'stock_status_id' => '',
            'date_available' => '',
            'manufacturer_id' => '',
            'shipping' => 1,
            'price' => 0.00,
            'points' => 0,
            'weight' => 0.00,
            'weight_class_id' => '',
            'length' => 0.00,
            'width' => 0.00,
            'height' => 0.00,
            'length_class_id' => '',
            'status' => 1,
            'tax_class_id' => '',
            'sort_order' => 0,
        );

        $data += $template;

//        echo '<br><br>';
//        echo var_export($data, true);
//        exit();

        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

        $product_id = $this->db->getLastId();

        if (API_AUTOGENERATE_PRODUCT_SKU && isset($data['main_category_id']) && $data['main_category_id'] > 0 && empty($data['sku'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '" . $this->db->escape($this->generateProductArticle($product_id, $data['main_category_id'])) . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        if (isset($data['image'])) {
            if (API_FULL_URL) {
                $data['image'] = implode('', explode($this->URL_IMAGE_DIR, $data['image']));
            }
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        if (isset($data['product_description'])) {
            foreach ($data['product_description'] as $lang_code => $value) {
                $data['product_description'][$lang_code] += array(
                    'name' => '',
                    'description' => '',
                    'tag' => '',
                    'meta_title' => '',
                    'meta_h1' => '',
                    'meta_description' => '',
                    'meta_keyword' => '',
                );
                $lang = $this->convertLangCode2Id($lang_code);
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . $lang . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
            }
        }

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if (isset($product_attribute['attribute_id'])) {
                    foreach ($product_attribute['product_attribute_description'] as $lang_code => $product_attribute_description) {
                        $lang = $this->convertLangCode2Id($lang_code);
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . $lang . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        if (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                if (!isset($product_option['option_id'])) continue;

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    if (isset($product_option['product_option_value'])) {
                        $product_option += array(
                            'required' => 1,
                        );
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

                        $product_option_id = $this->db->getLastId();

                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            if (!isset($product_option_value['option_value_id'])) continue;

                            $product_option_value += array(
                                'quantity' => 0,
                                'subtract' => 0,
                                'price' => 0.00,
                                'price_prefix' => '',
                                'points' => 0,
                                'points_prefix' => '',
                                'weight' => 0.00,
                                'weight_prefix' => '',
                            );
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
                        }
                    }
                } else {
                    $product_option += array(
                        'value' => '',
                        'required' => 1,
                    );
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
                }
            }
        }

        if (isset($data['product_discount'])) {
            foreach ($data['product_discount'] as $product_discount) {
                if (!isset($product_discount['customer_group_id'])) continue;

                $product_discount += array(
                    'quantity' => 0,
                    'priority' => 0,
                    'price' => 0.00,
                    'date_start' => '',
                    'date_end' => '',
                );
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
            }
        }

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                if (!isset($product_special['customer_group_id'])) continue;

                $product_special += array(
                    'priority' => 0,
                    'price' => 0.00,
                    'date_start' => '',
                    'date_end' => '',
                );
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
                if (!isset($product_image['image'])) continue;

                $product_image += array(
                    'sort_order' => 0,
                );
                if (API_FULL_URL) {
                    $product_image['image'] = implode('', explode($this->URL_IMAGE_DIR, $product_image['image']));
                }
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
            }
        }

        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
            }
        }

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
            }
        }

        if(isset($data['main_category_id']) && $data['main_category_id'] > 0) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
        } elseif(isset($data['product_category'][0])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_to_category SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
        }

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
            }
        }

        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
            }
        }

        if (isset($data['product_reward'])) {
            foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
                $product_reward += array(
                    'points' => 0,
                );
                if ((int)$product_reward['points'] > 0) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
                }
            }
        }

        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $layout) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$layout["store_id"] . "', layout_id = '" . (int)$layout["layout_id"] . "'");
            }
        }

        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        } elseif (API_AUTOGENERATE_URL_ALIAS) {
            $name = $data['product_description'][$this->getDefaultLang()]['name'];
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($this->generateKeyword($name, '-', time())) . "'");
        }

        if (isset($data['product_recurrings'])) {
            foreach ($data['product_recurrings'] as $recurring) {
                if (!isset($recurring['customer_group_id']) || !isset($recurring['recurring_id'])) continue;

                $this->db->query("INSERT INTO " . DB_PREFIX . "product_recurring SET product_id = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", recurring_id = " . (int)$recurring['recurring_id']);
            }
        }

        // TODO: Удаление кэша
//        $this->cache->delete('product');

        $this->db->commit();

        return $this->getProduct(array($product_id));
    }

    /**
     *
     * @param $data
     * @return array Updated product.
     */
    public function updateProduct($matches, $data) {
        $product_id = (int)$matches[0];

        $template = array(
            'model' => '',
            'sku' => '',
            'upc' => '',
            'ean' => '',
            'jan' => '',
            'isbn' => '',
            'mpn' => '',
            'location' => '',
            'quantity' => 0,
            'minimum' => 1,
            'subtract' => 1,
            'stock_status_id' => '',
            'date_available' => '',
            'manufacturer_id' => '',
            'shipping' => 1,
            'price' => 0.00,
            'points' => 0,
            'weight' => 0.00,
            'weight_class_id' => '',
            'length' => 0.00,
            'width' => 0.00,
            'height' => 0.00,
            'length_class_id' => '',
            'status' => 1,
            'tax_class_id' => '',
            'sort_order' => 0,
        );

        $data += $template;

//        echo '<br><br>';
//        echo var_export($data, true);
//        exit();

        $this->db->query("UPDATE `" . DB_PREFIX . "product` SET image = NULL, model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE product_id = '" . $product_id . "'");

        if (API_AUTOGENERATE_PRODUCT_SKU && isset($data['main_category_id']) && $data['main_category_id'] > 0 && empty($data['sku'])) {
            $this->db->query("UPDATE `" . DB_PREFIX . "product` SET sku = '" . $this->db->escape($this->generateProductArticle($product_id, $data['main_category_id'])) . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        if (isset($data['image'])) {
            if (API_FULL_URL) {
                $data['image'] = implode('', explode($this->URL_IMAGE_DIR, $data['image']));
            }
            $this->db->query("UPDATE `" . DB_PREFIX . "product` SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_description` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_description'])) {
            foreach ($data['product_description'] as $lang_code => $value) {
                $data['product_description'][$lang_code] += array(
                    'name' => '',
                    'description' => '',
                    'tag' => '',
                    'meta_title' => '',
                    'meta_h1' => '',
                    'meta_description' => '',
                    'meta_keyword' => '',
                );
                $lang = $this->convertLangCode2Id($lang_code);
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_description` SET product_id = '" . (int)$product_id . "', language_id = '" . $lang . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_store` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_to_store` SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_attribute` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if (isset($product_attribute['attribute_id'])) {
                    foreach ($product_attribute['product_attribute_description'] as $lang_code => $product_attribute_description) {
                        $lang = $this->convertLangCode2Id($lang_code);
                        $this->db->query("INSERT INTO `" . DB_PREFIX . "product_attribute` SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . $lang . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_option` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_option_value` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                if (!isset($product_option['option_id'])) continue;

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    if (isset($product_option['product_option_value'])) {
                        $product_option += array(
                            'required' => 1,
                        );
                        $this->db->query("INSERT INTO `" . DB_PREFIX . "product_option` SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

                        $product_option_id = $this->db->getLastId();

                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            if (!isset($product_option_value['option_value_id'])) continue;

                            $product_option_value += array(
                                'quantity' => 0,
                                'subtract' => 0,
                                'price' => 0.00,
                                'price_prefix' => '',
                                'points' => 0,
                                'points_prefix' => '',
                                'weight' => 0.00,
                                'weight_prefix' => '',
                            );
                            $this->db->query("INSERT INTO `" . DB_PREFIX . "product_option_value` SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
                        }
                    }
                } else {
                    $product_option += array(
                        'value' => '',
                        'required' => 1,
                    );
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "product_option` SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_discount` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_discount'])) {
            foreach ($data['product_discount'] as $product_discount) {
                if (!isset($product_discount['customer_group_id'])) continue;

                $product_discount += array(
                    'quantity' => 0,
                    'priority' => 0,
                    'price' => 0.00,
                    'date_start' => '',
                    'date_end' => '',
                );
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_discount` SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_special` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                if (!isset($product_special['customer_group_id'])) continue;

                $product_special += array(
                    'priority' => 0,
                    'price' => 0.00,
                    'date_start' => '',
                    'date_end' => '',
                );
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_special` SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_image` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
                if (!isset($product_image['image'])) continue;

                $product_image += array(
                    'sort_order' => 0,
                );
                if (API_FULL_URL) {
                    $product_image['image'] = implode('', explode($this->URL_IMAGE_DIR, $product_image['image']));
                }
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_image` SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_download` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_to_download` SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_category` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_to_category` SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
            }
        }
        if(isset($data['main_category_id']) && $data['main_category_id'] > 0) {
            $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_category` WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
            $this->db->query("INSERT INTO `" . DB_PREFIX . "product_to_category` SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
        } elseif(isset($data['product_category'][0])) {
            $this->db->query("UPDATE `" . DB_PREFIX . "product_to_category` SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_filter` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_filter` SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE related_id = '" . $product_id . "'");
        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_related` SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
                $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_related` SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_reward` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_reward'])) {
            foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
                $product_reward += array(
                    'points' => 0,
                );
                if ((int)$product_reward['points'] > 0) {
                    $this->db->query("INSERT INTO `" . DB_PREFIX . "product_reward` SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_layout` WHERE product_id = '" . $product_id . "'");
        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $layout) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_to_layout` SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$layout["store_id"] . "', layout_id = '" . (int)$layout["layout_id"] . "'");
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE query = 'product_id=" . $product_id . "'");
        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        } elseif (API_AUTOGENERATE_URL_ALIAS) {
            $name = $data['product_description'][$this->getDefaultLang()]['name'];
            $this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($this->generateKeyword($name, '-', time())) . "'");
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = " . $product_id);
        if (isset($data['product_recurrings'])) {
            foreach ($data['product_recurrings'] as $recurring) {
                if (!isset($recurring['customer_group_id']) || !isset($recurring['recurring_id'])) continue;

                $this->db->query("INSERT INTO `" . DB_PREFIX . "product_recurring` SET product_id = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", recurring_id = " . (int)$recurring['recurring_id']);
            }
        }

        // TODO: Удаление кэша
//        $this->cache->delete('product');

        $this->db->commit();

        return $this->getProduct(array($product_id));
    }

    /**
     * Удаляет товар по его ID.
     * @param $matches array Массив, полученный при разборе пути.
     * @return int Количество затронутых строк.
     */
    public function deleteProduct($matches) {
        $product_id = (int)$matches[0];

        $this->db->query("DELETE FROM `" . DB_PREFIX . "product` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_attribute` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_description` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_discount` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_filter` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_image` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_option` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_option_value` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_related` WHERE related_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_reward` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_special` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_category` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_download` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_layout` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_to_store` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = " . $product_id);
        $this->db->query("DELETE FROM `" . DB_PREFIX . "review` WHERE product_id = '" . $product_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE query = 'product_id=" . $product_id . "'");

        // TODO: Удаление кэша

        $this->db->commit();
        return $this->db->affectedRows();
    }

    /**
     * Возвращает список товаров с полным описанием.
     * @return array Список товаров.
     */
    public function getProductsListFull() {
        // TODO: УЧЕСТЬ ПАРАМЕТРЫ $this->params!!
        $query = "SELECT product_id FROM `" . DB_PREFIX . "product`";

        $result = $this->db->query($query);
        
        $ret = array();
        foreach ($result["rows"] as $row) {
            $ret[] = $this->getProduct(array($row['product_id']));
        }

        return $ret;
    }

    /**
     * Возвращает список товаров с коротким описанием.
     * @return array Список товаров.
     */
    public function getProductsList() {
        // TODO: УЧЕСТЬ ПАРАМЕТРЫ $this->params!!
        $query = "SELECT DISTINCT p.*, pd.name, pd.description, cd.name AS main_category_name, p2c.category_id AS main_category_id,
                    (SELECT keyword FROM `" . DB_PREFIX . "url_alias` WHERE query = CONCAT('product_id=', p.product_id)) AS keyword
                    FROM `" . DB_PREFIX . "product` p
                    LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (p.product_id = pd.product_id)
                    LEFT JOIN `" . DB_PREFIX . "product_to_category` p2c ON (p.product_id = p2c.product_id AND main_category = '1')
                    LEFT JOIN `" . DB_PREFIX . "category_description` cd ON (p2c.category_id = cd.category_id)
                    WHERE pd.language_id = '" . $this->langId . "' AND cd.language_id = '" . $this->langId . "'";

        $result = $this->db->query($query);

//        // TODO: УБРАТЬ В РАБОЧЕЙ ВЕРСИИ!!
//        if (DEBUG_MODE) {
//            if (!BASE64_ENCODE) {
//                foreach ($result["rows"] as $rowId => $row) {
//                    $result["rows"][$rowId]['description'] = base64_encode($row['description']);
//                }
//            }
//        }

        foreach ($result["rows"] as $rowId => $row) {
            $result["rows"][$rowId]["image"] = ((API_FULL_URL) ? $this->URL_IMAGE_DIR : '') . $row["image"];

            $result["rows"][$rowId]['product_description'] = array(
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

    /**
     * Получает товар по его ID.
     * @param $matches array Массив, полученный при разборе пути.
     * @return array Ассоциативный массив, содержащий данные товара.
     */
    public function getProduct($matches) {
        $product_id = (int)$matches[0];
        
//        $lang = $this->getLangIdByCode($_POST['lang']);
//        $langQuery = (($lang) ? $lang : "(SELECT value FROM " . DB_PREFIX . "setting AS s WHERE s.key='config_language')");
//        $query = "SELECT DISTINCT *,
//                    (SELECT keyword FROM " . DB_PREFIX . "url_alias
//                        WHERE query = 'product_id=" . $product_id . "') AS keyword
//                    FROM " . DB_PREFIX . "product p
//                    LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
//                    WHERE p.product_id = '" . $product_id . "' AND pd.language_id =" . $langQuery;

        $query = "SELECT DISTINCT *,
                    (SELECT keyword FROM `" . DB_PREFIX . "url_alias` WHERE query = 'product_id=" . $product_id . "') AS keyword
                    FROM `" . DB_PREFIX . "product` p
                    WHERE p.product_id = '" . $product_id . "'";

        $result = $this->db->query($query);
        $row = $result["row"];

        if (isset($row["image"]) && !empty($row["image"])) {
            $row["image"] = ((API_FULL_URL) ? $this->URL_IMAGE_DIR : '') . $row["image"];
        }

        $row["product_description"] = $this->getProductDescriptions($product_id);
        $row["main_category_id"] = $this->getProductMainCategoryId($product_id);
        $row["main_category_name"] = $this->getProductMainCategoryName($product_id);
        $row["product_category"] = $this->getProductCategories($product_id);
        $row["product_filter"] = $this->getProductFilters($product_id);
        $row["product_attribute"] = $this->getProductAttributes($product_id);
        $row["product_option"] = $this->getProductOptions($product_id);
        $row["product_image"] = $this->getProductImages($product_id);
        $row["product_discount"] = $this->getProductDiscounts($product_id);
        $row["product_special"] = $this->getProductSpecials($product_id);
        $row["product_download"] = $this->getProductDownloads($product_id);
        $row["product_reward"] = $this->getProductRewards($product_id);
        $row["product_store"] = $this->getProductStores($product_id);
        $row["product_layout"] = $this->getProductLayouts($product_id);
        $row["product_related"] = $this->getProductRelated($product_id);
        $row["product_recurrings"] = $this->getProductRecurrings($product_id);

        // TODO: УБРАТЬ В РАБОЧЕЙ ВЕРСИИ!!
        if (API_DEBUG_MODE) {
            if (!API_BASE64_ENCODE && isset($row['product_description'])) {
                foreach ($row['product_description'] as $lang_code => $description) {
                    $row['product_description'][$lang_code]['description'] = base64_encode($description['description']);
                }
            }
        }

        return $row;
    }





    public function getProductDescriptions($product_id) {
        $product_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $langCode = $this->getLangCodeById($row["language_id"]);
            $product_description_data[$langCode] = array(
                'name'             => $row['name'],
                'description'      => $row['description'],
                'meta_title'       => $row['meta_title'],
                'meta_h1'          => $row['meta_h1'],
                'meta_description' => $row['meta_description'],
                'meta_keyword'     => $row['meta_keyword'],
                'tag'              => $row['tag']
            );
        }

        // TODO: УБРАТЬ В РАБОЧЕЙ ВЕРСИИ!!
        if (API_DEBUG_MODE) {
            if (!API_BASE64_ENCODE && sizeof($product_description_data) > 0)
                foreach ($product_description_data as $lang => $item) {
                    $product_description_data[$lang]['description'] = base64_encode($item['description']);
                }
        }


        return $product_description_data;
    }

    public function getProductCategories($product_id) {
        $product_category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_category_data[] = $row['category_id'];
        }

        return $product_category_data;
    }

    public function getProductFilters($product_id) {
        $product_filter_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_filter_data[] = $row['filter_id'];
        }

        return $product_filter_data;
    }

    public function getProductAttributes($product_id) {
        $product_attribute_data = array();

        $product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");

        foreach ($product_attribute_query["rows"] as $product_attribute) {
            $product_attribute_description_data = array();

            $product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

            foreach ($product_attribute_description_query["rows"] as $product_attribute_description) {
                $langCode = $this->getLangCodeById($product_attribute_description["language_id"]);
                $product_attribute_description_data[$langCode] = array('text' => $product_attribute_description['text']);
            }

            $product_attribute_data[] = array(
                'attribute_id'                  => $product_attribute['attribute_id'],
                'product_attribute_description' => $product_attribute_description_data
            );
        }

        return $product_attribute_data;
    }

    public function getProductOptions($product_id) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . $this->langId . "'");

        foreach ($product_option_query["rows"] as $product_option) {
            $product_option_value_data = array();

            $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option['product_option_id'] . "'");

            foreach ($product_option_value_query["rows"] as $product_option_value) {
                $product_option_value_data[] = array(
                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                    'option_value_id'         => $product_option_value['option_value_id'],
                    'quantity'                => $product_option_value['quantity'],
                    'subtract'                => $product_option_value['subtract'],
                    'price'                   => $product_option_value['price'],
                    'price_prefix'            => $product_option_value['price_prefix'],
                    'points'                  => $product_option_value['points'],
                    'points_prefix'           => $product_option_value['points_prefix'],
                    'weight'                  => $product_option_value['weight'],
                    'weight_prefix'           => $product_option_value['weight_prefix']
                );
            }

            $product_option_data[] = array(
                'product_option_id'    => $product_option['product_option_id'],
                'product_option_value' => $product_option_value_data,
                'option_id'            => $product_option['option_id'],
                'name'                 => $product_option['name'],
                'type'                 => $product_option['type'],
                'value'                => $product_option['value'],
                'required'             => $product_option['required']
            );
        }

        return $product_option_data;
    }

    public function getProductOptionValue($product_id, $product_option_value_id) {
        $sql = "SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND ovd.language_id = '" . $this->langId . "'";
        $query = $this->db->query($sql);

        return $query["row"];
    }

    public function getProductImages($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");
        $result = $query["rows"];

        foreach ($result as $idx => $row) {
            if (isset($row["image"]) && !empty($row["image"])) {
                $result[$idx]["image"] = ((API_FULL_URL) ? $this->URL_IMAGE_DIR : '') . $row["image"];
            }
        }

        return $result;
    }

    public function getProductDiscounts($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

        return $query["rows"];
    }

    public function getProductSpecials($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

        return $query["rows"];
    }

    public function getProductRewards($product_id) {
        $product_reward_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_reward_data[$row['customer_group_id']] = array('points' => $row['points']);
        }

        return $product_reward_data;
    }

    public function getProductDownloads($product_id) {
        $product_download_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_download_data[] = $row['download_id'];
        }

        return $product_download_data;
    }

    public function getProductStores($product_id) {
        $product_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_store_data[] = $row['store_id'];
        }

        return $product_store_data;
    }

    public function getProductLayouts($product_id) {
        $product_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_layout_data[] = array(
                'store_id' => $row['store_id'],
                'layout_id' => $row['layout_id']
            );
        }

        return $product_layout_data;
    }

    public function getProductMainCategoryId($product_id) {
        $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND main_category = '1' LIMIT 1");

        return ($query["num_rows"] ? (int)$query["row"]['category_id'] : 0);
    }

    public function getProductMainCategoryName($product_id) {
        $query = $this->db->query("SELECT DISTINCT cd.name FROM " . DB_PREFIX . "product_to_category p2c INNER JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = p2c.category_id) WHERE p2c.product_id = '" . (int)$product_id . "' AND main_category = '1' LIMIT 1");

        return $query["row"]['name'];
    }

    public function getProductRelated($product_id) {
        $product_related_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query["rows"] as $row) {
            $product_related_data[] = $row['related_id'];
        }

        return $product_related_data;
    }

    public function getProductRecurrings($product_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = '" . (int)$product_id . "'");

        return $query["rows"];
    }




    /**
     * Возвращает следующий по нумерации складской номер товара (SKU) для заданной категории.
     * @param $product_id int ID товара.
     * @param $category_id int ID категории.
     * @return string Складской номер товара для заданной категории в формате "XX-00025",
     * где "XX" – транслитерированные первые буквы названия категории,
     * а "00025" – идентификатор товара.
     */
    public function generateProductArticle($product_id, $category_id) {

        $query = "SELECT name FROM " . DB_PREFIX . "category_description WHERE category_id = '{$category_id}'";
        $result = $this->db->query($query);

        if ($result['num_rows'] > 0) {
            $number = strval($product_id);
            while (strlen($number) < 5) $number = '0' . $number;

            $category = $this->translate_ru2lat(mb_substr(strtoupper($result['row']['name']), 0, 2, 'utf-8'), true);

            return $category . '-' . $number;
        }

        return '';
    }

    public function generateKeyword($name, $separator = '-', $prefix = null, $postfix = null, $translate = false) {
        $separator = (isset($separator)) ? $separator : '';
        if ($translate) {
            $name = $this->translate_ru2lat($name, $separator);
        } else {
            $name = mb_ereg_replace("[^a-zA-Zа-яА-Я0-9]+", $separator, $name);
        }
        if (isset($prefix)) $name = $prefix . $separator . $name;
        if (isset($postfix)) $name = $name . $separator . $postfix;

        $count = 0;

        do {
            $keyword = ($count++ > 0) ? $name . $separator . $count : $name;
            $result = $this->db->query("SELECT COUNT(*) AS count FROM " . DB_PREFIX . "url_alias WHERE keyword = '{$keyword}'");
        } while ((int)$result['count'] != 0);

        return $keyword;
    }
}
