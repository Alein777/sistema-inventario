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
    Schema::create('movimientos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_producto')->constrained('productos');
        $table->foreignId('id_user')->constrained('users');
        $table->enum('tipo', ['entrada', 'salida']);
        $table->integer('cantidad');
        $table->integer('stock_anterior');
        $table->integer('stock_nuevo');
        $table->string('motivo', 255)->nullable();
        $table->timestamps();
    });
}
};
