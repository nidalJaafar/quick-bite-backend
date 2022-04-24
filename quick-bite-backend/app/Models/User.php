<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function itemFeedbacks(): HasMany
    {
        return $this->hasMany(ItemFeedback::class);
    }

    public function visitFeedback(): HasOne
    {
        return $this->hasOne(VisitFeedback::class);
    }
}
