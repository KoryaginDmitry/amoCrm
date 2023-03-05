<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Lead
 *
 * @property int $id
 * @property int $amo_crm_id
 * @property string $name
 * @property int $responsibleUserId
 * @property int $groupId
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property int $accountId
 * @property int $pipelineId
 * @property int $statusId
 * @property int|null $closedAt
 * @property int|null $closestTaskAt
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Lead newModelQuery()
 * @method static Builder|Lead newQuery()
 * @method static Builder|Lead query()
 * @method static Builder|Lead whereAccountId($value)
 * @method static Builder|Lead whereAmoCrmId($value)
 * @method static Builder|Lead whereClosedAt($value)
 * @method static Builder|Lead whereClosestTaskAt($value)
 * @method static Builder|Lead whereCreatedAt($value)
 * @method static Builder|Lead whereCreatedBy($value)
 * @method static Builder|Lead whereGroupId($value)
 * @method static Builder|Lead whereId($value)
 * @method static Builder|Lead whereName($value)
 * @method static Builder|Lead wherePipelineId($value)
 * @method static Builder|Lead wherePrice($value)
 * @method static Builder|Lead whereResponsibleUserId($value)
 * @method static Builder|Lead whereStatusId($value)
 * @method static Builder|Lead whereUpdatedAt($value)
 * @method static Builder|Lead whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amo_crm_id',
        'name',
        'responsibleUserId',
        'groupId',
        'createdBy',
        'updatedBy',
        'createdAt',
        'updatedAt',
        'accountId',
        'pipelineId',
        'statusId',
        'closedAt',
        'closestTaskAt',
        'price'
    ];
}
