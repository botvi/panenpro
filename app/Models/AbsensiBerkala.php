<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiBerkala extends Model
{
    use HasFactory;
    protected $fillable = ['pemanen_id', 'mandor_id', 'blok_id', 'baris', 'arah_masuk', 'jam', 'luasan'];

    public function pemanen()
    {
        return $this->belongsTo(User::class, 'pemanen_id');
    }

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }
    
    public function blok()
    {
        return $this->belongsTo(DataBlok::class);
    }
}
