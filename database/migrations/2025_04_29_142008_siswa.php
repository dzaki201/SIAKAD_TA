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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('nis',10)->unique();
            $table->string('nisn',20)->unique();
            $table->string('tempat_lahir',50);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',10);
            $table->string('agama',15);
            $table->string('sekolah_asal',100);
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
