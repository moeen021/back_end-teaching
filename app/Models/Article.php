<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Article extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable =
        [
          'title',
            'slug',
            'caption',
            'author',
            'time_study',
            'url_picture',
        ];

}
