<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CountyCity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CountyCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CountyCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CountyCity query()
 * @mixin \Eloquent
 */
class CountyCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'county_id',
        'name',
    ];

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }
}
