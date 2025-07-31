<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandor extends Model
{
    use HasFactory;
    protected $fillable = [
        'asisten_id',
        'nama',
        'npk',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
