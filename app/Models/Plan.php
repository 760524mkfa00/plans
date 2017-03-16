<?php

namespace Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = ['floor_id', 'name', 'path', 'filename', 'file_type', 'type_id'];


    public function building()
    {
        return $this->belongsTo('Plans\Models\Building', 'building_id');
    }

    Public function floors()
    {
        return $this->belongsTo('Plans\Models\Floor', 'floor_id');
    }

    Public function types()
    {
        return $this->belongsTo('Plans\models\Type', 'type_id');
    }

    public function download()
    {
        $plan = new Static;

        return $plan->fill([
            'path' => storage_path() . '/' . $this->path,
            'name' => $this->filename
        ]);

    }

}
