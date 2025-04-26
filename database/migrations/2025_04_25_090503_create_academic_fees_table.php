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
        Schema::create('academic_fees', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->foreignId('level_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('year_academic_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_fees');
    }
};
