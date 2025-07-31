<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRekapPengiriman extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'blok_id', 'no_tph', 'kode_panen', 'ripe', 'over', 'ur', 'udr', 'total', 'brd', 'bs', 'bjr', 'sph', 'akp_actual'];

    public function blok()
    {
        return $this->belongsTo(DataBlok::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
