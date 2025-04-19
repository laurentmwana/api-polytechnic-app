<?php

use App\Models\ProgrammeGroup;
use App\Enum\ProgrammeGroupEnum;
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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->enum('programme_group', array_map(
                fn(ProgrammeGroupEnum $enum) => $enum->value,
                ProgrammeGroupEnum::cases(),
            ));
            $table->timestamps();
        });

        Schema::table('levels', function (Blueprint $table) {
            $table->foreignId('programme_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
