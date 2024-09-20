<?php

namespace App\Models;

use App\Enums\IsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'country_id',
        'name',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => IsActiveEnum::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', IsActiveEnum::ACTIVE);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
