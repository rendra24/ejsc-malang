<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AktifitasResource;
use App\Models\Aktifitas;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AktifitasApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Aktifitas::latest()->get();
        return response()->json([AktifitasResource::collection($data), 'Aktifitas fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_anggota = Anggota::where('username', $request->username)->first();

        if($get_anggota){
            if (Hash::check($request->password, $get_anggota->password)) {
                $tanggal = date('Y-m-d');
                $get_aktifitas = Aktifitas::where('anggota_id', $get_anggota->id)->where('tgl_kunjungan', $tanggal)->first();
                
                if(empty($get_aktifitas)){
                    $data['anggota_id'] = $get_anggota->id;
                    $data['tujuan_id'] = $request->tujuan_id;
                    $data['tgl_kunjungan'] = $tanggal;
                    Aktifitas::create($data);
                }
                return response()->json(['status' => true, 'message' => 'Success Logged']);
            }else{
                return response()->json(['status' => false, 'message' => 'Username atau Password salah']);
            }
        }else{
            return response()->json(['status' => false, 'message' => 'Username atau Password salah']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}