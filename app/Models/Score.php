<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tim1',
        'id_tim2',
        'skor_tim1',
        'skor_tim2',
        
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'foreign_key');
    }
}
