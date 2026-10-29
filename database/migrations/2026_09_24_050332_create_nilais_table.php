<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajarans')
                ->cascadeOnDelete();

            $table->decimal('nilai_tugas', 5, 2)->default(0);
            $table->decimal('nilai_uts', 5, 2)->default(0);
            $table->decimal('nilai_uas', 5, 2)->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);

            $table->string('semester')->default('Ganjil');

            $table->string('tahun_ajaran')->default('2026/2027');

            $table->timestamps();

            $table->unique([
                'siswa_id',
                'mata_pelajaran_id',
                'semester',
                'tahun_ajaran'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
