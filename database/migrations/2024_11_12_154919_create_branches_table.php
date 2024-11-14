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
        Schema::create('branches', function (Blueprint $table) {
            $table->id(); // Clave primaria auto incremental
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Relación con customers (asumiendo que tienes una tabla customers)
            $table->string('branch_name'); // Nombre de la sucursal
            $table->string('address'); // Dirección de la sucursal
            $table->decimal('latitude', 10, 7)->nullable(); // Latitud de la sucursal (puede ser nullable si no se tienen coordenadas)
            $table->decimal('longitude', 10, 7)->nullable(); // Longitud de la sucursal (puede ser nullable)
            $table->string('any_desk')->nullable(); // Campo AnyDesk
            $table->timestamps(); // Registra created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
