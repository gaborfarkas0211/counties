<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\County
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @method static Builder|County newModelQuery()
 * @method static Builder|County newQuery()
 * @method static Builder|County query()
 * @method static Builder|County whereCreatedAt($value)
 * @method static Builder|County whereId($value)
 * @method static Builder|County whereName($value)
 * @method static Builder|County whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class County extends Model
{
    use HasFactory;

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public static function getOrderedCounties(): Collection
    {
        return Cache::remember('counties', 60 * 60, fn() => self::query()
            ->orderBy('name')
            ->get());
    }
}
