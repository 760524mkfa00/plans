<?php

namespace Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{


    public function listFloors()
    {

        $data = \Cache::remember('floors', 60, function () {
            return Floor::orderBy('name', 'asc')->get();
        });
        return array_prepend(array_pluck($data, 'name', 'id'), 'Please Select Floor', 0);

    }


}
