<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBlok extends Model
{
    use HasFactory;
    protected $fillable = [
        'blok',
        'estate',
        'adfeling',
        'tt',
        'luas',
        'bjr',
        'sph',
        'jumlah_pokok',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
