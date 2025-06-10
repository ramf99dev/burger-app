<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('nombre', 255);
            $table->integer('numero_personas');
            $table->decimal('costo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonas');
    }
};
