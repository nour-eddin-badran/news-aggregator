<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class);
    }

    public function scopeActive($query)
    {
        $query->whereRelation('sources', 'is_active', 1);
    }
}
