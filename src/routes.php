<?php
use Processton\ProcesstonObject\Http\Controllers\NewObjectController;
use Processton\ProcesstonObject\Http\Controllers\ObjectEditController;
use Processton\ProcesstonObject\Http\Controllers\ObjectsController;
use Processton\ProcesstonObject\Http\Controllers\RecordsController;

Route::middleware([
    'web'
])->group(function () {

    Route::get('/list', [ObjectsController::class, 'index'])->name('processton-app-object.index');
    Route::get('/stats/count', [ObjectsController::class, 'objectsCount'])->name('processton-app-object.count');
    Route::get('/stats/record-count', [ObjectsController::class, 'recordsCounts'])->name('processton-app-object.record-count');
    Route::get('/stats/size-in-mb', [ObjectsController::class, 'sizeInMB'])->name('processton-app-object.size-in-mb');
    Route::get('/stats/size-data-length', [ObjectsController::class, 'dataLengthOfTable'])->name('processton-app-object.size-data-length');
    Route::get('/stats/size-index-length', [ObjectsController::class, 'indexLengthOfTable'])->name('processton-app-object.size-index-length');


    Route::any('/new', [NewObjectController::class, 'index'])->name('processton-app-object.new');
    Route::get('/edit', [ObjectEditController::class, 'index'])->name('processton-app-object.edit');
    Route::post('/edit', [ObjectEditController::class, 'store'])->name('processton-app-object.edit.process');
    
    Route::get('/records/{slug}', [RecordsController::class, 'paginate'])->name('processton-app-object.records.paginate');
    
});


Route::middleware([
    'api'
])->group(function () {

    Route::get('/records/{slug}', [RecordsController::class, 'paginate'])->name('processton-app-object.records.api.paginate');
    
    
});