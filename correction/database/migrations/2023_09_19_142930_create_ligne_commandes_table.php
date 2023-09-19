<?php

use App\Models\Commande;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("succursale_produit_id")->constrained("succursale_produits");
            $table->foreignIdFor(Commande::class);
            $table->integer('prix_vente');
            $table->integer('quantite_vendu');
            $table->softDeletes();
            $table->integer('reduction')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
