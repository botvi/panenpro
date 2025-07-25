<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrafikKepatuhan extends Model
{
    use HasFactory;
    protected $fillable = ['pemanen_id', 'mandor_id', 'keluar_buah', 'alas_karung_brondol', 'panen_blok_17'];

    public function pemanen()
    {
        return $this->belongsTo(User::class);
    }

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }
}
