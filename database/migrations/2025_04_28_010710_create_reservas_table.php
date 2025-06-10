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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->integer('numero_personas');
            $table->foreignId('zona_id')->constrained();
            $table->foreignId('orden_id')->nullable()->constrained('ordenes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('estado')->default('pendiente');
            $table->date('fecha');
            $table->time('hora');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
