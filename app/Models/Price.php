<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "client_id",
        "price_type_id",
        "price",
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function type()
    {
        return $this->belongsTo(PriceType::class);
    }
}
