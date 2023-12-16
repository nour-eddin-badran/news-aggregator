<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'handler', 'is_active'
    ];

    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }

    public function scopeActive($query)
    {
        $query->whereIsActive(1);
    }
}
