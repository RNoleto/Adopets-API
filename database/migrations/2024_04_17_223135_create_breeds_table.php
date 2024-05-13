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
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('breed');
            $table->unsignedBigInteger('ref_id_specie')->nullable();
            $table->unsignedBigInteger('ref_id_user')->nullable();
            $table->string('origin')->nullable();
            $table->integer('average_weight')->nullable();
            $table->integer('lifespan')->nullable();
            $table->longText('story')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('ativo')->default(1);


            //Chave estrangeira referenciando a tabela users e species
            $table->foreign('ref_id_specie')->references('id')->on('species')->onDelete('cascade');
            $table->foreign('ref_id_user')->references('id')->on('users')->onDelete('cascade');

            //Índices
            $table->index(['breed', 'ativo']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
};
