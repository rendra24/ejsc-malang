<?php

namespace App\Http\Controllers;

use App\Exports\ExportSkm;
use App\Models\Aktifitas;
use App\Models\AnggotaSkm;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Carbon;
use App\Models\AnggotaKuisioner;
use App\Exports\PenggunjungExport;
use App\Models\Kuisioner;
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

    public function skm(Request $request)
    {
       

        $get_skm = AnggotaSkm::with('tujuan')->whereHas('tujuan');

        if(isset($request->tanggal)){
            $arr = explode(" - ", $request->tanggal);
            $tanggal_awal = $arr[0];
            $tanggal_akhir = $arr[1];

            $get_skm->whereBetween('created_at',[$tanggal_awal . ' 00:00:00',$tanggal_akhir . ' 23:59:59']);
        }else{
            $tanggal_awal = '';
            $tanggal_akhir = '';
        }

        $result_skm = $get_skm->get()->toArray();
        

        $data['skm'] = $result_skm;
        $data['helper'] = new GlobalHelper;
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        
        return view('laporan.skm', $data);
    }

    public function destroy_skm($id)
    {
        $get_data_kuisioner = AnggotaKuisioner::where('anggota_skm_id',$id);

        //kurangi total jumlah jawaban kuisioner
        foreach($get_data_kuisioner->get() as $row)
        {
            $kuisioner_id = $row['kuisioner_id'];
            $jawaban = $row['jawaban'];

            $get_first_total = TotalAnggotaKuisioner::where('kuisioner_id', $kuisioner_id)->first();

            

            if($jawaban == 'jawaban_1'){
                $dataTotal['total_jawaban_1'] = $get_first_total->total_jawaban1 - 1;
            }else if($jawaban == 'jawaban_2'){
                $dataTotal['total_jawaban_2'] = $get_first_total->total_jawaban_2 - 1;
            }else if($jawaban == 'jawaban_3'){
                $dataTotal['total_jawaban_3'] = $get_first_total->total_jawaban_3 - 1;
            }else if($jawaban == 'jawaban_4'){
                $dataTotal['total_jawaban_4'] = $get_first_total->total_jawaban_4 - 1;
            }

            TotalAnggotaKuisioner::where('kuisioner_id', $kuisioner_id)->update($dataTotal);
        }


        //delete anggota_skm & anggota kuisioner
        $get_data_kuisioner->delete();
        AnggotaSkm::where('id', $id)->delete();


        return redirect('laporan/skm')->with('success', 'Anggota berhasil dihapus');
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
        return Excel::download(new PenggunjungExport($tanggal_awal, $tanggal_akhir), "pengunjung_{$tanggal_awal}.xlsx");
    }

    public function cetak_skm(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        return Excel::download(new ExportSkm($tanggal_awal, $tanggal_akhir), "skm_{$tanggal_awal}.xlsx");

    }
}