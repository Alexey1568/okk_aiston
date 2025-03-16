<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $guarded = [];
    protected $table = 'tasks';

    public function transcriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transcription::class);
    }

    public function evaluation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Evaluation::class);
    }
}
