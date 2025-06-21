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
        Schema::create('auditmachines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15);/*machine*/
            $table->string('ident', 50);/*premise*/
            $table->string('idc', 15); /*prosecutor*/
            $table->date('audit_date');
            $table->string('note', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditmachines');
    }
};
