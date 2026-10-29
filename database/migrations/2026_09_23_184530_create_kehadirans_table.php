<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('kelas_id')
                ->nullable()
                ->constrained('kelas')
                ->nullOnDelete();

            $table->date('tanggal');

            $table->time('jam');

            $table->string('status');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique(['siswa_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};