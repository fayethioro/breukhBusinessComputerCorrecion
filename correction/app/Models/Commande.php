<?php

namespace App\Models;

use App\Models\SuccursaleProduit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Commande
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Commande newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commande newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commande query()
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $client_id
 * @property string $date_commande
 * @property int $montant
 * @property int $reduction
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\payement> $payement
 * @property-read int|null $payement_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SuccursaleProduit> $produitSuccursales
 * @property-read int|null $produit_succursales_count
 * @method static \Illuminate\Database\Eloquent\Builder|Commande onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereDateCommande($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereReduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commande withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Commande withoutTrashed()
 * @mixin \Eloquent
 */
class Commande extends Model
{

    use HasFactory; use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    public function produitSuccursales():BelongsToMany{
        return $this->belongsToMany(SuccursaleProduit::class,'ligne_commandes')->withPivot('quantite_vendu','prix_vente','reduction');
    }

    public function payement():HasMany
    {
        return $this->hasMany(Payement::class);
    }
    
}
