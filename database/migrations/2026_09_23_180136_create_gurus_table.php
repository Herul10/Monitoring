<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {

        $table->id();

        $table->string('nip')->unique();

        $table->string('nama');

        $table->string('jenis_kelamin');

        $table->string('tempat_lahir')->nullable();

        $table->date('tanggal_lahir')->nullable();

        $table->text('alamat')->nullable();

        $table->string('no_hp')->nullable();

        $table->string('mata_pelajaran')->nullable();

        $table->timestamps();

        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
