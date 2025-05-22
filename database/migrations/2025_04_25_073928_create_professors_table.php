<?php

use App\Enums\GenderEnum;
use App\Enums\GradeProfessorEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->string('number_phone')->unique();
            $table->enum('gender', array_map(
                fn(GenderEnum $enum) => $enum->value,
                GenderEnum::cases(),
            ));
            $table->foreignId('department_id')
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
        Schema::dropIfExists('professors');
    }
};
