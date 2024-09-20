<?php

namespace App\Models;

use App\Enums\IsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
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

    public function regions(): HasMany
    {
        return $this->hasMany(
            Region::class,
            'country_id',
            'id'
        );
    }

    public function districts(): HasMany
    {
        return $this->hasMany(
            District::class,
            'country_id',
            'id'
        );
    }
}
