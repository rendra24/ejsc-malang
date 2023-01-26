<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AnggotaSkm;
use App\Models\Tujuan;

class SkmApiController extends Controller
{

    public function index()
    {
       $tujuan = Tujuan::get();
       $dataTujuan= array();
       foreach($tujuan as $row){
        $dataTujuan[$row->id] = [
            'nama_tujuan' => $row->nama_tujuan,
        ];
       }
       
       
       $get_skm = AnggotaSkm::with('anggota_kuisioner.kuisioner')->whereHas('anggota_kuisioner')->get()->map(function($detail) use($dataTujuan){
        $tujuan_id = $detail['tujuan_id'];

        $data['nama'] = $detail['nama'];
        $data['umur'] = $detail['umur'];
        $data['jenis_kelamin'] = $detail['jenis_kelamin'];
        $data['nama_instansi'] = $detail['nama_instansi'];
        $data['pendidikan_terkahir'] = $detail['pendidikan_terkahir'];
        $data['pekerjaan'] = $detail['pekerjaan'];
        $data['tujuan'] = $dataTujuan[$tujuan_id];
        

        $dataKuisioner = array();
        foreach($detail['anggota_kuisioner'] as $key => $row){
            $dataKuisioner[] = [
                'soal' => $detail['anggota_kuisioner'][$key]['kuisioner']['soal'],
                'jawaban' => $detail['anggota_kuisioner'][$key]['jawaban_value']
            ];
        }

        $data['kuisioner'] = $dataKuisioner;
        $data['masukkan_pelatihan'] = $detail['masukkan_pelatihan'];
        $data['kritik_saran'] = $detail['kritik_saran'];
        
        return $data;
       })->toArray();


       echo json_encode($get_skm);
    }
}