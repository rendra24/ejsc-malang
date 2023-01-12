<?php

namespace App\Exports;

use App\Models\Kuisioner;
use App\Models\AnggotaSkm;
use App\Helpers\GlobalHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSkm implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $tanggal_awal;
    protected $tanggal_akhir;

    function __construct($tanggal_awal, $tanggal_akhir) {
            $this->tanggal_awal = $tanggal_awal;
            $this->tanggal_akhir = $tanggal_akhir;
    }


    public function view(): View
    {
        $tanggal_awal = $this->tanggal_awal;
        $tanggal_akhir = $this->tanggal_akhir;

        $get_skm = AnggotaSkm::with('anggota_kuisioner')->whereHas('anggota_kuisioner');

        if($tanggal_awal != '')
        {
            $get_skm->whereBetween('created_at',[$tanggal_awal . ' 00:00:00',$tanggal_akhir . ' 23:59:59']);
        }else{
            $tanggal_awal = '';
            $tanggal_akhir = '';
        }
        
        $result_skm = $get_skm->get()->map(function($detail){
            $data['timetimes'] = $detail->created_at;
            $data['nama'] = $detail->nama;
            $data['nama_instansi'] = $detail->nama_instansi;
            $data['jenis_kelamin'] = ($detail->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan';
            $data['umur'] = $detail->umur;
            $data['pendidikan_terkahir'] = $detail->pendidikan_terkahir;
            $data['pekerjaan'] = $detail->pekerjaan;
            $data['tujuan'] = $detail->tujuan->nama_tujuan;
            $data['anggota_skm'] = $detail->anggota_kuisioner;
            $data['masukkan_pelatihan'] = $detail->masukkan_pelatihan;
            $data['kritik_saran'] = $detail->kritik_saran;

            return $data;
        })->toArray();
            
        $get_kuisioner = Kuisioner::get();

        return view('exports.skm', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'kuisioner' => $get_kuisioner,
            'skm' => $result_skm,
        ]);
    }
}