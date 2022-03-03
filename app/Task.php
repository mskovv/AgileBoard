<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function sprint(){
        return $this->belongsTo(Sprint::class, 'sprintId', 'sprintId');
    }
}
