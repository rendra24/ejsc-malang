<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use \RouterOS\Query;
use \RouterOS\Client;
use Illuminate\Support\Facades\Hash;

class AnggotaApiController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'mac' => $request->mac,
            'email' => $request->email,
            'password' => $request->password,
            'password_show' => $request->password_show,
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

    public function add_to_router(Request $request)
    {

        $username = $request->username;
        $client = new Client([
            'host' => '192.168.40.1',
            'user' => 'admin',
            'pass' => 'k0s0ng',
            'port' => 8728,
        ]);

        $user = $client->query('/ip/hotspot/user/print', ['name', $username])->read(); 

        if (isset($user[0]['.id'])) {
            $userId = $user[0]['.id'];
            $client->query('/ip/hotspot/user/remove', ['.id', $userId])->read();
        }

         
        $query =
            (new Query('/ip/hotspot/user/add'))
                ->equal('server', 'server-hotspot')
                ->equal('name', $username)
                ->equal('password', $request->password)
                ->equal('mac-address', $request->mac)
                ->equal('profile', 'user')
                ->equal('comment', 'Anggota');
        
        $client->query($query)->read();
    }
}