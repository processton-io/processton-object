<?php

namespace Processton\ProcesstonObject\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Processton\ProcesstonClient\ProcesstonClient;
use Processton\ProcesstonDataTable\ProcesstonDataTable;
use Processton\ProcesstonObject\Models\DropletObject;
use Processton\ProcesstonStatsCard\ProcesstonStatsCard;

class ObjectsController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $data = DropletObject::paginate();
        return response()->json([
            'data' => ProcesstonDataTable::generateDataTableData([
                [
                    'value' => 'name',
                    'label' => 'Name'
                ],
                [
                    'value' => 'slug',
                    'label' => 'Record ID'
                ],
                [
                    'value' => 'size_in_mb_of_table',
                    'label' => 'Size in MB'
                ],
                [
                    'value' => 'data_length_of_table',
                    'label' => 'Data Length'
                ],
                [
                    'value' => 'index_length_of_table',
                    'label' => 'Index Length'
                ]
            ],$data, true, true, true,[],[],[
                [
                    'type' => 'link',
                    'label' => 'Edit',
                    'action' => route('processton-client.app.interaction',[
                        'app_slug' => 'setup',
                        'interaction_slug' => 'object-edit'
                    ]),
                    'attachments' => [
                        [
                            'key' => 'id',
                            'value' => 'id' 
                        ]
                    ]
                ]
            ])
        ]);
    }

    

    public function objectsCount(Request $request): JsonResponse
    {
        // DropletObject Infinite Scroll
        
        $data = DropletObject::paginate();
        return response()->json([
            'data' => ProcesstonStatsCard::generateStatsCardData(
                'Objects',
                $data->total(),
                false,
                ''
            )
        ]);
    }

    public function recordsCounts(Request $request): JsonResponse
    {
        // DropletObject Infinite Scroll
        
        $data = DropletObject::all();

        return response()->json([
            'data' => ProcesstonStatsCard::generateStatsCardData(
                'Objects',
                $data->sum('records_count'),
                false,
                ''
            )
        ]);
    }
    public function sizeInMB(Request $request): JsonResponse
    {
        // DropletObject Infinite Scroll
        
        $data = DropletObject::all();

        return response()->json([
            'data' => ProcesstonStatsCard::generateStatsCardData(
                'Objects',
                $data->sum('size_in_mb_of_table'),
                false,
                ''
            )
        ]);
    }
    public function dataLengthOfTable(Request $request): JsonResponse
    {
        // DropletObject Infinite Scroll
        
        $data = DropletObject::all();

        return response()->json([
            'data' => ProcesstonStatsCard::generateStatsCardData(
                'Objects',
                $data->sum('data_length_of_table'),
                false,
                ''
            )
        ]);
    }
    public function indexLengthOfTable(Request $request): JsonResponse
    {
        // DropletObject Infinite Scroll
        
        $data = DropletObject::all();

        return response()->json([
            'data' => ProcesstonStatsCard::generateStatsCardData(
                'Objects',
                $data->sum('index_length_of_table'),
                false,
                ''
            )
        ]);
    }
    
}
