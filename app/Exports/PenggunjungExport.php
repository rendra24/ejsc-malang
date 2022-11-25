<?php

namespace App\Exports;

use App\Models\Aktifitas;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Helpers\GlobalHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenggunjungExport implements FromView
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
        $aktifitas = Aktifitas::with('anggota.profesi')->whereHas('anggota.profesi')->whereBetween('tgl_kunjungan',[$tanggal_awal,$tanggal_akhir])->get()
        
        ->map(function($detail){
            $data['tanggal_kunjungan'] = $detail->created_at;
            $data['nama_penggunjung'] = $detail->anggota->nama;
            $data['jenis_kelamin'] = ($detail->anggota->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan';
            $data['umur'] = $detail->anggota->usia;
            $data['profesi'] = $detail->anggota->profesi->nama_profesi;
            $data['domisili'] = ucfirst(strtolower(GlobalHelper::get_wilayah($detail->anggota->domisili)));
            $data['tujuan'] = $detail->tujuan;

            return $data;
        })->toArray();
        
        $data = $aktifitas;

        return view('exports.penggunjung', [
            'aktifitas' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
        ]);
    }
}