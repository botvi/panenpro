<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrafikKepatuhan extends Model
{
    use HasFactory;
    protected $fillable = ['pemanen_id', 'mandor_id', 'keluar_buah', 'alas_karung_brondol', 'panen_blok_17', 'stampel_panen'];
    protected $appends = ['tanggal'];

    // Accessor untuk tanggal agar JavaScript bisa mengakses
    public function getTanggalAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function pemanen()
    {
        return $this->belongsTo(User::class, 'pemanen_id');
    }

    public function mandor()
    {
        return $this->belongsTo(User::class, 'mandor_id');
    }
}
