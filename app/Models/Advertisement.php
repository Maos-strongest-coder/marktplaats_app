<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'category_id',
        'price',
        'is_promoted',
        'is_active',
    ];
    
    public function category(): BelongsTo 
    {
        return $this->belongsTo(Category::class);
    }

    public function bids(): HasMany 
    {
        return $this->hasMany(Bid::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
