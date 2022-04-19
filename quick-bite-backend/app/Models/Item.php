<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function itemFeedbacks(): HasMany
    {
        return $this->hasMany(ItemFeedback::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
