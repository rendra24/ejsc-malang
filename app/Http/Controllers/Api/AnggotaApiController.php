<?php

namespace App\Http\Controllers\Api;

use Exception;
use \RouterOS\Query;
use \RouterOS\Client;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Http;

class AnggotaApiController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make(request()->all(), [
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
        
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
            die;
        }
        
        $passwithoutHash = $request->password;
        $password = Hash::make($request->password);
        $password_show = $passwithoutHash;
            
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'mac' => $request->mac,
            'email' => $request->email,
            'password' => $password,
            'password_show' => $password_show,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telp' => $request->telp,
            'sosial_media'=> $request->sosial_media,
            'profesi_id' => $request->profesi_id,
            'domisili' => $request->domisili,
            'mengetahui_ejsc' => $request->mengetahui_ejsc,
        ];

        Anggota::create($data);

        $this->send_request_to_online($data);

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
                    ->equal('password', $password_show)
                    ->equal('profile', 'user')
                    ->equal('comment', 'Anggota');
            
            $client->query($query)->read();


        } catch (Exception $exception) {
            
        }

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
                // ->equal('mac-address', $request->mac)
                ->equal('profile', 'user')
                ->equal('comment', 'Anggota');
        
        $client->query($query)->read();
    }

    public function anggota_online(Request $request){
        
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
}