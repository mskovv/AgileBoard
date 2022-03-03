<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function sprint(){
        return $this->belongsTo(Sprint::class);
    }
}
