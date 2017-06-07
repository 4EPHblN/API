<?php
namespace OpenCartWebAPI;

class MySQLi {
	private $link = null;
	private $context;

	public function __construct($hostname, $username, $password, $database, $port = '3306') {
		try {
			$this->link = new \mysqli($hostname, $username, $password, $database, $port);
		} catch (\Exception $e) {
			$this->context->sendResponse(false, "", STATUS_3200_DB_CONNECTION_ERROR);
		}

		if ($this->link != null) {
			if ($this->getLastErrorNo() != 0 || $this->link->connect_error) {
				$this->context = new Context();
				$this->context->sendResponse(false, "", STATUS_3200_DB_CONNECTION_ERROR);
			}

			$this->link->set_charset("utf8");
			$this->link->query("SET SQL_MODE = '';");
			$this->link->query("SET AUTOCOMMIT=0;");
		} else {
			$this->context->sendResponse(false, "", STATUS_3200_DB_CONNECTION_ERROR);
		}
	}

    /**
     * Выполняет SQL-запрос.
     * В случае, если запрос предполагает изменение данных, необходим вызов метода "commit()".
     * Можно выполнять серию запросов перед вызовом "commit()".
     * В случае ошибки, автоматически откатывает не сохраненные изменения.
     * @param $sql string SQL-запрос.
     * @return array|bool Данные, полученные в результате выполнения запроса, либо False, в случае неудачи.
     */
	public function query($sql) {
		$query = $this->link->query($sql);

		if (!$this->link->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = array(
					"num_rows" 	=> sizeof($data),
					"row" 		=> isset($data[0]) ? $data[0] : array(),
					"rows"		=> $data
				);

				$query->close();

				return $result;
			} else {
                return true;
			}
		} else {
            $err = $this->link->error;

            $this->rollback();
			$this->context->sendResponseFail(false, STATUS_3201_DB_ERROR, $err);
			return false;
		}
	}

    /**
     * Выполняет SQL-запрос и сразу записывает изменения базы данных.
     * В случае ошибки, автоматически откатывает не сохраненные изменения.
     * @param $sql string SQL-запрос.
     * @return array|bool Данные, полученные в результате выполнения запроса, либо False, в случае неудачи.
     */
	public function queryCommit($sql) {
		$query = $this->link->query($sql);

		if (!$this->link->errno) {
            $this->commit();

			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = array(
					"num_rows" 	=> sizeof($data),
					"row" 		=> isset($data[0]) ? $data[0] : array(),
					"rows"		=> $data
				);

				$query->close();

				return $result;
			} else {
                return true;
			}
		} else {
            $err = $this->link->error;

            $this->rollback();
			$this->context->sendResponseFail(false, STATUS_3201_DB_ERROR, $err);
			return false;
		}
	}

    /**
     * Сохраняет изменения базы данных.
     * @return bool True в случае успеха, иначе False
     */
    public function commit() {
        return (bool)$this->link->query("COMMIT;");
    }

    /**
     * Проверяет работоспособность соединения или пытается переподключиться, если соединение разорвано.
     * @return bool Возвращает True в случае успешного завершения или False в случае возникновения ошибки.
     */
    public function ping() {
        return $this->link->ping();
    }

    /**
     * Откатывает не сохраненные изменения базы данных.
     * @return bool True в случае успеха, иначе False
     */
    public function rollback() {
        return (bool)$this->link->query("ROLLBACK;");
    }

    /**
     * Экранирует специальные символы в строке для использования в SQL выражении,
     * используя текущий набор символов соединения.
     * Экранируемые символы NUL (ASCII 0), \n, \r, \, ', ", и Control-Z.
     * @param $string string Строка, которую требуется экранировать.
     * @return string Экранированная строка.
     */
    public function escape($string) {
		return $this->link->real_escape_string($string);
	}

    /**
     * Получает число строк, затронутых предыдущей операцией MySQL
     * @return int Целое число, большее нуля, означает количество затронутых или полученных строк.
	 * Ноль означает, что запросом вида UPDATE не обновлено ни одной записи, или что ни одна строка
	 * не соответствует условию WHERE в запросе, или что запрос еще не был выполнен. <br />
	 * Значение -1 указывает на то, что запрос вернул ошибку.
     */
	public function affectedRows() {
		return $this->link->affected_rows;
	}

    /**
     * Возвращает число столбцов, затронутых последним запросом.
     * @return int Целое число, содержащее число полей затронутых в результате запроса.
     */
	public function fieldCount() {
		return $this->link->field_count;
	}

    /**
     * Возвращает автоматически генерируемый ID, используя последний запрос.
     * @return int Последний сгенерированный ID.
     */
	public function getLastId() {
		return (int)$this->link->insert_id;
	}

    /**
     * Возвращает код ошибки последнего запроса.
     * @return int Код ошибки последнего запроса в случае провала. При отсутствие ошибок выводит 0.
     */
	public function getLastErrorNo() {
		return $this->link->errno;
	}

    /**
     * Возвращает строку с описанием последней ошибки.
     * @return string Строка с описанием ошибки. Пустая строка, если ошибки нет.
     */
	public function getLastError() {
		return $this->link->error;
	}

	public function __destruct() {
		$this->link->close();
	}
}