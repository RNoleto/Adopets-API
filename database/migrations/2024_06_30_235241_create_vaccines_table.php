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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('ref_id_animal')->nullable();
            $table->timestamp('deleted_at')->nullable();

            //Referencias
            $table->foreign('ref_id_animal')->references('id')->on('animals')->onDelete('cascade');

            $table->index(['name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
