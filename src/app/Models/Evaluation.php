<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
