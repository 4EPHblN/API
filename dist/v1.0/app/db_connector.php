<?php
namespace OpenCartWebAPI;

class DBConnector {
    private $database = null;
    private $driver;
    public $drivers = array(
        'MySQLi' => 'mysqli',
        'mPDO' => 'mpdo',
        'PostgreSQL' => 'pgsql',
    );

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * Открывает соединение с базой данных.
     * @return null|MySQLi Экземпляр MySQLi в случае успеха, иначе возвращает сообщение с ошибкой.
     */
    public function connect() {
        ini_set('display_errors', '0');

        switch ($this->driver) {
            case 'mysqli': {
                if (class_exists('MySQLi')) {
                    try {
                        include_once "./app/drivers/mysqli.php";
                    } catch (\Exception $e) {}
                }

                $this->database = new MySQLi(API_DB_HOSTNAME, API_DB_USERNAME, API_DB_PASSWORD, API_DB_DATABASE, API_DB_PORT);

                ini_set('display_errors', '1');
                return $this->database;
            } break;

            default: {
                ini_set('display_errors', '1');
                return null;
            } break;
        }
    }
}