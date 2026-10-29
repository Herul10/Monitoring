<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'guru_id',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
}