<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccursaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "nom"=>$this->nom,
            "adresse"=>$this->adresse,
            "telephone"=>$this->telephone,
            "prix"=>$this->pivot->prix,
            "prix_gros"=>$this->pivot->prix_gros,
            "quantite"=>$this->pivot->quantite

        ];
    }
}
