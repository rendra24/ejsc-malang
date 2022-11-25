<?php

namespace App\Http\Controllers;

use App\Models\Profesi;
use Illuminate\Http\Request;

class ProfesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesi = Profesi::latest();
        
        $data['profesi'] = $profesi->paginate(10)->withQueryString();
        
        return view('admin.profesi.index_profesi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profesi.form_profesi');
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
            'nama_profesi' => 'required|max:255',
            'colors' => 'required'
        ]);

        Profesi::create($validatedData);

        return redirect('/profesi')->with('success', 'Profesi baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesi  $profesi
     * @return \Illuminate\Http\Response
     */
    public function show(Profesi $profesi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesi  $profesi
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesi $profesi)
    {
        $data['profesi'] = $profesi;
        return view('admin.profesi.form_profesi', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesi  $profesi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesi $profesi)
    {
        $validatedData =  $request->validate([
            'nama_profesi' => 'required|max:255',
            'colors' => 'required'
        ]);
        

        Profesi::where('id', $profesi->id)->update($validatedData);

        return redirect('/profesi')->with('success', 'Profesi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesi  $profesi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesi $profesi)
    {
        Profesi::destroy($profesi->id);
        return redirect('profesi')->with('success', 'Profesi berhasil dihapus');
    }
}