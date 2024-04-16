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
        Schema::create('documento_baixa_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40);
            $table->enum('natureza', ['C,D']);
            $table->boolean('ativo')->default(true);
            $table->string('notas')->nullable();

            // Data de criação e de edição.
            $table->timestamps();
            // Recurso SoftDelete = excluir p/ lixeira.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_baixa_tipos');
    }
};
