<?php

namespace Processton\ProcesstonObject\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Processton\ProcesstonForm\ProcesstonForm;
use Processton\ProcesstonInteraction\ProcesstonInteraction;
use Processton\ProcesstonObject\Constants\MySQLDataTypes;
use Processton\ProcesstonObject\Models\DropletObject;
use Processton\ProcesstonObject\Models\DropletObjectElement;
use Processton\ProcesstonTabs\ProcesstonTabs;

class ObjectEditController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $id = $request->id;
        $object = DropletObject::with('columns', 'relations')->find($id);
        return response()->json([
            'data' => ProcesstonForm::generateFormData(
                ProcesstonForm::generateFormSchema(
                    'Edit Object',
                    'edit',
                    ProcesstonForm::generateFormRows(
                        ProcesstonForm::generateFormRow([
                            ProcesstonForm::generateFormRowElement(
                                '',
                                'hidden',
                                'id',
                                null,
                                true,
                                '',
                                [],
                                [],
                                '',
                                [],
                                '',
                                [],
                                false,
                                null,
                                ProcesstonInteraction::width(0, 0, 0)
                            ),
                            ProcesstonForm::generateFormRowElement(
                                'Singular Label',
                                'text',
                                'name',
                                null,
                                true,
                                'Enter the singular label of the object',
                                [],
                                [],
                                '',
                                [],
                                '',
                                [],
                                false,
                                null,
                                ProcesstonInteraction::width(12, 6, 6)
                            ),
                            ProcesstonForm::generateFormRowElement(
                                'Plural Name',
                                'text',
                                'plural_name',
                                'Plural Name',
                                true,
                                'Enter the plural label of the object',
                                [],
                                [],
                                '',
                                [],
                                '',
                                [],
                                false,
                                null,
                                ProcesstonInteraction::width(12, 6, 6)
                            ),
                            [
                                ... ProcesstonForm::generateFormRowElement(
                                    'Slug',
                                    'text',
                                    'slug',
                                    'Slug',
                                    true
                                ),
                                'disabled' => true
                            ],

                        ]),
                        ProcesstonTabs::generateTabs([
                            ProcesstonTabs::generateTab('Attributes',
                                ProcesstonInteraction::generateRow(
                                [
                                    ProcesstonForm::generateFormRowElement(
                                        'Columns',
                                        'one-to-many',
                                        'columns',
                                        null,
                                        true,
                                        '',
                                        [],
                                        [],
                                        '',
                                        [
                                            ProcesstonForm::generateFormRowElement(
                                                'id',
                                                'hidden',
                                                'id',
                                                'Id',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(0, 0, 0)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'slug',
                                                'hidden',
                                                'slug',
                                                'slug',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(0, 0, 0)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Name',
                                                'text',
                                                'name',
                                                'name',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 6, 6)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Type',
                                                'simple_select',
                                                'type',
                                                'type',
                                                true,
                                                '',
                                                [],
                                                MySQLDataTypes::options(),
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 6, 6)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Length',
                                                'number',
                                                'length',
                                                'length',
                                                true,
                                                '',
                                                [
                                                    [
                                                        'key' => 'type.value',
                                                        'value' => MySQLDataTypes::availableLengthOptions(),
                                                        'operator' => 'IN'
                                                    ]
                                                ],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 3, 3)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Min',
                                                'number',
                                                'min',
                                                'min',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 3, 3)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Max',
                                                'number',
                                                'max',
                                                'max',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 3, 3)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Is Required?',
                                                'checkbox',
                                                'is_required',
                                                'is_required',
                                                null,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 12, 12)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Default value',
                                                'text',
                                                'default',
                                                'default',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 4, 3)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Comments',
                                                'text',
                                                'comments',
                                                'comments',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 4, 3)
                                            ),
                                        ],
                                        '',
                                        [],
                                        true
                                    ),
                                    
                                ]
                            ), ProcesstonInteraction::width(12, 12, 12)),
                            ProcesstonTabs::generateTab('Relations',
                                ProcesstonInteraction::generateRow(
                                [
                                    ProcesstonForm::generateFormRowElement(
                                        'Relations',
                                        'one-to-many',
                                        'relations',
                                        null,
                                        false,
                                        '',
                                        [],
                                        [],
                                        '',
                                        [
                                            ProcesstonForm::generateFormRowElement(
                                                'id',
                                                'hidden',
                                                'id',
                                                'Id',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(0, 0, 0)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'slug',
                                                'hidden',
                                                'slug',
                                                'slug',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(0, 0, 0)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Name',
                                                'text',
                                                'name',
                                                'name',
                                                true,
                                                '',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 4, 4)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Object',
                                                'simple_select',
                                                'relation_to',
                                                'relation_to',
                                                true,
                                                '',
                                                [],
                                                DropletObject::get()->map(function ($i) {
                                                    return [
                                                        'value' => $i->id,
                                                        'label' => $i->name
                                                    ];
                                                })->toArray(),
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 4, 4)
                                            ),
                                            ProcesstonForm::generateFormRowElement(
                                                'Type',
                                                'simple_select',
                                                'type',
                                                'type',
                                                true,
                                                '',
                                                [],
                                                MySQLDataTypes::relationOptions(),
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 4, 4)
                                            )
                                        ],
                                        '',
                                        [],
                                        true
                                    ),
                                    
                                ]
                            ), ProcesstonInteraction::width(12, 12, 12)),
                        ]),
                    )
                ),
                $object->toArray(),
                route('processton-app-object.edit.process')
            )
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'plural_name' => 'required',
        ]);

        $id = $request->id;
        $object = DropletObject::with('columns', 'relations')->find($id);

        $object->__set('name', $request->name);
        $object->__set('plural_name', $request->name);
        
        $object->save();

        // dd($request->all(), $object->toArray());
        $toKeep = [];

        foreach($request->columns as $column){
            
            $DropletObjectElement = DropletObjectElement::where([
                'droplet_object_id' => $object->id,
                'slug' => $column['slug']
            ]);

            $toKeep[] = $column['slug'];

            if($DropletObjectElement->count() > 0){

                $DropletObject = $DropletObjectElement->first();
                $DropletObject->__set('name', $column['name']);
                $DropletObject->__set('type', $column['type']['value']);

            } else {

                $DropletObject = DropletObjectElement::create([
                    'droplet_object_id' => $object->id,
                    'name' => $column['name'],
                    'type' => $column['type']['value']
                ]);

            }
            
            $DropletObject->__set('length', array_key_exists('length', $column) ? $column['length'] : 0);
            $DropletObject->__set('min', array_key_exists('min', $column) ? $column['min'] : 0);
            $DropletObject->__set('max', array_key_exists('max', $column) ? $column['max'] : 0);
            // $DropletObject->__set('is_required', (array_key_exists('required', $column) ? $column['required'] : 0));
            // $DropletObject->__set('collation', array_key_exists('collation', $column) ? $column['collation'] : 0););
            $DropletObject->__set('default', (array_key_exists('default', $column) ? $column['default'] : 0));
            // $DropletObject->__set('nullable', array_key_exists('nullable', $column) ? $column['nullable'] : 0););
            // $DropletObject->__set('relation_to', array_key_exists('relation_to', $column) ? $column['relation_to'] : 0););
            // $DropletObject->__set('relation_via', array_key_exists('relation_via', $column) ? $column['relation_via'] : 0););
            // $DropletObject->__set('foreign_key', array_key_exists('foreign_key', $column) ? $column['foreign_key'] : 0););
            // $DropletObject->__set('reference_key', array_key_exists('reference_key', $column) ? $column['reference_key'] : 0););
            $DropletObject->__set('comments', $column['comments']);
            $DropletObject->save();


        }

        foreach ($request->relations as $relation) {

            $DropletObjectElement = DropletObjectElement::where([
                'droplet_object_id' => $object->id,
                'slug' => $relation['slug']
            ]);

            $toKeep[] = $relation['slug'];

            if ($DropletObjectElement->count() > 0) {

                $DropletObject = $DropletObjectElement->first();
                $DropletObject->__set('name', $relation['name']);
                $DropletObject->__set('type', $relation['type']['value']);

            } else {

                $DropletObject = DropletObjectElement::create([
                    'droplet_object_id' => $object->id,
                    'name' => $relation['name'],
                    'type' => $relation['type']['value']
                ]);

            }

            // $DropletObject->__set('length', array_key_exists('length', $relation) ? $relation['length'] : 0);
            // $DropletObject->__set('min', array_key_exists('min', $relation) ? $relation['min'] : 0);
            // $DropletObject->__set('max', array_key_exists('max', $relation) ? $relation['max'] : 0);
            // $DropletObject->__set('is_required', (array_key_exists('required', $relation) ? $relation['required'] : 0));
            // $DropletObject->__set('collation', array_key_exists('collation', $relation) ? $relation['collation'] : 0));
            // $DropletObject->__set('default', (array_key_exists('default', $relation) ? $relation['default'] : 0));
            // $DropletObject->__set('nullable', array_key_exists('nullable', $relation) ? $relation['nullable'] : 0));
            $DropletObject->__set('relation_to', array_key_exists('relation_to', $relation) ? $relation['relation_to']['value'] : '');
            // $DropletObject->__set('relation_via', array_key_exists('relation_via', $relation) ? $relation['relation_via'] : 0));
            $DropletObject->__set('foreign_key', array_key_exists('foreign_key', $relation) ? $relation['foreign_key'] : 'id');
            $DropletObject->__set('reference_key', array_key_exists('reference_key', $relation) ? $relation['reference_key'] : 'id');
            // $DropletObject->__set('comments', $relation['comments']);
            $DropletObject->save();


        }

        $DropletObjectElementToBeDeleted = DropletObjectElement::where([
            'droplet_object_id' => $object->id,
        ])->whereNotIn(
            'slug', $toKeep
        );

        if($DropletObjectElementToBeDeleted->count() > 0){
            foreach($DropletObjectElementToBeDeleted->get() as $O){
                $O->delete();
            }
        }

        $object = DropletObject::find($id);

        // dd($data);
        // $object->update($data);

        return response()->json([
            'next' => [
                'type' => 'redirect',
                'action' => route('processton-client.app.interaction', [
                    'app_slug' => 'setup',
                    'interaction_slug' => 'objects'
                ])
            ],
            'message' => 'Object is updated successfully.'
        ]);
    }

        
}
