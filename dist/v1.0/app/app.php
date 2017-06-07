<?php
namespace OpenCartWebAPI;
include "./app/context.php";

/**
 * Class OpenCartWebAPI
 * @package OpenCartWebAPI
 */
class OpenCartWebAPI extends Context {
    private $routes = array();
    private $path = "";
    private $action = "";

    /**
     * OpenCartWebAPI constructor.
     */
    public function __construct() {
        parent::__construct();

        if (!API_DEBUG_MODE) {
            if (file_exists('./install.php')) {
                echo 'Перед использованием необходимо удалить файл "install.php"';
                exit;
            }
        }

        if ($this->checkRequest()) {
            $this->path = $_GET['path'];

            $action = strtoupper($_POST['action']);
            if (Actions::isValidAction($action)) {
                $this->action = $action;
            } else {
                $this->sendResponseFail(false, STATUS_3109_NOT_AN_ACTION, '', array($action));
            }

            // Аутентификация
            $auth = new ModelAuth();
            if (!$auth->Auth(
                (isset($_POST['content']['login']) ? $_POST['content']['login'] : null),
                (isset($_POST['content']['password']) ? $_POST['content']['password'] : null),
                (isset($_POST['content']['device_id']) ? $_POST['content']['device_id'] : null),
                (isset($_POST['token']) ? $_POST['token'] : null)
            )) {
                $this->sendResponseFail();
            }
        } else {
            if (API_DEBUG_MODE) {
                echo '>>>>>>>>>>> php://input:<br>';
                echo file_get_contents('php://input');
                echo '<br><br>';

                echo '>>>>>>>>>>> $_GET:<br>';
                echo var_export($_GET, true);
                echo '<br><br>';

                echo '>>>>>>>>>>> $_POST:<br>';
                echo var_export($_POST, true);
                echo '<br><br>';

                echo '>>>>>>>>>>> $_REQUEST:<br>';
                echo var_export($_REQUEST, true);
                echo '<br><br>';

                echo '>>>>>>>>>>> $_SERVER:<br>';
                echo var_export($_SERVER, true);
                echo '<br><br>';

                exit;
            }
            
            $this->sendResponseFail(false, STATUS_3110_WRONG_REQUEST);
        }
    }

    /**
     * Задает путь и соответствующий ему метод обработки запроса.
     * @param $route string Путь запроса. Передаваемые в $callback данные должны быть помещены внутри фигурных
     *                      скобок, например «products/{[0-9]+}», чтобы передать функции ID продукта.
     * @param $action string Одно из действий {@link OpenCartWebAPI\Actions}.
     * @param $callback \callable Callback-функция, применяемая для данного пути. Может принимать $matches —
     *                            массив данных, полученный при разборе $route.
     */
    public function route($route, $action, $callback) {
        if (is_callable($callback)) {
            if (!isset($this->routes[$action])) {
                $this->routes[$action] = array();
            }
            $this->routes[$action][] = array($route, $callback);
        } else {
            $this->sendResponseFail(false, STATUS_3102_NOT_A_FUNCTION, null, array($route));
        }
    }

    /**
     * Запускает обработку запроса.
     */
    public function handle() {
//        echo '$this->routes: ' . var_export($this->routes, true) . '<br><br>';
//        exit();

        foreach ($this->routes[$this->action] as $item) {
//            echo '$item: ' . var_export($item, true) . '<br>';
//            exit();

            if ($matches = $this->checkRoute($item[0], $this->path)) {
                call_user_func($item[1], $matches);
                $pathFound = true;
                break;
            }
        }

        if (!isset($pathFound)) {
            $this->sendResponseFail(false, STATUS_3103_ROUTE_NOT_FOUND, null, array($this->path));
        }
    }

    /**
     * Проверяет, соответствует ли шаблон пути.
     * @param $pattern string Шаблон.
     * @param $subject string Проверяемый путь.
     * @return bool|array В случае, если путь совпадает с шаблоном, возвращает массив идентификаторов, найденных
*                         в пути, либо True, если шаблон не предусматривает идентификаторы, иначе False.
     */
    private function checkRoute($pattern, $subject)
    {
        $subject = rtrim($subject, "\/");

        $pattern = mb_ereg_replace("{", "(", $pattern);
        $pattern = mb_ereg_replace("}", ")", $pattern);
        $pattern = mb_ereg_replace("/", "\\/", $pattern);
        
        $matches = array();
        if (!preg_match('/' . $pattern . '\/.*?/', $subject) && !preg_match('/.*?\/' . $pattern . '/', $subject)) {
            if (preg_match('/' . $pattern . '/', $subject, $matches)) {
                unset($matches[0]);
                if (sizeof($matches) > 0) {
                    $values = array();
                    foreach ($matches as $value) {
                        $values[] = $value;
                    }
                    return $values;
                } else {
                    return true;
                }
            }
        }

        return false;
    }
}

