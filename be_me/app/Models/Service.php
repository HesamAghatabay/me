<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
    ];

    /**
     * فیلدهای چندزبانه برای ترجمه خودکار با هوش مصنوعی و Spatie.
     */
    public array $translatable = [
        'title',
        'description',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * مدیا برای حالت آپلود تصویر یا فایل SVG اختصاصی
     */
    public function iconMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
