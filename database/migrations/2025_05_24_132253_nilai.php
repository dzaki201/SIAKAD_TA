<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nilai');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');;
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');;
            $table->foreignId('capaian_pembelajaran_id')->constrained('capaian_pembelajaran')->onDelete('cascade');;
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
