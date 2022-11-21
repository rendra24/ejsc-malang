<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function profesi(){
        return $this->belongsTo(Profesi::class);
    }
}