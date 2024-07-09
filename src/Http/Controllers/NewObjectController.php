<?php

namespace Processton\ProcesstonObject\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Processton\ProcesstonForm\ProcesstonForm;
use Processton\ProcesstonInteraction\ProcesstonInteraction;
use Processton\ProcesstonObject\Models\DropletObject;
use Processton\ProcesstonObject\Traits\SchemaTasks\ApplyObject;

class NewObjectController extends Controller
{

    use ApplyObject;
    public function index(Request $request): JsonResponse
    {
        if ($request->method() == 'POST') {

            $requestData = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:' . DropletObject::class,
                'plural_name' => 'nullable'
            ]);

            $object = DropletObject::create([
                'name' => $requestData['name'],
                'slug' => $requestData['slug']
            ]);

            if(array_key_exists('plural_name', $requestData) && $requestData['plural_name']){
                $object->__set('plural_name', $requestData['plural_name']);
                $object->save();

            }

            $this->applyObjects([$object]);

            return response()->json([
                'next' => [
                    'type' => 'redirect',
                    'action' => route('processton-client.app.interaction', [
                        'app_slug' => 'setup',
                        'interaction_slug' => 'object-edit',
                        'id' => $object->id
                    ])
                ],
                'message' => 'Oject is created'
            ]);
        }

        return response()->json([
            'interaction' => ProcesstonInteraction::generateInteraction(
                'Dashboard',
                'dashboard',
                'Dashboard',
                'dashboard',
                [],
                [],
                [
                    ProcesstonInteraction::generateRow(
                        [
                            ProcesstonForm::generateForm(
                                '',
                                route('processton-app-object.new'),
                                ProcesstonForm::generateFormSchema(
                                    'Create Object',
                                    'create',
                                    ProcesstonForm::generateFormRows(
                                        ProcesstonForm::generateFormRow([
                                            ProcesstonForm::generateFormRowElement('Singular Label', 'text', 'name', 'Singular Label', true,
                                            'Enter the singular label of the object', [],[],'',[],'',[], false, null, ProcesstonInteraction::width(12, 6, 6)),
                                            ProcesstonForm::generateFormRowElement('Plural Name', 'text', 'plural_name', 'Plural Name', true,
                                                'Enter the plural label of the object',
                                                [],
                                                [],
                                                '',
                                                [],
                                                '',
                                                [],
                                                false,
                                                null,
                                                ProcesstonInteraction::width(12, 6, 6)),
                                            ProcesstonForm::generateFormRowElement('Slug', 'text', 'slug', 'Slug', true),
                                        ], '', '')
                                    )
                                ),
                                [],
                                [],
                                '',
                                ProcesstonInteraction::width(12, 12, 12)
                            )
                        ],
                        ProcesstonInteraction::width(12, 12, 12)
                    ),
                ]
            )
        ]);
    }
    

        
}
