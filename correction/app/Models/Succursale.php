<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Builder;

// use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Query\Builder;

// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Succursale
 *
 * @property int $id
 * @property string $nom
 * @property string $adresse
 * @property string $telephone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SuccursaleFactory factory($count = null, $state = [])
 * @method static Builder|Succursale myFriends($id)
 * @method static Builder|Succursale newModelQuery()
 * @method static Builder|Succursale newQuery()
 * @method static Builder|Succursale others($id)
 * @method static Builder|Succursale query()
 * @method static Builder|Succursale wait($id)
 * @method static Builder|Succursale whereAdresse($value)
 * @method static Builder|Succursale whereCreatedAt($value)
 * @method static Builder|Succursale whereId($value)
 * @method static Builder|Succursale whereNom($value)
 * @method static Builder|Succursale whereTelephone($value)
 * @method static Builder|Succursale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Succursale extends Model
{
    use HasFactory;
    // public function amis():BelongsToMany{
    //     return $this->belongsToMany(Succursale::class,'amis',"from","to")->withPivot('accepted');
    // }

    public static function mesAmis($id)
    {
        return  DB::table('amis')->where('accepted', 1)
            ->where('from', $id)
            ->orWhere('to', $id)
            ->get();
    }

    public function scopeMyFriends(Builder $builder , $id){

        return  $builder->from('amis')->where('accepted' , 1)
        ->where('from', $id)
        ->orWhere('to', $id)
        ->get();
    }
    public function scopeWait(Builder $builder , $id){

        return  $builder->from('amis')->where(['accepted' => 0 , 'to' => $id])->get();
    }

    public function scopeOthers(Builder $builder , $id){
        $mesAmis = $this->mesAmis($id)->pluck('id');
        return $builder->from('succursales')->whereNotIn('id' , $mesAmis);
    }
}
