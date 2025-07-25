<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiBerkala extends Model
{
    use HasFactory;
    protected $fillable = ['pemanen_id', 'mandor_id', 'blok', 'baris', 'arah_masuk', 'jam'];

    public function pemanen()
    {
        return $this->belongsTo(User::class, 'pemanen_id');
    }

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }
}
