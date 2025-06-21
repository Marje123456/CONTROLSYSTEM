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
        Schema::create('machinespayments', function (Blueprint $table) {
            $table->id();
            $table->string('code_machine', 15);           /* 
            $table->foreign('code_machine')->references('code')->on('machines'); */
            $table->float('amount', 10,2);
            $table->string('reference', 20);  
            $table->date('payment_date');
            $table->string('month_pay', 2); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machinespayments');
    }
};
