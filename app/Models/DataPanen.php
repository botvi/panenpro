<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPanen extends Model
{
    use HasFactory;
    protected $fillable = ['pemanen_id', 'blok_id', 'no_tph', 'ripe', 'over_ripe', 'under_ripe', 'eb', 'brondolan', 'jumlah_buah_per_blok'];

    public function pemanen()
    {
        return $this->belongsTo(User::class);
    }

    public function blok()
    {
        return $this->belongsTo(DataBlok::class);
    }
}
