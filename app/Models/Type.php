<?php

namespace Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    public function listTypes()
    {

        $data = \Cache::remember('types', 60, function () {
            return Type::orderBy('name', 'asc')->get();
        });
        return array_prepend(array_pluck($data, 'name', 'id'), 'Please Select Type', 0);

    }
}
