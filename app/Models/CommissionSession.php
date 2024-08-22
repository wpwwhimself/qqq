<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionSession extends Model
{
    use HasFactory;

    protected $fillable = [
        "commission_id",
        "subject",
        "description",
        "hours_spent",
        "notes",
        "ended_at",
    ];

    protected $dates = [
        "ended_at",
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
