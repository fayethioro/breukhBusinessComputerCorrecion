<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitResource;
use App\Models\Ami;
use App\Models\Produit;
use App\Models\Succursale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    public function search(string $id, string $code)
    {

        $succursaleConnecte=Succursale::find($id);
        $produit = Produit::where("code",$code)->first();
       $hisProduit= DB::table('succursale_produits')->where(['succursale_id'=>$id,"produit_id"=>$produit->id])->where('quantite','>',0)->first();
       if (!$hisProduit) {
        
           $succursaleConnecte->load([
               "amis"=>function($q) use($id) {
                   $q->where(["accepted"=>1,"from"=>$id]);
               }
           ]);
          $ids= $succursaleConnecte->amis->map(function($a){
               return $a->id;
           });
   
           $produit=Produit::with(['succursales'=>function($q) use($ids){
               $q->whereIn('succursale_id',$ids)->where('quantite',">",0)->orderBy('prix_gros',"asc");
           },'caracteristiques'])->where('code',$code)->first();
           return ProduitResource::make($produit);
       }
       $produit=Produit::with(['succursales'=>function($q) use($id){
        $q->where('succursale_id',$id);
    },'caracteristiques'])->where('code',$code)->first();
    return ProduitResource::make($produit);
    }
}
