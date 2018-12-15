<?php

namespace Core\Layout;
require 'Table.php';

use ArgumentCountError;
use InvalidArgumentException;
use Core\Layout\TableLayout;

final class Grid
{
    private static $table;
    private static $properties = array();
    private static $hiddenFields = array();
    private function __construct()
    {

    }

    public static function view(array $properties = array())
    {

        static::setProperty($properties);
        static::checkType($properties);
        static::setType($properties['type']);
        return static::$table->build(static::$properties['dataSource'],static::$properties['hiddenFields'],true, static::$properties['th']);
    }

    private static function setType(Table $table): void
    {
        static::$table = $table;
    }

    private static function setProperty(array $properties): void
    {
        static::$properties = $properties;
    }

    private static function checkType(array $properties): void
    {
        if (count(static::$properties) === 0) {
            throw new ArgumentCountError("Please Set Property");
            die();
        }

        if (!isset(static::$properties['type']) && !static::$properties['type'] instanceof TableLayout) {
            throw new InvalidArgumentException("type must be instace of TableLayout");
            die();
        }

        // dataSource property array değilse ve hiç tanımlanmamışsa
        if (!isset(static::$properties['dataSource']) && !is_array($properties['dataSource'])) {
            throw new InvalidArgumentException("Invalid Data Type");
            die();
        }

        // dataSource property array değilse ve hiç tanımlanmamışsa
        if (!isset(static::$properties['th']) && !is_array($properties['th'])) {
            throw new InvalidArgumentException("Please Set th property => []");
            die();
        }

        if (empty(static::$properties['hiddenFields'])){
            static::$properties['hiddenFields'] = array();
        }

    }

}