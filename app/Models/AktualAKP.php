<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktualAKP extends Model
{
    use HasFactory;
    protected $fillable = ['mandor_id', 'nama_blok', 'satuan_per_hektar', 'jumlah_janjang', 'total'];

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }
}
