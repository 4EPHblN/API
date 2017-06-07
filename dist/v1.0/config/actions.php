<?php
namespace OpenCartWebAPI;

/**
 * TODO!!!
 * @package OpenCartWebAPI
 */
class Actions {
    public static $CREATE = 'CREATE';
    public static $READ   = 'READ';
    public static $UPDATE = 'UPDATE';
    public static $DELETE = 'DELETE';

    public static function isValidAction($action) {
        $action = strtoupper($action);

        if ($action == Actions::$CREATE
            || $action == Actions::$READ
            || $action == Actions::$UPDATE
            || $action == Actions::$DELETE) {
            return true;
        }

        return false;
    }
}
