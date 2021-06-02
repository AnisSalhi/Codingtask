<?php

namespace App\Models;

use App\Models\SalesArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostalCode extends Model
{
    use HasFactory;
    public function salesArea()
    {
        return $this->belongsTo(SalesArea::class);
    }
}
