<?php

namespace Processton\ProcesstonObject\Constants;

class MySQLDataTypes{
    protected static $typeMap = array(
        'int' => 'INT',
        'integer' => 'INT',
        'tinyint' => 'TINYINT',
        'smallint' => 'SMALLINT',
        'mediumint' => 'MEDIUMINT',
        'bigint' => 'BIGINT',
        'relation' => 'BIGINT',
        'decimal' => 'DECIMAL',
        'float' => 'FLOAT',
        'double' => 'DOUBLE',
        'date' => 'DATE',
        'time' => 'TIME',
        'datetime' => 'DATETIME',
        'timestamp' => 'TIMESTAMP',
        'year' => 'YEAR',
        'char' => 'CHAR',
        'varchar' => 'VARCHAR',
        'tinytext' => 'TINYTEXT',
        'text' => 'TEXT',
        'mediumtext' => 'MEDIUMTEXT',
        'longtext' => 'LONGTEXT',
        'enum' => 'ENUM',
        'set' => 'SET',
        'binary' => 'BINARY',
        'boolean' => 'BINARY',
        'varbinary' => 'VARBINARY',
        'tinyblob' => 'TINYBLOB',
        'blob' => 'BLOB',
        'mediumblob' => 'MEDIUMBLOB',
        'longblob' => 'LONGBLOB',
        'geometry' => 'GEOMETRY',
        'point' => 'POINT',
        'linestring' => 'LINESTRING',
        'polygon' => 'POLYGON',
        'geometrycollection' => 'GEOMETRYCOLLECTION',
        'multipoint' => 'MULTIPOINT',
        'multilinestring' => 'MULTILINESTRING',
        'multipolygon' => 'MULTIPOLYGON',
        'json' => 'JSON',
        'jsonarray' => 'JSON ARRAY',
        'bit' => 'BIT',
        'number' => 'DECIMAL',
        'list' => 'ENUM',
        'string' => 'VARCHAR',
        'date_of_bith' => 'VARCHAR'
    );

    protected static $defaultLength = array(
        'int' => 11,
        'integer' => 11,
        'tinyint' => 4,
        'smallint' => 8,
        'mediumint' => 12,
        'bigint' => 21,
        'relation' => 21,
        'char' => 255,
        'varchar' => 255,
        'number' => 11,
    );

    protected static $relationMap = array(
        'belongsTo' => 'belongsTo',
        // 'belongsToMany' => 'belongsToMany',
        'hasOne' => 'hasOne',
        // 'hasMany' => 'hasMany',
        // 'morphTo' => 'morphTo',
        // 'morphOne' => 'morphOne',
        // 'morphMany' => 'morphMany',
        // 'morphToMany' => 'morphToMany',
        // 'morphedByMany' => 'morphedByMany',
        
    );

    public static function all() {
        return self::$typeMap;
    }

    public static function options()
    {
        $options = [];
        foreach(self::$typeMap as $key => $value){
            $options[] = ['value' => $key, 'label' => $value];
        }
        return $options;
    }

    public static function relationOptions()
    {
        $options = [];
        foreach (self::$relationMap as $key => $value) {
            $options[] = ['value' => $key, 'label' => $value];
        }
        return $options;
    }

    public static function getDefaultLength($type) {
        $type = strtolower($type);
        if (array_key_exists($type, self::$defaultLength)) {
            return self::$defaultLength[$type];
        }
        return null; // Return null for unsupported data types
    }

    public static function availableLengthOptions(){
        $options = [];
        foreach(self::$defaultLength as $key=>$value){
            $options[] = $key;
        }
        return $options;
    }

    public static function getValue($type) {
        $type = strtolower($type);
        if (array_key_exists($type, self::$typeMap)) {
            return self::$typeMap[$type];
        }
        return 'TEXT'; // Return null for unsupported data types
    }
}
