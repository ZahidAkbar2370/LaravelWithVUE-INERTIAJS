<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorey extends Model
{
    use HasFactory;

    protected $table = "categoreys";

    protected $fillable = [
        "categorey_name",
    ];
}
