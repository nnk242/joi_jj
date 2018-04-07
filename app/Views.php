<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    //
    protected $table = 'views';

    public function Group() {
        return $this->hasOne(Groups::class, 'id', 'group_id');
    }
}
