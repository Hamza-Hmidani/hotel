<?php

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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_client')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_chambre')->constrained('chambres')->onDelete('cascade');
            $table->date('date_arrivee');
            $table->date('date_depart');
            $table->enum('statut', ['confirmée', 'annulée', 'en attente'])->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
