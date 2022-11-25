<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tujuan';
    protected $guarded = ['id'];
    
}