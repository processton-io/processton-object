<?php

namespace Processton\ProcesstonObject\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Processton\ProcesstonObject\Constants\MySQLDataTypes;

class DropletObject extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name', 'slug'
    ];

    protected $appends = ['records_count', 'size_in_mb_of_table', 'data_length_of_table', 'index_length_of_table'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRecordsCountAttribute()
    {
        if(Schema::hasTable($this->slug)){
            return DB::table($this->slug)->count();
        }else{
            return 0;
        }
        
    }

    public function getSizeInMbOfTableAttribute(){
        $stats = $this->getStatsOfTableAttribute();
        return $stats && property_exists($stats,'SizeInMB') ? $stats->SizeInMB : 0;
    }

    public function getDataLengthOfTableAttribute(){
        $stats = $this->getStatsOfTableAttribute();
        return $stats && property_exists($stats,'DataLength') ? $stats->DataLength : 0;
    }
    public function getIndexLengthOfTableAttribute(){
        $stats = $this->getStatsOfTableAttribute();
        return $stats && property_exists($stats,'IndexLength') ? $stats->IndexLength : 0;
    }

    public function getStatsOfTableAttribute(){
          
        return DB::table('information_schema.TABLES')
            ->select(['data_length as DataLength','index_length as IndexLength','TABLE_SCHEMA as DatabaseName'])
            ->where('TABLE_NAME','=', $this->slug)
            ->where('TABLE_SCHEMA','=', DB::connection()->getDatabaseName())
            ->get()
            ->map(function($eachDatabse){
              $dataIndex = $eachDatabse->DataLength + $eachDatabse->IndexLength;

                $modifiedObject = new \StdClass;
                $kbSize = ($dataIndex/1024);
                $mbSize = ($kbSize/1024);
                $modifiedObject->SizeInKb = $kbSize;
                $modifiedObject->SizeInMB = $mbSize;

                return (object)array_merge((array)$eachDatabse,(array)$modifiedObject);
            })->first();
    }

    
    public function columns(){
        return $this->hasMany(DropletObjectElement::class,'droplet_object_id')->whereIn('type',collect(
            MySQLDataTypes::options()
        )->pluck('value')->toArray());
    }
    public function relations(){
        return $this->hasMany(DropletObjectElement::class,'droplet_object_id')->whereIn('type', collect(
            MySQLDataTypes::relationOptions()
        )->pluck('value')->toArray());
    }
}
