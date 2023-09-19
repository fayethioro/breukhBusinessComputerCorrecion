<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ami
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property int $accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ami newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ami newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ami query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ami whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ami extends Model
{
    use HasFactory;
}
