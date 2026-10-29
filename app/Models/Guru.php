<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'mata_pelajaran',
    ];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
