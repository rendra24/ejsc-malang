<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use \RouterOS\Client;
use \RouterOS\Query;

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
        return view('anggota.form', compact('wilayah'));
    }

    public function store(Request $request)
    {
        // return $request;
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'username' => ['required','min:6', 'max:255', 'unique:anggota'],
            'email' => 'required|email:dns|unique:anggota',
            'password' => 'required|confirmed|min:6|max:255',
            'usia' => 'required',
            'jenis_kelamin' => 'required',
            'telp' => 'required|numeric',
            'sosial_media'=> 'required',
            'profesi' => 'required',
            'domisili' => 'required',
            'mengetahui_ejsc' => 'required',
        ]);
        $passwithoutHash = $validatedData['password'];
        $validatedData['password'] = Hash::make($validatedData['password']);

        Anggota::create($validatedData);

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

        return redirect('/')->with('success', 'Pendaftaran suceessfull!');
    }
}