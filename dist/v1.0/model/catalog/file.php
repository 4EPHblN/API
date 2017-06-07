<?php
namespace OpenCartWebAPI;

class ModelFile extends Model {
    public function saveImage($data) {
        $name = $data['name'];
        $extension = $data['extension'];
        $mime_type = $data['mime_type'];
        $imageBase64Data = $data['data'];
        $byte_buffer_length = $data['byte_buffer_length'];
        
        global $API_LOGGED_USER;

        $tmpDir = API_TEMP_DIR_NAME . '/' . $API_LOGGED_USER . '/';
        $fileName = $name . '.' . $extension;
        if (isset($data['path']) && !empty($data['path'])) {
            if (substr($data['path'], -1, 1) != '/') $data['path'] .= '/';
            $loadPath = $data['path'];
        } else {
            $loadPath = $tmpDir;
        }
        $loadUrl = (API_FULL_URL) ? $this->URL_IMAGE_DIR . $loadPath . $fileName : $loadPath . $fileName;

        if (!file_exists(DIR_IMAGE . $loadPath)) {
            mkdir(DIR_IMAGE . $loadPath, 0755, true);
        }

        if (file_put_contents(DIR_IMAGE . $loadPath . $fileName, base64_decode($imageBase64Data))) {
            $data['data'] = '';
            $data['url'] = $loadUrl;
            $data['path'] = $loadPath;
            $data['byte_buffer_length'] = -1;

            return $data;
        }

        sendResponseFail();
        return null;
    }
}