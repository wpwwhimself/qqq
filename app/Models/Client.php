<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_name",
        "representative_name",
        "email",
        "phone",
    ];

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
