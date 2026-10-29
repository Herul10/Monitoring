<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'kelas_id',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kehadiran(): HasMany
    {
        return $this->hasMany(Kehadiran::class);
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}