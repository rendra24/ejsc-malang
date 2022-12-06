<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\AnggotaSkm;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Carbon;
use App\Exports\PenggunjungExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TotalAnggotaKuisioner;

class LaporanController extends Controller
{
    public function pengunjung(Request $request)
    {
        if(isset($request->tanggal)){
            $arr = explode(" - ", $request->tanggal);
            $tanggal_awal = $arr[0];
            $tanggal_akhir = $arr[1];
        }else{
            $tanggal_awal = date('Y-m-d');
            $tanggal_akhir = date('Y-m-d');
        }
        $aktifitas = Aktifitas::with('anggota.profesi')->whereHas('anggota.profesi')->whereBetween('tgl_kunjungan',[$tanggal_awal,$tanggal_akhir])->get()
        ->map(function($detail){
            $data['tanggal_kunjungan'] = $detail->created_at;
            $data['nama_penggunjung'] = $detail->anggota->nama;
            $data['profesi'] = $detail->anggota->profesi->nama_profesi;
            $data['tujuan'] = $detail->tujuan->nama_tujuan;
            $data['domisili'] = ucfirst(strtolower(GlobalHelper::get_wilayah($detail->anggota->domisili)));
            

            return $data;
        });
        $data['aktifitas'] = $aktifitas;
        $data['helper'] = new GlobalHelper;
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        
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

    public function cetak_penggunjung(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        return Excel::download(new PenggunjungExport($tanggal_awal, $tanggal_akhir), "penggunjung_{$tanggal_awal}.xlsx");
    }
}