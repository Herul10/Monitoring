<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kehadiran extends Model
{
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tanggal',
        'jam',
        'status',
        'latitude',
        'longitude',
        'keterangan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}