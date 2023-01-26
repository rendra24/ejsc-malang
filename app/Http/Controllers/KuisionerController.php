<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data['kuisioner'] = Kuisioner::paginate(10)->withQueryString();
        
        return view('admin.kuisioner.index_kuisioner', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kuisioner.form_kuisioner');
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
            'soal' => 'required|max:255',
            'jawaban_1' => 'required',
            'jawaban_2' => 'required',
            'jawaban_3' => 'required',
            'jawaban_4' => 'required',
        ]);
        

        Kuisioner::create($validatedData);

        return redirect('/kuisioner')->with('success', 'Kuisioner berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function show(Kuisioner $kuisioner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuisioner $kuisioner)
    {
        $data['kuisioner'] = $kuisioner;
        return view('admin.kuisioner.form_kuisioner', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuisioner $kuisioner)
    {
        $validatedData =  $request->validate([
            'soal' => 'required|max:255',
            'jawaban_1' => 'required',
            'jawaban_2' => 'required',
            'jawaban_3' => 'required',
            'jawaban_4' => 'required',
        ]);
        

        Kuisioner::where('id', $kuisioner->id)->update($validatedData);

        return redirect('/kuisioner')->with('success', 'Kuisioner berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuisioner $kuisioner)
    {
        //
    }
}