<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "categorey_id",
        "product_name",
        "price",
        "description",
    ];

    public function categorey()
    {
        return $this->belongsTo("App\Models\Categorey", "categorey_id", "id");
    }
}
