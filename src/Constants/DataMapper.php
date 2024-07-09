<?php

namespace Processton\ProcesstonObject\Constants;


abstract class DataMapper{
    
    protected function __construct() {
        // Make the constructor protected to prevent direct instantiation
    }

    public static function getValue($type) {
        $type = strtolower($type);
        if (array_key_exists($type, self::$typeMap)) {
            return self::$typeMap[$type];
        }
        return null; // Return null for unsupported data types
    }

}