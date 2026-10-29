<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasSistem extends Model
{
    protected $table = 'aktivitas_sistems';

    protected $fillable = [
        'user_id',
        'nama_pengguna',
        'aktivitas',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}