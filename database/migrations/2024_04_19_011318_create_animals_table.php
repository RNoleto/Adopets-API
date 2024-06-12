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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0); // 0: Com Dono / Indisponível
            $table->string('name')->nullable();
            $table->char('gender');
            $table->date('birth')->nullable();
            $table->unsignedBigInteger('ref_id_specie')->nullable();
            $table->unsignedBigInteger('ref_id_breed')->nullable();
            $table->unsignedBigInteger('ref_id_user')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('ativo')->default(1);

            // Chave estrangeira referenciando a tabela users, especies e breeds
            $table->foreign('ref_id_specie')->references('id')->on('species')->onDelete('cascade');
            $table->foreign('ref_id_breed')->references('id')->on('breeds')->onDelete('cascade');
            $table->foreign('ref_id_user')->references('id')->on('users')->onDelete('cascade');

            // Índices corrigidos
            $table->index(['name', 'ativo']); // Índice composto corrigido

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
