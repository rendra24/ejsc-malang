<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalAnggotaKuisioner extends Model
{
    use HasFactory;
    protected $table = 'total_anggota_kuisioner';
    protected $guarded = ['id'];

    public function kuisioner(){
        return $this->belongsTo(Kuisioner::class);
    }
}