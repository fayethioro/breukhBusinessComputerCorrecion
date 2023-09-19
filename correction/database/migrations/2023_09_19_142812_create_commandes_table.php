<?php

use App\Models\Client;
use App\Models\User;
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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Client::class);
            $table->dateTime('date_commande');
            $table->integer('montant');
            $table->integer('reduction')->default(0);
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
