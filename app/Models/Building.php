<?php

namespace Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    protected $fillable = ['building_name', 'street','town','postal','province','country','description','telephone','building_type'];

    public function plans()
    {
        return $this->hasMany('Plans\Models\Plan');
    }

    public function pictures()
    {
        return $this->hasMany('Plans\Models\Picture');
    }
}
