<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model
{
    use HasFactory;
    public function succursales():BelongsToMany{
        return $this->belongsToMany(Succursale::class,'succursale_produits')->withPivot('quantite','prix','prix_gros');
    }
}
