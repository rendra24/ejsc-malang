<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaSkm extends Model
{
    use HasFactory;
    protected $table = 'anggota_skm';
    protected $guarded = ['id'];

    public function tujuan(){
        return $this->belongsTo(Tujuan::class);
    }

    public function anggota_kuisioner(){
        return $this->hasMany(AnggotaKuisioner::class);
    }
}