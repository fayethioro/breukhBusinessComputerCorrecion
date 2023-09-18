<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Produit;
use App\Models\Succursale;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function search(string $id, string $code)
    {
        $amis=Succursale::find($id);
        $amis->load([
            "amis"=>function($q) use($id) {
                $q->where(["accepted"=>1,"from"=>$id]);
            }
        ]);
       $ids= $amis->amis->map(function($a){
            return $a->id;
        });

        $produit=Produit::with(['succursales'=>function($q) use($ids){
            $q->whereIn('succursale_id',$ids);
        }])->where('code',$code)->first();
        return response($produit);
    }
}
