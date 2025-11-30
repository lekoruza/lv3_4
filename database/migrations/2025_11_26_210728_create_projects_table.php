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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // ZADATAK 1.2 – traženi atributi:
            $table->string('naziv');                 // naziv projekta
            $table->text('opis');                    // opis projekta
            $table->decimal('cijena', 10, 2);        // cijena projekta (npr. 12345678.90)
            $table->text('obavljeni_poslovi')
                ->nullable();                     // može biti prazan na početku
            $table->date('datum_pocetka');           // datum početka
            $table->date('datum_zavrsetka');         // datum završetka

            // + priprema za 1.3 – voditelj projekta:
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');            // korisnik koji je stvorio projekt
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
