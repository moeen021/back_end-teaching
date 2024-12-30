<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Transportation extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable =
        [
            'name',
            'weight',
            'description',
            'price',
            'status',
            'quantity',
            'time_study',
        ];
}
