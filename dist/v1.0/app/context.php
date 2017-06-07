<?php
namespace OpenCartWebAPI;

/**
 * Application context.
 * @package OpenCartWebAPI
 */
class Context {
    public $useSSL = false;
    public $URL_SHOP = null;
    public $URL_IMAGE_DIR = null;

    /**
     * Описание кодов состояния.
     */
    public static $STATUS_DESCRIPTION = array(
        1000 => "OK",
        1001 => "Going away",
        1002 => "Protocol error",
        1003 => "Received type of data cannot to be accepted",
        1004 => "Reserved",
        1005 => "No status code was actually present",
        1006 => "Closed abnormally",
        1007 => "Received data was not consistent with the type of the message",
        1008 => "Received message violates the policy",
        1009 => "Received message is too big for it to process",
        1010 => "File extension cannot to be accepted",
        1011 => "Unexpected condition that prevented to fulfilling the request",
        1015 => "Connection error",

        3100 => "Версия API более не поддерживается",
        3101 => "Внутренняя ошибка",
        3102 => "Указанная для пути '%s' функция не может быть вызвана",
        3103 => "Нет действия для пути '%s'",
        3104 => "Доступ не разрешен с данного устройства",
        3105 => "Имя пользователя или пароль указаны неверно",
        3106 => "Недостаточно данных для выполнения операции",
        3107 => "Время сессии истекло. Необходима повторная аутентификация",
        3108 => "Аккаунт заблокирован. Обратитесь к администратору",
        3109 => "Действие '%s', указанное в запросе, не поддерживается",
        3110 => "Запрос не распознан",

        3200 => "Невозможно подключиться к базе данных",
        3201 => "Ошибка при обращении к базе данных",

        3300 => "Не указан идентификатор",
        3301 => "Категория с указанным идентификатором не существует",
        3302 => "Товар с указанным идентификатором не существует",
        3303 => "Фильтр с указанным идентификатором не существует",
        3304 => "Атрибут с указанным идентификатором не существует",
        3305 => "Группа атрибутов с указанным идентификатором не существует",
        3306 => "Опция с указанным идентификатором не существует",
        3307 => "Производитель с указанным идентификатором не существует",
        3308 => "Файл с указанным идентификатором не существует",
        3309 => "Отзыв с указанным идентификатором не существует",
        3310 => "Статья с указанным идентификатором не существует",
    );

    public function __construct() {
        $this->useSSL = (!empty($_SERVER['HTTPS'])) ? true : false;
        $this->parseURLs();
    }

    /**
     * TODO: ???
     */
    private function parseURLs() {
        $this->URL_SHOP = ($this->useSSL) ? HTTPS_SERVER : HTTP_SERVER;
        
        $imagePath = mb_split('/', DIR_IMAGE);
        $this->URL_IMAGE_DIR = $this->URL_SHOP . $imagePath[sizeof($imagePath) - 2] . '/';
        
        // TODO: ...
    }

    /**
     * Проверяет поддерживается ли указанная версия API.
     * @param $version String Версия API, переданная с запросом.
     * @return bool True если версия API поддерживается, иначе False.
     * @deprecated Не актуален...
     */
    public function checkVersion($version) { // TODO: Не актуален...
        if (!file_exists("./app/" . $version . "/")) return false;
        if (!file_exists("./model/" . $version . "/")) return false;
        if (!file_exists("./controller/" . $version . "/")) return false;

        return $version;
    }

    /**
     * Проверяет соответствует ли формат запроса стандарту.
     * @return bool True если все условия выполнены, иначе False.
     */
    public function checkRequest() {
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // REQUEST JSON FORMAT:
        // GET params:
        // {
        //      'path': <ROUTE>,
        //      'api_ver': vX.X,
        //      'fields': ... ,
        //      'filter': ... ,
        //      'sort': ... ,
        //      'offset': ... ,
        //      'count': ... ,
        //      'type': ... ,
        // }

        // Description:
        // 'path'       - Обязательный параметр. Определяет запрашиваемый пользователем ресурс.
        // 'api_ver'    - Обязательный параметр. Определяет используемую версию API.
        // 'fields'     - Необязательный параметр. Перечисление полей, которые необходимо вернуть в
        //                результирующем наборе. Если параметр не указан, возвращаются все поля.
        // 'filter'     - Необязательный параметр. Перечисление правил фильтрации, применяемых к списку
        //                ресурсов перед помещением его в результирующий набор.
        // 'sort'       - Необязательный параметр. Перечисление правил сортировки, применяемых к списку
        //                ресурсов перед помещением его в результирующий набор.
        // 'offset'     - Необязательный параметр. Смещение на N-е количество элементов при выборке. Если не
        //                указано значение или указано 0, выборка будет производиться с первого элемента.
        // 'count'      - Необязательный параметр. Количество элементов в результирующем наборе. Если не указано
        //                значение или указано 0, в результирующий набор будут помещены все элементы начиная с «offset».
        // 'type'       - Необязательный параметр. Определяет тип возвращаемых данных. Может принимать
        //                значения «json» или «xml». По умолчанию значение «json».
        //
        // POST BODY:
        // {
        //      "action": "CREATE|READ|UPDATE|DELETE",
        //      "lang": "ru|gb|...",
        //      "token": "...",
        //      "content": { ... }
        // }
        //
        // Description:
        // 'action'     - Требуемое действие.
        // 'lang'       - Код языка.
        // 'token'      - Токен сессии, сгенерированный сервером.
        // 'content'    - Значение, либо массив данных.
        //                Информативная часть тела запроса. Содержимое индивидуально для каждого пути.
        //                Не может быть пустым для действий 'CREATE' и 'UPDATE'.
        //
        //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') return false;

        $input = file_get_contents('php://input');

        if (!empty($_SERVER['CONTENT_TYPE'])) {
            if (mb_strpos($_SERVER['CONTENT_TYPE'], 'application/json') > -1) {
                $_POST = json_decode($input, true);
            } elseif (mb_strpos($_SERVER['CONTENT_TYPE'], 'application/xml') > -1) {
                $parser = xml_parser_create("UTF-8");
                xml_parse_into_struct($parser, $input, $_POST, $index);
                xml_parser_free($parser);

                // TODO: exit;
                echo var_export($_POST, true);
                echo '<br><br>';
                echo var_export($index, true);
                echo '<br><br>';
                exit;
            } else {
                return false;
            }
        } else {
            return false;
        }

        // TODO: ?? Возвращать ответ с ошибкой для каждой проверки

        if (!isset($_GET['path']) || empty($_GET['path'])) return false;
//    if (!isset($_GET['api_ver']) || empty($_GET['api_ver'])) return false;
        if (!isset($_POST) || empty($_POST)) return false;
        if (!isset($_POST['action']) || empty($_POST['action'])) return false;
        if (!Actions::isValidAction($_POST['action'])) return false;
        if (($_POST['action'] == 'CREATE' || $_POST['action'] == 'UPDATE')
            && (!isset($_POST['content']) || empty($_POST['content']))) return false;

        return true;
    }

    /**
     * Возвращает ответ с ошибкой.
     * В случае, если задан массив $reasonFormatterArgs, к строке $reason применяется форматирование.
     * @param bool $success True если запрос обработан без ошибок, иначе False.
     * @param int $code Код состояния.
     * @param string $reason Описание кода состояния для пользователя. Может быть задано форматирование.
     *                       Описание правил форматирования в документации метода PHP sprintf().
     * @param array $reasonFormatterArgs Аргументы форматирования сообщения $reason.
     */
    public function sendResponseFail($success = false,
                              $code = 3101,
                              $reason = '',
                              $reasonFormatterArgs = array()) {
        $this->sendResponse('', null, null, null, $success, $code, $reason, $reasonFormatterArgs);
    }
    /**
     * Возвращает ответ.
     * В случае, если задан массив $reasonFormatterArgs, к строке $reason применяется форматирование.
     * @param mixed $content Значение, либо массив данных.
     * @param int $totalCount Число записей в базе данных, соответствующих фильтрам, указанным в запросе.
*                             Значение может отличаться от значения параметра «count», в первую очередь, в случае,
     *                        если в запросе были указаны параметры «count» и «offset» с ненулевыми значениями.
     * @param int $count Количество объектов, передаваемых с параметром «content». Может принимать значения:
     *                   <br />0 – нет данных;
     *                   <br />1 – один объект, либо массив, содержащий 1 объект;
     *                   <br />N – массив из N объектов.
     * @param int $offset Число, указывающее н а смещение в списке при выборке объектов. Дублирует параметр,
     *                    указанный в запросе, либо принимает значение «0».
     * @param bool $success True если запрос обработан без ошибок, иначе False.
     * @param int $code Код состояния.
     * @param string $reason Описание кода состояния для пользователя. Может быть задано форматирование.
     *                       Описание правил форматирования в документации метода PHP sprintf().
     * @param array $reasonFormatterArgs Аргументы форматирования сообщения $reason.
     */
    public function sendResponse($content = '',
                          $totalCount = null,
                          $count = null,
                          $offset = null,
                          $success = true,
                          $code = STATUS_1000_SUCCESS,
                          $reason = '',
                          $reasonFormatterArgs = array()) {
        // RESPONSE JSON FORMAT:
        // {
        //      'success': true|false,
        //      'code': <STATUS CODE>,
        //      'reason': <STATUS DESCRIPTION>,
        //      'count': 0|1|N,
        //      'total': 0|1|N,
        //      'offset': 0|1|N,
        //      'content': { ... }
        // }
        //
        // Description:
        // 'success'    - Успешность выполнения запроса.
        // 'code'       - Код состояния.
        // 'reason'     - Описание кода состояния для пользователя.
        // 'count'      - Количество объектов, передаваемых с параметром «content». Может принимать значения: 
        //                  0 – нет данных;
        //                  1 – один объект, либо массив, содержащий 1 объект;
        //                  N – массив из N объектов.
        // 'offset'     - Число, указывающее на смещение в списке при выборке объектов. Дублирует параметр, 
        //                указанный в запросе, либо принимает значение «0».
        // 'total'      - Число записей в базе данных, соответствующих фильтрам, указанным в запросе. 
        //                Значение может отличаться от значения параметра «count», в первую очередь, в случае, 
        //                если в запросе были указаны параметры «count» и «offset» с ненулевыми значениями.
        // 'content'    - Значение, объект, либо массив данных (в зависимости от запроса).
        //                Информативная часть тела ответа. Содержимое индивидуально для каждого ответа.
        //
        //

        $isAssocArr = (boolean)$this->isAssocArray($content);
        $reason = (!empty($reason)) ? $reason : ((key_exists($code, static::$STATUS_DESCRIPTION)) ? static::$STATUS_DESCRIPTION[$code] : '');
        $count = (isset($count) ? $count : (($isAssocArr) ? 1 : (is_array($content) ? sizeof($content) : 0)));
        $totalCount = (isset($totalCount) ? $totalCount : $count);
        $offset = (isset($offset) ? $offset : (isset($_GET['offset']) && !$isAssocArr) ? (int)$_GET['offset'] : 0);

        if (!empty($reasonFormatterArgs) && is_array($reasonFormatterArgs)) {
            $reason = vsprintf($reason, $reasonFormatterArgs);
        }

        $time_arr = explode(' ', microtime());
        $end_time = floatval($time_arr[1]) + floatval($time_arr[0]);
        $execution_time = $end_time - API_REQUEST_START_TIME;

        $response = array(
            "success"   => $success,
            "code"      => $code,
            "reason"    => $reason,
            "count"     => $count,
            "total"     => $totalCount,
            "offset"    => $offset,
            "content"   => $content,
        );
        
        if (API_DEBUG_MODE) {
            $response += array(
                "exec_time"   => $execution_time,
            );
        }

        if (isset($_GET['type']) && $_GET['type'] == 'xml') {
            $response = xmlrpc_encode($response); // TODO: Call to undefined function OpenCartWebAPI\xmlrpc_encode()...
            header("Content-Type: application/xml; charset=utf-8", true, 200);
        } else {
            $response = json_encode($response);
            header("Content-Type: application/json; charset=utf-8", true, 200);
        }

        header("Content-Length: " . strlen($response));
        echo $response;
//        header("Content-Type: text/html; charset=utf-8", true, 200);
//        echo "<div id='json'>" . $response . "</div>";
//        echo "<script>console.log(JSON.parse(document.getElementById('json').innerText));</script>";
        
        exit(0);
    }

    /**
     * Checks whether <u>$array</u> is an associative array.
     * @param array $array The Array.
     * @return bool|int <em>true</em> if <u>$array</u> is associative, <em>false</em> otherwise.
     * If <u>$array</u> is null or empty array it will return <em>null</em>.
     */
    public function isAssocArray($array) {
        if($array == null || count($array) == 0) {
            return null;
        }

        $keys = array_keys($array);

        foreach ($keys as $key) {
            if (!is_numeric($key)) return true;
        }

        if ((int)$keys[0] == 0 && (int)$keys[count($keys) - 1] == count($keys) - 1) return false;

        return null;
    }

    /**
     * @param $string string Транслитерируемая строка.
     * @param bool|string $skip_special_chars Удалять специальные символы, либо заменять их на указанную строку.
     * @return string Результат транслитерации.
     */
    public function translate_ru2lat($string, $skip_special_chars = false) {
        if($string == null || !is_string($string)) return null;
        if($skip_special_chars == null) $skip_special_chars = false;

        $charset = array(
            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',    'Е' => 'E',     'Ё' => 'YO',
            'Ж' => 'ZH',   'З' => 'Z',    'И' => 'I',    'Й' => 'Y',    'К' => 'K',    'Л' => 'L',     'М' => 'M',
            'Н' => 'N',    'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',     'У' => 'U',
            'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'CH',   'Ш' => 'SH',   'Щ' => 'SCH',   'Ъ' => '',
            'Ы' => 'Y',    'Ь' => '',     'Э' => 'E',    'Ю' => 'YU',   'Я' => 'YA',

            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',    'е' => 'e',     'ё' => 'yo',
            'ж' => 'zh',   'з' => 'z',    'и' => 'i',    'й' => 'y',    'к' => 'k',    'л' => 'l',     'м' => 'm',
            'н' => 'n',    'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',     'у' => 'u',
            'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',   'ш' => 'sh',   'щ' => 'sch',   'ъ' => '',
            'ы' => 'y',    'ь' => '',     'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'A' => 'A',    'B' => 'B',    'C' => 'C',    'D' => 'D',    'E' => 'E',    'F' => 'F',     'G' => 'G',
            'H' => 'H',    'I' => 'I',    'J' => 'J',    'K' => 'K',    'L' => 'L',    'M' => 'M',     'N' => 'N',
            'O' => 'O',    'P' => 'P',    'Q' => 'Q',    'R' => 'R',    'S' => 'S',    'T' => 'T',     'U' => 'U',
            'V' => 'V',    'W' => 'W',    'X' => 'X',    'Y' => 'Y',    'Z' => 'Z',

            'a' => 'a',    'b' => 'b',    'c' => 'c',    'd' => 'd',    'e' => 'e',    'f' => 'f',     'g' => 'g',
            'h' => 'h',    'i' => 'i',    'j' => 'j',    'k' => 'k',    'l' => 'l',    'm' => 'm',     'n' => 'n',
            'o' => 'o',    'p' => 'p',    'q' => 'q',    'r' => 'r',    's' => 's',    't' => 't',     'u' => 'u',
            'v' => 'v',    'w' => 'w',    'x' => 'x',    'y' => 'y',    'z' => 'z',
        );

        $out = "";

        for ($start = 0; $start < mb_strlen($string, "utf-8"); $start++) {
            $char = mb_substr($string, $start, 1, "utf-8");

            if (isset($charset[$char])) {
                $out .= $charset[$char];
            } elseif (is_numeric($char) || $skip_special_chars === false) {
                $out .= $char;
            } elseif (is_string($skip_special_chars)) {
                $out .= $skip_special_chars;
            }
        }

        return $out;
    }
}