<?php

use App\Models\Produit;
use App\Models\Succursale;
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
        Schema::create('succursale_produits', function (Blueprint $table) {
            $table->id();
            $table->integer('prix');
            $table->integer('prix_gros')->nullable();
            $table->integer('quantite');
            $table->Text('description')->nullable();
            $table->foreignIdFor(Succursale::class)->constrained();
            $table->foreignIdFor(Produit::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('succursale_produits');
    }
};
