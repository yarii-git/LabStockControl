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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cas_code');
            $table->float('concentration');
            $table->enum('concentration_type', ['%', 'mols']);
            $table->float('capacity');
            $table->date('expiration_date');
            $table->string('locker');
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('cas_code')->references('cas_code')->on('cascodes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
