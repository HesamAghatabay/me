<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Media extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'alt_text',
        'is_primary',
        'sort_order',
    ];

    /**
     * فیلدهای چندزبانه برای پشتیبانی از سئو در هر دو زبان
     */
    public array $translatable = [
        'alt_text',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
        'file_size' => 'integer',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
