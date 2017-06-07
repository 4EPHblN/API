<?php
namespace OpenCartWebAPI;

class ModelAuth extends Model {
    public function Auth($username = null, $password = null, $device_id = null, $token = null) {
        // Если указаны имя пользователя и пароль, выполняем авторизацию
        if ($username != null && $password != null) {
            // Если необходимо, проверяем идентификатор устройства
            if (API_CHECK_DEVICE_ID && !$this->checkDevice($device_id)) {
                $this->sendResponseFail(false, STATUS_3104_DEVICE_NOT_APPROVED);
            }
    
            $sessionTable = DB_PREFIX . API_SESSION_TABLE;
            $userRow = $this->getUserByUsername($username);
            $passHash = $this->getPasswordHash($password, $userRow['salt']);
//            echo var_export($userRow, true); echo var_export($passHash, true); exit();

            if ($userRow['username'] == $username && ($userRow['password'] == $password || $userRow['password'] == $passHash)) {
                if ((int)$userRow['status'] != 1) {
                    $this->sendResponseFail(false, STATUS_3108_ACCOUNT_BLOCKED);
                }
                
                $query = $this->db->queryCommit("INSERT INTO {$sessionTable} SET user = '{$this->db->escape($username)}', token = '{$this->db->escape($token = $this->token())}', modifiedtime = NOW()");
                $id = $this->db->getLastId();

                if ($this->db->getLastErrorNo() != 0) $this->sendResponseFail();

                $limit = $this->db->query("SELECT COUNT(*) AS count FROM {$sessionTable}");
                $limit = ((int)$limit['row']['count']) - API_SESSION_TABLE_ROWS_LIMIT;
                if ($limit > 0) $this->db->queryCommit("DELETE FROM {$sessionTable} ORDER BY createdtime ASC LIMIT {$limit}");

                global $API_LOGGED_USER;
                $API_LOGGED_USER = $username;

                $this->sendResponse(array(
                    "token" => $token,
                    "time" => time(),
                    "timeout" => API_SESSION_LIFETIME,
                ));
            } else {
                $this->sendResponseFail(false, STATUS_3105_AUTH_FAILED);
            }
        }
        // Либо проверяем токен
        elseif ($token != null) {
            if (!$this->checkToken($token)) {
                $this->sendResponseFail(false, STATUS_3107_SESSION_EXPIRED);
            }

            return true;
        } else {
            $this->sendResponseFail(false, STATUS_3106_INSUFFICIENT_DATA);
        }

        return false;
    }

    private function checkToken($token) {
        $sessionTable = DB_PREFIX . API_SESSION_TABLE;
        $result = $this->db->query("SELECT user, TIMESTAMPDIFF(SECOND, modifiedtime, NOW()) AS time FROM {$sessionTable} WHERE token = '{$token}'");

        if ($result['num_rows'] > 0 && $result['row']['time'] <= API_SESSION_LIFETIME) {
            $this->db->queryCommit("UPDATE {$sessionTable} SET modifiedtime = NOW() WHERE token = '{$token}'");

            global $API_LOGGED_USER;
            $API_LOGGED_USER = $result['row']['user'];

            return true;
        }
        
        return false;
    }

    private function checkDevice($device_id) {
        $deviceTable = DB_PREFIX . API_DEVICE_TABLE;
        $result = $this->db->query("SELECT COUNT(*) AS count FROM {$deviceTable} WHERE device_id = '{$device_id}' AND status = 1");

        if ((int)$result['row']['count'] > 0) {
            return true;
        }

        return false;
    }

    private function getUserByUsername($username) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "'");

        return $query['row'];
    }

    private function getPasswordHash($password, $salt) {
        return sha1($salt . sha1($salt . sha1($password)));
    }

    private function token($length = 32) {
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $token = '';

        for ($idx = 0; $idx < $length; $idx++) {
            $token .= $string[mt_rand(0, strlen($string) - 1)];
        }

        return $token;
    }
}