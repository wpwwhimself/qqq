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
    protected $appends = [
        "month",
    ];

    protected function casts(): array 
    {
        return [
            "ended_at" => "datetime:Y-m-d H:i",
        ];
    }

    public function getMonthAttribute(): string
    {
        return substr($this->created_at, 0, 7);
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
