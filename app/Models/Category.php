<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the companies that belong to this category.
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Scope to get only active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the category's display color with fallback.
     */
    public function getDisplayColorAttribute(): string
    {
        return $this->color ?: '#3B82F6';
    }

    /**
     * Get the number of companies using this category.
     */
    public function getCompanyCountAttribute(): int
    {
        return $this->companies()->count();
    }
}
