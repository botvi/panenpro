<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAKP extends Model
{
    use HasFactory;
    protected $fillable = ['mandor_id', 'blok_id', 'satuan_per_hektar', 'jumlah_janjang', 'total'];

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }

    public function blok()
    {
        return $this->belongsTo(DataBlok::class);
    }
}
