<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    use HasFactory;
    protected $table = 'aktifitas';
    protected $guarded = ['id'];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }
}