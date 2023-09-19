<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\payement
 *
 * @method static \Illuminate\Database\Eloquent\Builder|payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payement query()
 * @mixin \Eloquent
 */
class Payement extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = [];

    
}
