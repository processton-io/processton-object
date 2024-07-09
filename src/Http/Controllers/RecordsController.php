<?php

namespace Processton\ProcesstonObject\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Processton\ProcesstonClient\ProcesstonClient;
use Processton\ProcesstonDataTable\ProcesstonDataTable;
use Processton\ProcesstonObject\Models\DropletObject;
use Processton\ProcesstonObject\Models\DropletRecords;
use Processton\ProcesstonStatsCard\ProcesstonStatsCard;

class RecordsController extends Controller
{

    protected function _getRecordModel($slug): Model
    {
        $recordModel = new DropletRecords;

        $recordModel->setTable($slug);

        return $recordModel;
    }

    public function paginate(Request $request, $slug): JsonResponse
    {
        $object = DropletObject::where('slug', $slug)->firstOrFail();

        $data = $this->_getRecordModel($object->slug)->paginate();

        return response()->json($data);

    }
    
}
