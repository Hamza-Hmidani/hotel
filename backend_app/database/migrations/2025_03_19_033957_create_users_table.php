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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mot_de_passe');
            $table->enum('role', ['admin', 'employe', 'client'])->default('client');
            $table->string('numero_telephone')->nullable();
            $table->date('date_arrivee')->nullable();
            $table->date('date_depart')->nullable();
            $table->string('statut')->nullable();
            $table->string('message')->nullable();
            $table->string('fichier_upload')->nullable();
            $table->string('departement')->nullable();
            $table->string('poste')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('id_chambre')->nullable()->constrained('chambres')->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
