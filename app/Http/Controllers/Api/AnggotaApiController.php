<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaApiController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telp' => $request->telp,
            'sosial_media'=> $request->sosial_media,
            'profesi_id' => $request->profesi_id,
            'domisili' => $request->domisili,
            'mengetahui_ejsc' => $request->mengetahui_ejsc,
        ];
        Anggota::create($data);
        return response()->json(['status' => true, 'message' => 'Berhasil Mendaftarkan']);
    }
}