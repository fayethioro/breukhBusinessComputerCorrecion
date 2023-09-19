<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitResource;
use App\Models\Ami;
use App\Models\Produit;
use App\Models\Succursale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

// use Response;

class ProduitController extends Controller
{
    public function search(string $id, string $code)
    {


        $limit = request()->query('limit');

        $produit = Produit::where("code", $code)->first();
        if (!$produit) {
            return response(["message" => "code introuvable"], Response::HTTP_NOT_FOUND);
        }
        $hisProduit = DB::table('succursale_produits')->where(['succursale_id' => $id, "produit_id" => $produit->id])->where('quantite', '>', 0)->first();
        if (!$hisProduit) {
            $ids = Succursale::myFriends($id)->map(function ($a) {
                return $a->id;
            });
            
            // $produit = Produit::with(['succursales' => function ($q) use ($ids, $limit) {
            //     $q->whereIn('succursale_id', $ids)->where('quantite', ">", 0)->orderBy('prix_gros', "asc")
            //         ->when($limit, fn ($q) => $q->limit($limit));
            // }, 'caracteristiques'])->where('code', $code)->first();
            
            $produit = Produit::quantitePositive($ids,$limit , $code)->first();
            return ProduitResource::make($produit);
        }
        $produit = Produit::with(['succursales' => function ($q) use ($id) {
            $q->where('succursale_id', $id);
        }, 'caracteristiques'])->where('code', $code)->first();
        return ProduitResource::make($produit);
    }

  
}
