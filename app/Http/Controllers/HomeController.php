<?php

namespace App\Http\Controllers;

use Exception;
use \RouterOS\Query;
use \RouterOS\Client;
use App\Models\Tujuan;
use App\Models\Anggota;
use App\Models\Profesi;
use App\Models\Wilayah;
use App\Models\Aktifitas;
use App\Models\Kuisioner;
use App\Models\AnggotaSkm;
use Illuminate\Http\Request;
use App\Models\AnggotaKuisioner;
use App\Models\TotalAnggotaKuisioner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function index()
    {
        $id = 35;
        $n=strlen($id);
        $m=($n==2?5:($n==5?8:13));
        $wilayah = Wilayah::whereRaw("LEFT(kode, {$n})='{$id}'")
                       ->whereRaw("CHAR_LENGTH(kode)={$m}")
                    ->orderBy('nama', 'ASC')->get();
        $profesi = Profesi::all();

        $usia = [
            [
                'value' => 'kurang_15',
                'text' => '< 15 Tahun'
            ],
            [
                'value' => '15_24',
                'text' => '15 - 24 Tahun',
            ],
            [
                'value' => '25_34',
                'text' => '25 - 34 Tahun',
            ],
            [
                'value' => '35_44',
                'text' => '35 - 44 Tahun',
            ],
            [
                'value' => '44_54',
                'text' => '44 - 54 Tahun',
            ],
            [
                'value' => 'lebih_55',
                'text' => '> 55 Tahun',
            ]
        ];
        return view('anggota.form', compact('wilayah', 'profesi','usia'));
    }

    public function penggunjung()
    {
        $tujuan = Tujuan::all();
        $kuisioner = Kuisioner::all();
        return view('anggota.penggunjung', compact('tujuan','kuisioner'));
    }

    public function store_penggunjung(Request $request)
    {
        // return $request;die;
        $get_anggota = Anggota::where('username', $request->username)->first();

        if($get_anggota){
            if (Hash::check($request->password, $get_anggota->password)) {
                $validate_array = [];

                $dataSkm = new AnggotaSkm;
                
                $dataSkm->anggota_id = $get_anggota['id'];
                $dataSkm->nama = $get_anggota['nama'];
                $dataSkm->umur = $get_anggota['usia'];
                $dataSkm->jenis_kelamin = $get_anggota['jenis_kelamin'];
                // $dataSkm['nama_instansi'] = $get_anggota['jenis_kelamin'];
                // $dataSkm['pendidikan_terakhir'] = $get_anggota['jenis_kelamin'];
                // $dataSkm['pekerjaan'] = $get_anggota['jenis_kelamin'];
                $dataSkm->tujuan_id = $request->tujuan_id;;
                $dataSkm->save();
                $id_anggota_skm = $dataSkm->id;
                
                for($x=1; $x<=10; $x++) {
                    $validate_array['soal_'. $x] = 'required';
                }

                for($x=1; $x<=10; $x++) {
                    $jawaban = $request['soal_'. $x];
                    echo $jawaban;
                    $kuis = Kuisioner::where('id', $x)->first();
        
                    $jawaban_value = [
                        'jawaban_1' => $kuis->jawaban_1,
                        'jawaban_2' => $kuis->jawaban_2,
                        'jawaban_3' => $kuis->jawaban_3,
                        'jawaban_4' => $kuis->jawaban_4,
                    ][$jawaban];
        
                    $dataKuisioner['anggota_skm_id'] = $id_anggota_skm;
                    $dataKuisioner['anggota_id'] = $get_anggota['id'];;
                    $dataKuisioner['kuisioner_id'] = $x;
                    $dataKuisioner['jawaban'] = $jawaban;
                    $dataKuisioner['jawaban_value'] = $jawaban_value;
                    
                    AnggotaKuisioner::create($dataKuisioner);
        
                    $get_first_total = TotalAnggotaKuisioner::where('kuisioner_id', $x)->first();
        
                    if($jawaban == 'jawaban_1'){
                        $dataTotal['total_jawaban_1'] = $get_first_total->total_jawaban1 + 1;
                    }else if($jawaban == 'jawaban_2'){
                        $dataTotal['total_jawaban_2'] = $get_first_total->total_jawaban_2 + 1;
                    }else if($jawaban == 'jawaban_3'){
                        $dataTotal['total_jawaban_3'] = $get_first_total->total_jawaban_3 + 1;
                    }else if($jawaban == 'jawaban_4'){
                        $dataTotal['total_jawaban_4'] = $get_first_total->total_jawaban_4 + 1;
                    }
        
                    TotalAnggotaKuisioner::where('kuisioner_id', $x)->update($dataTotal);
        
                }
        
                $request->validate($validate_array);

                $tanggal = date('Y-m-d');
                $get_aktifitas = Aktifitas::where('anggota_id', $get_anggota->id)->where('tgl_kunjungan', $tanggal)->first();
                
                if(empty($get_aktifitas)){
                    $data['anggota_id'] = $get_anggota->id;
                    $data['tujuan_id'] = $request->tujuan_id;
                    $data['tgl_kunjungan'] = $tanggal;
                    Aktifitas::create($data);

                    
                }
                return redirect('/penggunjung')->with('success', 'Pengisian daftar penggunjung berhasil!');
                    
            }else{
                return redirect('/penggunjung')->with('error', 'Username atau Password salah !');
            }
        }else{
            return redirect('/penggunjung')->with('error', 'Username atau Password salah !');
        }
    }

    public function skm()
    {
        $pendidikan_terkahir = [
            'SMP / MTS',
            'SMA / SMK / MA',
            'D4 / S1',
            'S2',
            'S3',
        ];
        $pekerjaan = [
            'PELAJAR / MAHASISWA',
            'SWASTA',
            'PNS',
            'LAINNYA',
        ];

        $usia = [
            [
                'value' => 'kurang_15',
                'text' => '< 15 Tahun'
            ],
            [
                'value' => '15_24',
                'text' => '15 - 24 Tahun',
            ],
            [
                'value' => '25_34',
                'text' => '25 - 34 Tahun',
            ],
            [
                'value' => '35_44',
                'text' => '35 - 44 Tahun',
            ],
            [
                'value' => '44_54',
                'text' => '44 - 54 Tahun',
            ],
            [
                'value' => 'lebih_55',
                'text' => '> 55 Tahun',
            ]
        ];

        $tujuan = Tujuan::all();
        $kuisioner = Kuisioner::all();
        return view('kuisioner', compact('pendidikan_terkahir','pekerjaan', 'tujuan', 'kuisioner', 'usia'));
    }

    public function store(Request $request)
    {
        
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'username' => ['required','min:6', 'max:255', 'unique:anggota'],
            'email' => 'required|email:dns|unique:anggota',
            'password' => ['required','confirmed', Password::min(8)->mixedCase()],
            'usia' => 'required',
            'jenis_kelamin' => 'required',
            'telp' => 'required|numeric',
            'sosial_media'=> 'required',
            'profesi_id' => 'required',
            'domisili' => 'required',
            'mengetahui_ejsc' => 'required',
        ]);
        $passwithoutHash = $validatedData['password'];
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['password_show'] = $passwithoutHash;

        $password = Hash::make($validatedData['password']);

        Anggota::create($validatedData);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'mac' => $request->mac,
            'email' => $request->email,
            'password' => $password,
            'password_show' => $passwithoutHash,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telp' => $request->telp,
            'sosial_media'=> $request->sosial_media,
            'profesi_id' => $request->profesi_id,
            'domisili' => $request->domisili,
            'mengetahui_ejsc' => $request->mengetahui_ejsc,
        ];

        $this->send_request_to_online($validatedData);

        try {

            $client = new Client([
                'host' => '192.168.40.1',
                'user' => 'admin',
                'pass' => 'k0s0ng',
                'port' => 8728,
            ]);
        
            $query =
                (new Query('/ip/hotspot/user/add'))
                    ->equal('server', 'server-hotspot')
                    ->equal('name', $request->username)
                    ->equal('password', $passwithoutHash)
                    ->equal('profile', 'user')
                    ->equal('comment', 'Anggota');
            
            $client->query($query)->read();


        } catch (Exception $exception) {
            
        }


        return redirect('/')->with('success', 'Pendaftaran Berhasil!');
    }
    
    public function send_request_to_online($dataReq){
            // return $dataReq;die;
            $apiURL = 'https://ejsc.colabs.id/api/anggota_online';

            // POST Data
            $postInput = $dataReq;
      
            // Headers
            $headers = [
                //...
            ];
      
            $response = Http::withHeaders($headers)->post($apiURL, $postInput);
      
            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);
          
    }
    
    public function store_skm(Request $request)
    {
        $validate_array = [
            'pekerjaan' => 'required',
            'nama' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'nama_instansi' => 'required',
            'pendidikan_terkahir' => 'required',
            'tujuan_id' => 'required',
            'jenis_kelamin' => 'required'
        ];
        
        for($x=1; $x<=10; $x++) {
            $validate_array['soal_'. $x] = 'required';
        }

        $request->validate($validate_array);

        $dataIns = new AnggotaSkm;
        $dataIns->anggota_id = 1;
        $dataIns->nama =  $request['nama'];
        $dataIns->umur = $request['umur'];
        $dataIns->jenis_kelamin = $request['jenis_kelamin'];
        $dataIns->nama_instansi = $request['nama_instansi'];
        $dataIns->pendidikan_terkahir = $request['pendidikan_terkahir'];
        $dataIns->pekerjaan = $request['pekerjaan'];
        $dataIns->tujuan_id = $request['tujuan_id'];
        $dataIns->jenis_kelamin = $request['jenis_kelamin'];
        $dataIns->masukkan_pelatihan = $request->masukkan_pelatihan;
        $dataIns->kritik_saran = $request->kritik_saran;

        $dataIns->save();

        $id_anggota_skm = $dataIns->id;

        for($x=1; $x<=10; $x++) {
            $jawaban = $request['soal_'. $x];
            $kuis = Kuisioner::where('id', $x)->first();

            $jawaban_value = [
                'jawaban_1' => $kuis->jawaban_1,
                'jawaban_2' => $kuis->jawaban_2,
                'jawaban_3' => $kuis->jawaban_3,
                'jawaban_4' => $kuis->jawaban_4,
            ][$jawaban];

            $dataKuisioner['anggota_skm_id'] = $id_anggota_skm;
            $dataKuisioner['anggota_id'] = 1;
            $dataKuisioner['kuisioner_id'] = $x;
            $dataKuisioner['jawaban'] = $jawaban;
            $dataKuisioner['jawaban_value'] = $jawaban_value;
            
            AnggotaKuisioner::create($dataKuisioner);

            $get_first_total = TotalAnggotaKuisioner::where('kuisioner_id', $x)->first();

            if($jawaban == 'jawaban_1'){
                $dataTotal['total_jawaban_1'] = $get_first_total->total_jawaban1 + 1;
            }else if($jawaban == 'jawaban_2'){
                $dataTotal['total_jawaban_2'] = $get_first_total->total_jawaban_2 + 1;
            }else if($jawaban == 'jawaban_3'){
                $dataTotal['total_jawaban_3'] = $get_first_total->total_jawaban_3 + 1;
            }else if($jawaban == 'jawaban_4'){
                $dataTotal['total_jawaban_4'] = $get_first_total->total_jawaban_4 + 1;
            }

            TotalAnggotaKuisioner::where('kuisioner_id', $x)->update($dataTotal);


        }

        return redirect('skm')->with('success', 'SKM berhasil disimpan');
        
    }
}