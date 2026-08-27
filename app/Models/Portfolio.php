<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public const CATEGORIES = ['Web Applications', 'Apps', 'HTML', 'Softwares'];

    protected $fillable = [
        'title',
        'description',
        'technologies',
        'category',
        'photo',
        'detail_photo',
        'website_url',
    ];

    protected $casts = [
        'technologies' => 'array',
    ];
}
