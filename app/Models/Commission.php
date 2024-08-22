<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "commission_status_id",
        "name",
        "description",
        "price_id",
        "notes",
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function status()
    {
        return $this->belongsTo(CommissionStatus::class);
    }
    public function sessions()
    {
        return $this->hasMany(CommissionSession::class);
    }
    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
