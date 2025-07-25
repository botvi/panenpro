<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemanen extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kode_panen', 'estate', 'npk', 'user_id', 'mandor_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mandor()
    {
        return $this->belongsTo(User::class);
    }
}
