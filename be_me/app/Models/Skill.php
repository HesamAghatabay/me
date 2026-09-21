<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name',
        'category',
        'icon',       // نام آیکون متریال/کوازار در صورت استفاده از ستون متنی
        'in_ticker',
        'sort_order',
    ];

    /**
     * فیلدهایی که دارای ترجمه JSON هستند.
     * با پکیج Spatie، ذخیره‌سازی و بازیابی چندزبانه روی این ستون‌ها خودکار است.
     */
    public array $translatable = [
        'name',
        'category', // اگر می‌خواهی دسته‌بندی هم توسط هوش مصنوعی ترجمه شود
    ];

    protected $casts = [
        'in_ticker' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * در صورتی که برای اسکیل فایل SVG/PNG به عنوان مدیا آپلود شود.
     */
    public function iconMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
