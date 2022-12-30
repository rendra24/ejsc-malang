<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use \RouterOS\Query;
use \RouterOS\Client;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('profesi')->whereHas('profesi')->latest();
        
        $data['helper'] = new GlobalHelper;
        $data['anggotas'] = $anggota->paginate(10)->withQueryString();
        
        return view('admin.anggota.index', $data);
    }
    
}