<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $guarded = [];

    public function tasks(){
        return $this->hasMany(Task::class, 'sprint_id');
    }
}
