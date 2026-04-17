<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'id_user',
        'klasifikasi',
        'judul',
        'isi_laporan',
        'foto',
        'tanggal_kejadian',
        'status',
        'is_anonim',
        'tanggal_lapor',
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
        'is_anonim' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class);
    }
}
