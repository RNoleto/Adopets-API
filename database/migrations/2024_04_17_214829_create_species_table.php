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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('specie');
            $table->unsignedBigInteger('ref_id_user')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('ativo')->default(1);

            //Chave estrangeira refenciando a tabela users
            $table->foreign('ref_id_user')->references('id')->on('users')->onDelete('cascade');

            //Índices
            $table->index(['specie', 'ativo']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
