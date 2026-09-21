<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Experience extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'role',
        'company',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'sort_order',
    ];

    /**
     * فیلدهای چندزبانه برای ترجمه خودکار با هوش مصنوعی و Spatie.
     */
    public array $translatable = [
        'role',
        'company',
        'employment_type',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];
}
