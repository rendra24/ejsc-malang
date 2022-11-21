<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Models\AnggotaSkm;
use App\Models\TotalAnggotaKuisioner;

class LaporanController extends Controller
{
    public function pengunjung()
    {
        $get_aktifitas = Aktifitas::with('anggota.profesi')->whereHas('anggota.profesi');
        $data['aktifitas'] = $get_aktifitas->paginate(10)->withQueryString();
        $data['helper'] = new GlobalHelper;
        
        return view('laporan.penggunjung', $data);
    }

    public function skm()
    {
        $get_skm = AnggotaSkm::latest();
        $data['skm'] = $get_skm->paginate(10)->withQueryString();
        $data['helper'] = new GlobalHelper;
        
        return view('laporan.skm', $data);
    }

    public function indikator_kepuasan()
    {
        $get_data_indikator = TotalAnggotaKuisioner::with('kuisioner')->whereHas('kuisioner')->get();
        $data['indikator'] = $get_data_indikator;
        return view('laporan.indikator_kepuasan', $data);
    }

    public function kritik_saran()
    {
        $get_skm = AnggotaSkm::latest();
        $data['skm'] = $get_skm->paginate(10)->withQueryString();
        $data['helper'] = new GlobalHelper;
        
        return view('laporan.kritik_saran', $data);
    }
}