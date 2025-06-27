<?php

namespace App\Models\Api\Extra;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $fillable = ['value', 'status'];

    public static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->value = str()->random(10);
        });
    }

    public function keyable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}
