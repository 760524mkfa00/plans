<?php

namespace Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name'];


    public function users()
    {
        return $this->belongsToMany('Plans\Models\User')->withTimestamps();
    }

}
