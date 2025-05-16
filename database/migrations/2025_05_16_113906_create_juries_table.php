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
        Schema::create('juries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('year_academic_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('jury_professor', function (Blueprint $table) {
            $table->foreignId('professor_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('jury_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->primary(['jury_id', 'professor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juries');
    }
};
