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
    Schema::create('proveedores', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 255);
        $table->string('contacto', 150);
        $table->string('telefono', 20);
        $table->string('email', 255)->nullable();
        $table->string('tipo', 100)->nullable();
        $table->foreignId('id_municipio')->nullable()->constrained('municipios');
        $table->tinyInteger('estado')->default(1);
        $table->timestamps();
    });
}
};
