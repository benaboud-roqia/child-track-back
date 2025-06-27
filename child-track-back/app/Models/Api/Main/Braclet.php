<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Model;

class Braclet extends Model
{
    protected $fillable = ['mac', 'status' ,'children_id'];
    public function children(){
        return $this->belongsTo(Children::class);
    }
    public function location(){
        return $this->morphOne(Location::class, 'locationable');
    }

    public function circle(){
        return $this->hasOne(Circle::class);
    }
}
