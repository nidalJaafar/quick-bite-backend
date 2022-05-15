<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitFeedback extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $table = 'visit_feedbacks';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
