<?php
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// STATUS CODES: RFC6455 STANDARD (WebSockets)
/**
 * 1000 indicates a normal closure, meaning that the purpose for
 * which the connection was established has been fulfilled.
 */
define("STATUS_1000_SUCCESS", 1000);
/**
 * 1001 indicates that an endpoint is "going away", such as a server
 * going down or a browser having navigated away from a page.
 */
define("STATUS_1001_GOING_AWAY", 1001);
/**
 * 1002 indicates that an endpoint is terminating the connection due
 * to a protocol error.
 */
define("STATUS_1002_PROTOCOL_ERROR", 1002);
/**
 * 1003 indicates that an endpoint is terminating the connection
 * because it has received a type of data it cannot accept (e.g., an
 * endpoint that understands only text data MAY send this if it
 * receives a binary message).
 */
define("STATUS_1003_WRONG_DATA_TYPE", 1003);
/**
 * Reserved.  The specific meaning might be defined in the future.
 */
define("STATUS_1004_RESERVED", 1004);
/**
 * 1005 is a reserved value and MUST NOT be set as a status code in a
 * Close control frame by an endpoint.  It is designated for use in
 * applications expecting a status code to indicate that no status
 * code was actually present.
 */
define("STATUS_1005_NO_STATUS_CODE", 1005);
/**
 * 1006 is a reserved value and MUST NOT be set as a status code in a
 * Close control frame by an endpoint.  It is designated for use in
 * applications expecting a status code to indicate that the
 * connection was closed abnormally, e.g., without sending or
 * receiving a Close control frame.
 */
define("STATUS_1006_ABNORMALLY", 1006);
/**
 * 1007 indicates that an endpoint is terminating the connection
 * because it has received data within a message that was not
 * consistent with the type of the message (e.g., non-UTF-8 [RFC3629]
 * data within a text message).
 */
define("STATUS_1007_WRONG_FORMAT", 1007);
/**
 * 1008 indicates that an endpoint is terminating the connection
 * because it has received a message that violates its policy.  This
 * is a generic status code that can be returned when there is no
 * other more suitable status code (e.g., 1003 or 1009) or if there
 * is a need to hide specific details about the policy.
 */
define("STATUS_1008_VIOLATES_POLICY", 1008);
/**
 * 1009 indicates that an endpoint is terminating the connection
 * because it has received a message that is too big for it to process.
 */
define("STATUS_1009_BIG_MESSAGE", 1009);
/**
 * 1010 indicates that an endpoint (client) is terminating the
 * connection because it has expected the server to negotiate one or
 * more extension, but the server didn't return them in the response
 * message of the WebSocket handshake.  The list of extensions that
 * are needed SHOULD appear in the /reason/ part of the Close frame.
 * Note that this status code is not used by the server, because it
 * can fail the WebSocket handshake instead.
 */
define("STATUS_1010_NOT_ACCEPTABLE_EXTENSION", 1010);
/**
 * 1011 indicates that a server is terminating the connection because
 * it encountered an unexpected condition that prevented it from
 * fulfilling the request.
 */
define("STATUS_1011_UNEXPECTED_CONDITION", 1011);
/**
 * 1015 is a reserved value and MUST NOT be set as a status code in a
 * Close control frame by an endpoint.  It is designated for use in
 * applications expecting a status code to indicate that the
 * connection was closed due to a failure to perform a TLS handshake
 * (e.g., the server certificate can't be verified).
 */
define("STATUS_1015_CONNECTION_FAILED", 1015);


// TODO: Описать коды приложения

// Application error codes 3100-3199
/**
 * Reason: «Версия API более не поддерживается».
 */
define("STATUS_3100_VERSION_NOT_SUPPORT", 3100);
/**
 * Reason: «Внутренняя ошибка».
 */
define("STATUS_3101_INTERNAL_ERROR", 3101);
/**
 * Reason: «Указанная для пути '%s' функция не может быть вызвана».
 */
define("STATUS_3102_NOT_A_FUNCTION", 3102);
/**
 * Reason: «Нет действия для пути '%s'».
 */
define("STATUS_3103_ROUTE_NOT_FOUND", 3103);
/**
 * Reason: «Доступ не разрешен с данного устройства».
 */
define("STATUS_3104_DEVICE_NOT_APPROVED", 3104);
/**
 * Reason: «Имя пользователя или пароль указаны неверно».
 */
define("STATUS_3105_AUTH_FAILED", 3105);
/**
 * Reason: «Недостаточно данных для выполнения операции».
 */
define("STATUS_3106_INSUFFICIENT_DATA", 3106);
/**
 * Reason: «Время сессии истекло. Необходима повторная аутентификация».
 */
define("STATUS_3107_SESSION_EXPIRED", 3107);
/**
 * Reason: «Аккаунт заблокирован. Обратитесь к администратору».
 */
define("STATUS_3108_ACCOUNT_BLOCKED", 3108);
/**
 * Reason: «Действие '%s', указанное в запросе, не поддерживается».
 */
define("STATUS_3109_NOT_AN_ACTION", 3109);
/**
 * Reason: «Запрос не распознан».
 */
define("STATUS_3110_WRONG_REQUEST", 3110);

// Database error codes 3200-3299
/**
 * Reason: «Невозможно подключиться к базе данных».
 */
define("STATUS_3200_DB_CONNECTION_ERROR", 3200);
/**
 * Reason: «Ошибка при обращении к базе данных».
 */
define("STATUS_3201_DB_ERROR", 3201);

// Specialized error codes 3300-3399
/**
 * Reason: «Не указан идентификатор».
 */
define("STATUS_3300_ID_NOT_SPECIFIED", 3300);
/**
 * Reason: «Категория с указанным идентификатором не существует».
 */
define("STATUS_3301_CATEGORY_NOT_FOUND", 3301);
/**
 * Reason: «Товар с указанным идентификатором не существует».
 */
define("STATUS_3302_PRODUCT_NOT_FOUND", 3302);
/**
 * Reason: «Фильтр с указанным идентификатором не существует».
 */
define("STATUS_3303_FILTER_NOT_FOUND", 3303);
/**
 * Reason: «Атрибут с указанным идентификатором не существует».
 */
define("STATUS_3304_ATTRIBUTE_NOT_FOUND", 3304);
/**
 * Reason: «Группа атрибутов с указанным идентификатором не существует».
 */
define("STATUS_3305_ATTRIBUTE_GROUP_NOT_FOUND", 3305);
/**
 * Reason: «Опция с указанным идентификатором не существует».
 */
define("STATUS_3306_OPTION_NOT_FOUND", 3306);
/**
 * Reason: «Производитель с указанным идентификатором не существует».
 */
define("STATUS_3307_MANUFACTURER_NOT_FOUND", 3307);
/**
 * Reason: «Файл с указанным идентификатором не существует».
 */
define("STATUS_3308_DOWNLOAD_FILE_NOT_FOUND", 3308);
/**
 * Reason: «Отзыв с указанным идентификатором не существует».
 */
define("STATUS_3309_REVIEW_NOT_FOUND", 3309);
/**
 * Reason: «Статья с указанным идентификатором не существует».
 */
define("STATUS_3310_INFO_PAGE_NOT_FOUND", 3310);

// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

