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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 250);
        $table->text('detalle');
        $table->string('imagen', 255)->default('default.jpg');
        $table->decimal('precio_compra', 10, 2);
        $table->decimal('precio_venta', 10, 2);
        $table->integer('stock')->default(0);
        $table->integer('stock_minimo')->default(5);
        $table->foreignId('id_categoria')->constrained('categorias');
        $table->foreignId('id_proveedor')->constrained('proveedores');
        $table->tinyInteger('estado')->default(1);
        $table->timestamps();
    });
}
};
