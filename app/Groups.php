<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Groups extends Model
{
    protected $table = 'groups';
    public function Image() {
        return $this->hasMany(Images::class, 'group_id', 'id');
    }
    public function Region() {
        return $this->belongsTo(Regions::class, 'region_id', 'id');
    }

    public function Type() {
        return $this->belongsTo(Types::class, 'type_id', 'id');
    }
}