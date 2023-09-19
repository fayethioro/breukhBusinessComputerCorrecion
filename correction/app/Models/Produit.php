<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Produit
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $photo
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Caracteristique> $caracteristiques
 * @property-read int|null $caracteristiques_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Succursale> $succursales
 * @property-read int|null $succursales_count
 * @method static \Database\Factories\ProduitFactory factory($count = null, $state = [])
 * @method static Builder|Produit newModelQuery()
 * @method static Builder|Produit newQuery()
 * @method static Builder|Produit quantitePositive($ids, $limit, $code)
 * @method static Builder|Produit query()
 * @method static Builder|Produit whereCode($value)
 * @method static Builder|Produit whereCreatedAt($value)
 * @method static Builder|Produit whereId($value)
 * @method static Builder|Produit whereLibelle($value)
 * @method static Builder|Produit wherePhoto($value)
 * @method static Builder|Produit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Produit extends Model
{
    use HasFactory;
    public function succursales():BelongsToMany{
        return $this->belongsToMany(Succursale::class,'succursale_produits')->withPivot('quantite','prix','prix_gros');
    }
    public function caracteristiques():BelongsToMany{
        return $this->belongsToMany(Caracteristique::class,'produit_caracteristiques')->withPivot('valeur','description');
    }

    public function scopeQuantitePositive(Builder $builder , $ids , $limit , $code):Builder {
       return  $builder->with(['succursales' => function ($q) use ($ids, $limit) {
            $q->whereIn('succursale_id', $ids)->where('quantite', ">", 0)->orderBy('prix_gros', "asc")
                ->when($limit, fn ($q) => $q->limit($limit));
        }, 'caracteristiques'])->where('code', $code);
    }
}
