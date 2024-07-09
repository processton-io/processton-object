<?php

namespace Processton\ProcesstonObject\Traits\SchemaTasks;

use Processton\ProcesstonObject\Models\DropletObject;
use Processton\ProcesstonObject\Models\DropletObjectElement;

use Illuminate\Support\Facades\DB;

trait ProcessObject {

    use ApplyObject;

    protected function processObjects($objects, $dryRun = true){
        
        $parsedObject = [];
        $processLogs = [];

        foreach($objects as $object){
            
            $tempObject = [];
            
            if(array_key_exists('fields', $object) && count($object['fields']) >= 1){

                $tempObject['fields'] = $object['fields'];

            }
            if(array_key_exists('name', $object) && $object['name'] != ''){
                $tempObject['name'] = $object['name'];
            }
            if(array_key_exists('plural_name', $object) && $object['plural_name'] != ''){
                $tempObject['plural_name'] = $object['plural_name'];
            }
            if(array_key_exists('model', $object) && $object['model'] != ''){
                $tempObject['model'] = $object['model'];
            }
            if(array_key_exists('slug', $object) && $object['slug'] != ''){
                $tempObject['slug'] = $object['slug'];
            }

            if(array_key_exists('slug',$tempObject)){
                $parsedObject[] = $tempObject;
            }else{
                $processLogs[] = 'Error: Object structure is not complete';
            }
        }

        DB::beginTransaction();
        $DBObjects = [];
        foreach($parsedObject as $objectItem){

            $isNewObject = false;

            $DBObject = DropletObject::where([
                'slug' => $objectItem['slug']
            ])->firstOr(function () use (&$processLogs, $objectItem, &$isNewObject, $dryRun){
                try{
                $newObject = DropletObject::create([
                    'name' => $objectItem['name'],
                    'slug' => $objectItem['slug']
                ]);
                $isNewObject = true;
                $processLogs[] = $objectItem['name'].' object '. ($dryRun ? ' will be created' : ' is created');
                return $newObject;
            }catch(\Exception $e){
                dd($e, $objectItem);
            }
            });
            
            if(
                array_key_exists('identity', $objectItem) ||
                array_key_exists('plural_name', $objectItem) ||
                array_key_exists('model', $objectItem)
            ){
                if(array_key_exists('identity', $objectItem)){
                    $DBObject->__set('identity', $objectItem['identity']);
                }
                if(array_key_exists('plural_name', $objectItem)){
                    $DBObject->__set('plural_name', $objectItem['plural_name']);
                }
                if(array_key_exists('model', $objectItem)){
                    $DBObject->__set('model', $objectItem['model']);
                }
                $DBObject->isDirty() && $DBObject ->save();
            }

            if($isNewObject){

                foreach($objectItem['fields'] as $field){
                    $element = DropletObjectElement::create([
                        "name" => $field['name'],
                        "slug" => $field['slug'],
                        "type" => $field['type'],
                        "droplet_object_id" => $DBObject->id
                    ]);

                    if(array_key_exists("is_required", $field)){
                        $element->__set("is_required",  $field['is_required']);
                    }
                    if(array_key_exists("nullable", $field)){
                        $element->__set("nullable",  $field['nullable']);
                    }
                    if(array_key_exists("min", $field)){
                        $element->__set("min",  $field['min']);
                    }
                    if(array_key_exists("max", $field)){
                        $element->__set("max",  $field['max']);
                    }
                    
                    if(array_key_exists("to", $field)){
                        $element->__set("relation_to",  $field['to']);
                    }

                    $element->isDirty() && $element->save();
                }
                
            }else{
                foreach($objectItem['fields'] as $field){

                    $DBObjectElement = DropletObjectElement::where([
                        'slug' => $field['slug'],
                        'type' => $field['type'],
                        'droplet_object_id' => $DBObject->id
                    ])->firstOr(function () use (&$processLogs, $field, &$isNewObject,$DBObject, $dryRun){
                        
                        $newObject = DropletObjectElement::create([
                            'name' => $field['name'],
                            'slug' => $field['slug'],
                            'type' => $field['type'],
                            'droplet_object_id' => $DBObject->id
                        ]);

                        $newObject ->save();
                        $isNewObject = true;
                        $processLogs[] = $field['name'].' with '. ($dryRun ? ' will be created' : ' is created');
                        return $newObject;
                    });

                    if(array_key_exists("required", $field)){
                        $DBObjectElement->__set("required",  $field['required']);
                    }
                    if(array_key_exists("nullable", $field)){
                        $DBObjectElement->__set("nullable",  $field['nullable']);
                    }
                    if(array_key_exists("min", $field)){
                        $DBObjectElement->__set("min",  $field['min']);
                    }
                    if(array_key_exists("max", $field)){
                        $DBObjectElement->__set("max",  $field['max']);
                    }
                    if(array_key_exists("to", $field)){
                        $DBObjectElement->__set("relation_to",  $field['to']);
                    }
                    $DBObjectElement->isDirty() && $DBObjectElement->save();
                }
            }
            $DBObjects[] = $DBObject;
        }

        
        if($dryRun){
            DB::rollBack();
        }else{
            DB::commit();
            $this->applyObjects($DBObjects);
        }
        return $processLogs;
    }

}