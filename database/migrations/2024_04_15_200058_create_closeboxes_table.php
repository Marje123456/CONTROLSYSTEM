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
        Schema::create('closeboxes', function (Blueprint $table) {
            $table->id();
            $table->date('close_date')->nullable();
            $table->string('userbox', 50)->nullable();
            $table->float('total_cash', 10,2)->nullable();
            $table->float('total_trans', 10,2)->nullable();
            $table->float('total_qr', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closeboxes');
    }
};
