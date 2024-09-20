<?php

namespace App\Models;

use App\Enums\IsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'country_id',
        'region_id',
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

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public static function cached()
    {
        return collect(Cache::remember('districts', (60 * 60), function () {
            return District::all(['name', 'code']);
        }));
    }
}
