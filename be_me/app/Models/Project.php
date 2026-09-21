<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'demo_url',
        'github_url',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    /**
     * فیلدهایی که در دیتابیس JSON هستند و ترجمه Spatie را فعال می‌کنند.
     */
    public array $translatable = [
        'title',
        'summary',
        'description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('sort_order');
    }

    public function primaryImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->where('is_primary', true);
    }
}
