<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\Tujuan;
use Illuminate\Http\Request;

class TujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tujuan = Tujuan::latest();
        
        $data['helper'] = new GlobalHelper;
        $data['tujuan'] = $tujuan->paginate(10)->withQueryString();
        
        return view('admin.tujuan.index_tujuan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tujuan.form_tujuan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'nama_tujuan' => 'required|max:255',
        ]);

        Tujuan::create($validatedData);

        return redirect('/tujuan')->with('success', 'Tujuan baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tujuan  $tujuan
     * @return \Illuminate\Http\Response
     */
    public function show(Tujuan $tujuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tujuan  $tujuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tujuan $tujuan)
    {
        $data['tujuan'] = $tujuan;
        return view('admin.tujuan.form_tujuan', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tujuan  $tujuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tujuan $tujuan)
    {
        $validatedData =  $request->validate([
            'nama_tujuan' => 'required|max:255',
        ]);
        

        Tujuan::where('id', $tujuan->id)->update($validatedData);

        return redirect('/tujuan')->with('success', 'Tujuan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tujuan  $tujuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tujuan $tujuan)
    {
        Tujuan::destroy($tujuan->id);
        return redirect('tujuan')->with('success', 'Tujuan berhasil dihapus');
    }
}