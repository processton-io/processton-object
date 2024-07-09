<?php

namespace Processton\ProcesstonObject\Traits\SchemaTasks;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Processton\ProcesstonObject\Constants\MySQLDataTypes;

trait ApplyObject {


    protected function applyObjects($objects){

        foreach($objects as $dropletObject){
        
            if(!Schema::hasTable($dropletObject->slug)){

                Schema::create($dropletObject->slug, function (Blueprint $table) {
                    $table->id();
                    $table->string('identity')->nullable()->index();
                    $table->timestamps();
                });
            }

            foreach($dropletObject->columns as $column){

                if (!Schema::hasColumn($dropletObject->slug, $column->slug))
                {
                    Schema::table($dropletObject->slug, function (Blueprint $table) use ($column)
                    {
                        if(!in_array($column->type,[
                            'has_one',
                            'has_many'
                        ])){

                            try{
                                $type = MySQLDataTypes::getValue($column->type);
                            }catch(Exception $e){
                                
                            }
                            
                            if($type === 'INT'){
                                $elem = $table->integer($column->slug);
                            }else if($type === 'TINYINT'){
                                $elem = $table->tinyInteger($column->slug);
                            }else if($type === 'SMALLINT'){
                                $elem = $table->smallInteger($column->slug);
                            }else if($type === 'MEDIUMINT'){
                                $elem = $table->mediumInteger($column->slug);
                            }else if($type === 'BIGINT'){
                                $elem = $table->bigInteger($column->slug);
                            }else if($type === 'DECIMAL'){
                                $elem = $table->decimal($column->slug);
                            }else if($type === 'FLOAT') {
                                $elem = $table->float($column->slug);
                            }else if($type === 'DOUBLE'){
                                $elem = $table->double($column->slug);
                            }else if($type === 'DATE'){
                                $elem = $table->date($column->slug);
                            }else if($type === 'TIME'){
                                $elem = $table->time($column->slug);
                            }else if($type === 'DATETIME'){
                                $elem = $table->dateTime($column->slug);
                            }else if($type === 'TIMESTAMP'){
                                $elem = $table->timestamp($column->slug);
                            }else if($type === 'YEAR'){
                                $elem = $table->year($column->slug);
                            }else if($type === 'CHAR'){
                                $elem = $table->string($column->slug);
                            }else if($type === 'VARCHAR'){
                                $elem = $table->string($column->slug);
                            }else if($type === 'TINYTEXT'){
                                $elem = $table->tinyText($column->slug);
                            }else if($type === 'TEXT'){
                                $elem = $table->text($column->slug);
                            }else if($type === 'MEDIUMTEXT'){
                                $elem = $table->mediumText($column->slug);
                            }else if($type === 'LONGTEXT'){
                                $elem = $table->longText($column->slug);
                            }else if($type === 'ENUM'){
                                $elem = $table->string($column->slug);
                            }else if($type === 'SET'){
                                $elem = $table->string($column->slug);
                            }else if($type === 'BINARY'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'VARBINARY'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'TINYBLOB'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'BLOB'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'MEDIUMBLOB'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'LONGBLOB'){
                                $elem = $table->binary($column->slug);
                            }else if($type === 'GEOMETRY'){
                                $elem = $table->geometry($column->slug);
                            }else if($type === 'POINT'){
                                $elem = $table->point($column->slug);
                            }else if($type === 'LINESTRING'){
                                $elem = $table->lineString($column->slug);
                            }else if($type === 'POLYGON'){
                                $elem = $table->polygon($column->slug);
                            }else if($type === 'GEOMETRYCOLLECTION'){
                                $elem = $table->geometryCollection($column->slug);
                            }else if($type === 'MULTIPOINT'){
                                $elem = $table->multiPoint($column->slug);
                            }else if($type === 'MULTILINESTRING'){
                                $elem = $table->multiLineString($column->slug);
                            }else if($type === 'MULTIPOLYGON'){
                                $elem = $table->multiPolygon($column->slug);
                            }else if($type === 'JSON'){
                                $elem = $table->json($column->slug);
                            }else if($type === 'JSON ARRAY'){
                                $elem = $table->json($column->slug);
                            }else if($type === 'BIT'){
                                // $elem = $table->bit($column->slug);
                            }

                            if(!$column->required){
                                $elem->nullable();
                            }
                        }
                        
                    });
                }



            }
            
        }
    }

}