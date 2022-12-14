<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKuisioner extends Model
{
    use HasFactory;
    protected $table = 'anggota_kuisioner';
    protected $guarded = ['id'];

    public function kuisioner()
    {
        return $this->belongsTo(Kuisioner::class);
    }
}