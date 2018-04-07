<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    //
    protected $table = 'regions';

    public function Continent() {
        return $this->belongsTo(Types::class, 'continent_id', 'id');
    }
}
