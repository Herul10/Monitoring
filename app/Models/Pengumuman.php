<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    protected $table = 'pengumumen';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'tanggal_publikasi',
        'is_published',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Admin yang membuat pengumuman.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}