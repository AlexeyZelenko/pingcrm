<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    /**
     * Массив атрибутов, которые могут быть массово назначены.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category',
        'language',
        'youtube_links',
        'note',
        'description',
        'blocks',
        'seen',
    ];

    /**
     * Массив атрибутов, которые автоматически должны быть приведены к нужному типу.
     *
     * @var array
     */
    protected $casts = [
        'youtube_links' => 'array',  // Для корректного преобразования JSON в массив
        'blocks' => 'array',         // Для корректного преобразования JSON в массив
        'seen' => 'boolean',         // Для приведения значения seen к типу boolean
    ];
}
