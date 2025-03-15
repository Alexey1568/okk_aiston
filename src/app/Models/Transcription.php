<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcription extends Model
{
    public $guarded = [];
    protected $table = 'transcriptions';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
