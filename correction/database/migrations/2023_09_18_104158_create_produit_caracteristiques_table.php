<?php

use App\Models\Caracteristique;
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
        Schema::create('produit_caracteristiques', function (Blueprint $table) {
            $table->id();
            $table->string('valeur');
            $table->Text('description')->nullable();
            $table->foreignIdFor(Produit::class)->constrained();
            $table->foreignIdFor(Caracteristique::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_caracteristiques');
    }
};
