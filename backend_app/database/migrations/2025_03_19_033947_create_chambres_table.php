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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->foreignId('type_chambre_id')->constrained('types_chambres')->onDelete('cascade');
            $table->boolean('climatisation')->default(false);
            $table->boolean('repas')->default(false);
            $table->integer('nombre_lits');
            $table->decimal('frais_annulation', 8, 2)->default(0);
            $table->decimal('tarif', 8, 2);
            $table->string('numero_telephone')->nullable();
            $table->string('fichier_upload')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
