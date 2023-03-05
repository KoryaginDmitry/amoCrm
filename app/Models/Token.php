<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Token
 *
 * @property string $hash
 * @property string $accessToken
 * @property string $refreshToken
 * @property string $expires
 * @property string $values
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Token newModelQuery()
 * @method static Builder|Token newQuery()
 * @method static Builder|Token query()
 * @method static Builder|Token whereAccessToken($value)
 * @method static Builder|Token whereCreatedAt($value)
 * @method static Builder|Token whereExpires($value)
 * @method static Builder|Token whereHash($value)
 * @method static Builder|Token whereId($value)
 * @method static Builder|Token whereRefreshToken($value)
 * @method static Builder|Token whereUpdatedAt($value)
 * @method static Builder|Token whereValues($value)
 * @mixin Eloquent
 */
class Token extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hash',
        'accessToken',
        'refreshToken',
        'expires',
        'values',
    ];
}
