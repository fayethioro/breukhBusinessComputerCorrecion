<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Payement;
use App\Models\SuccursaleProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Request;

class CommandeController extends Controller
{
   public function store(Request $request){
    
    $commande = Commande::create([
        'date_commande' => now(),
        "montant"=>$request->montant,
        "reduction"=>$request->reduction,
        "user_id"=>$request->user_id,
        "client_id"=>$request->client_id
    ]);
    $commande->produitSuccursales()->attach($request->produits);
    $payement=Payement::create([
        "date_paiement"=>now(),
        "montant_payer"=>$request->montant_payer,
        "commande_id"=>$commande->id
    ]);
    foreach($request->produits as $produit )
    {      
        // $update=SuccursaleProduit::find($produit->succursale_produit_id);
        // $update->update(["quantite"=>$update->quantite - $produit->quantite_vendu]);
         DB::statement("UPDATE succursale_produits set quantite = quantite -$produit[quantite_vendu] where id =$produit[succursale_produit_id]");
    }
    return response()->json([
        "data"=>$commande,
    ]);
   }
}
