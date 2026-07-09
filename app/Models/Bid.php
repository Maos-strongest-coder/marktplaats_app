<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;
    
    public function advertisment(): BelongsTo 
    {
        return $this->belongsTo(Article::class);
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}
