<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\Anggota;
use App\Models\AnggotaSkm;
use App\Models\Profesi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $total_anggota = Anggota::all()->count();
        $total_skm = AnggotaSkm::all()->count();
        $total_pengunjung = Aktifitas::all()->count();

        $get_profesi = Aktifitas::with('anggota')->whereHas('anggota')->get()->groupBy('anggota.profesi_id');

        $get = $get_profesi->toArray();
        $array_profesi = array_keys($get);
        $data = [];
        foreach($array_profesi as $value){
            $get_profesi = Profesi::where('id', $value)->first();
            $data[] = [
                'profesi_id' => $value,
                'profesi' => $get_profesi->nama_profesi,
                'total' => count($get[$value]),
                'colors' => $get_profesi->colors,
            ];
        }

        $indikator_profesi = $data;
        return view('admin.dashboard.dashboard', compact('total_anggota','total_skm','total_pengunjung','indikator_profesi'));
    }
}