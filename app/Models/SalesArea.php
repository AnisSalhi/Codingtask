<?php

namespace App\Models;

use App\Models\PostalCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesArea extends Model
{
    use HasFactory;
    public function salesGuy()
    {
        return $this->belongsTo(User::class);
    }
    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class);
    }
}
