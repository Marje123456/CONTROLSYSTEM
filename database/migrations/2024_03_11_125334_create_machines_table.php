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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('premise_ident', 15);           
            $table->foreign('premise_ident')->references('ident')->on('premises');
            $table->string('code', 15)->unique();
            $table->string('model', 50)->nullable();
            $table->string('brand', 50)->nullable();
            $table->string('seriale', 15)->unique();
            $table->timestamp('registration_date')->useCurrent();
            $table->date('activation_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('active_status', 1)->default(0);
            $table->string('debit_status', 1)->default(0);
            $table->string('penalty_status', 1)->default(0);
            $table->string('forfeiture_status', 1)->default(0);
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
        Schema::dropIfExists('machines');
    }
};
