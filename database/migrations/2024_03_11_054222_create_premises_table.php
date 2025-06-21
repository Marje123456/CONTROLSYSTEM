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
        Schema::create('premises', function (Blueprint $table) {
            $table->id();
            $table->string('idc', 15);           
            $table->foreign('idc')->references('idc')->on('responsibles');
            $table->string('ident', 50)->unique();
            $table->string('rut', 50)->unique();
            $table->string('patent',50)->unique()->nullable();
            $table->string('address', 50)->nullable();
            $table->string('email',50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premises');
    }
};
