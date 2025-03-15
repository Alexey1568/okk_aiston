<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $guarded = [];
    protected $table = 'tasks';

    public function transcriptions()
    {
        return $this->hasMany(Transcription::class);
    }
}
