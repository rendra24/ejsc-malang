<?php

namespace App\Http\Controllers\Api;

use App\Models\Profesi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceApiController extends Controller
{
    public function wilayah()
    {
        $id = 35;
        $n=strlen($id);
        $m=($n==2?5:($n==5?8:13));
        $wilayah = Wilayah::whereRaw("LEFT(kode, {$n})='{$id}'")
                       ->whereRaw("CHAR_LENGTH(kode)={$m}")
                    ->orderBy('nama', 'ASC')->get();
                    return response()->json(['status' => true, 'message' => 'Berhasil mendapatkan data wilayah!', 'data' => $wilayah]);
    }

    public function profesi()
    {
        $profesi = Profesi::all();
        return response()->json(['status' => true, 'message' => 'Berhasil mendapatkan data profesi!', 'data' => $profesi]);
    }
}