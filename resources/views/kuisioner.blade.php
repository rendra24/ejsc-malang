<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Member EJSC Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
</head>

<body style="background-color:rgb(255, 240, 217);">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card my-5">
                    <img src="banner.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4>KUISIONER SURVEY KEPUASAAN MASYARAKAT (SKM) EJSC MALANG</h4>
                        <p>KUISIONER INI DITUJUKAN UNTUK MENGUKUR KEPUASAN PENGUNJUNG TERHADAP PENGGUNAAN LAYANAN EJSC MALANG.</p>
                        
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <form action="{{ route('anggota.store_skm') }}" method="post">
                        @csrf
                        <div class="mb-3 form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            name="nama" placeholder="Nama" value="{{ old('nama') }}" >
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label>Umur</label>
                            <select name="umur" id="" class="form-control @error('umur') is-invalid @enderror" id="umur">
                                <option value="">Pilih Umur</option>
                                @foreach($usia as $row)
                                <option value="{{ $row['value'] }}">{{ $row['text'] }}</option>
                                @endforeach
                            </select>
                            @error('umur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label>Jenis Kelamin</label>
                            <div class="form-check">
                            <label>
                                <input type="radio" class="form-check-input" id='jk_laki' name="jenis_kelamin" value="L">
                                <label class="form-check-label" for="jk_laki">
                                    Laki - Laki
                                  </label>
                            </label>
                            </div>
                            <div class="form-check">
                                <label>
                                    <input type="radio" class="form-check-input" id="jk_perempuan" name="jenis_kelamin" value="P">
                                    <label class="form-check-label" for="jk_perempuan">
                                        Perempuan
                                      </label>
                                </label>
                                </div>

                            @error('jenis_kelamin')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label>Sekolah / Universitas / Komunitas</label>
                            <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" 
                            name="nama_instansi" placeholder="Nama Instansi" value="{{ old('nama_instansi') }}" >
                            @error('nama_instansi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="profesi" class="form-label">Pendidikan Terkahir</label>
                            <select name="pendidikan_terkahir" id="" class="form-control @error('pendidikan_terkahir') is-invalid @enderror" id="profesi">
                                <option value="">Pilih Pendidikan Terkahir</option>
                                @foreach($pendidikan_terkahir as $row)
                                    
                                    @if(old('pendidikan_terkahir') == $row)
                                        <option value="{{ $row }}" selected>{{ $row }}</option>
                                    @else
                                        <option value="{{ $row }}">{{ $row }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('pendidikan_terkahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <select name="pekerjaan" id="" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan">
                                <option value="">Pilih Pekerjaan</option>
                                @foreach($pekerjaan as $row)
                                @if(old('pekerjaan') == $row)
                                <option value="{{ $row }}" selected>{{ $row }}</option>
                            @else
                                <option value="{{ $row }}">{{ $row }}</option>
                            @endif
                                @endforeach
                            </select>
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tujuan_id" class="form-label">Tujuan / Kegiatan</label>
                            <select name="tujuan_id" id="tujuan_id" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan">
                                <option value="">Pilih Pendidikan Terkahir</option>
                                @foreach($tujuan as $row)
                                @if(old('tujuan') == $row->id)
                                    <option value="{{ $row->id }}" selected>{{ $row->nama_tujuan }}</option>
                                @else
                                <option value="{{ $row->id }}">{{ $row->nama_tujuan }}</option>
                            @endif
                                @endforeach
                            </select>
                            @error('tujuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @foreach($kuisioner as $key => $row)
                            
                        <div class="mb-3 form-group">
                            <label class="mb-3">{{ $row->soal }}</label>
                            <div class="form-check">
                            <label>
                                <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="{{ $row->jawaban_1 }}" id="jawaban_1{{ $loop->iteration }}">
                                <label class="form-check-label" for="jawaban_1{{ $loop->iteration }}">
                                    {{ $row->jawaban_1 }}
                                  </label>
                            </label>
                            </div>
                            <div class="form-check">
                                <label>
                                    <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="{{ $row->jawaban_2 }}" id="jawaban_2{{ $loop->iteration }}">
                                    <label class="form-check-label" for="jawaban_2{{ $loop->iteration }}">
                                        {{ $row->jawaban_2 }}
                                      </label>
                                </label>
                            </div>

                            <div class="form-check">
                                <label>
                                    <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="{{ $row->jawaban_3 }}" id="jawaban_3{{ $loop->iteration }}">
                                    <label class="form-check-label" for="jawaban_3{{ $loop->iteration }}">
                                        {{ $row->jawaban_3 }}
                                      </label>
                                </label>
                            </div>

                            <div class="form-check">
                                <label>
                                    <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="{{ $row->jawaban_4 }}" id="jawaban_4{{ $loop->iteration }}" {{ (old('soal_'.$loop->iteration) == $row->jawaban_4) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jawaban_4{{ $loop->iteration }}">
                                        {{ $row->jawaban_4 }}
                                      </label>
                                </label>
                            </div>

                            @error('soal_'.$loop->iteration)
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        @endforeach

                        
                        <div class="mb-3 form-group">
                            <label>PELATIHAN APA YANG ANDA HARAPKAN ADA DI EJSC MALANG</label>
                            <textarea class="form-control @error('masukkan_pelatihan') is-invalid @enderror" 
                            name="masukkan_pelatihan" >{{ old('masukkan_pelatihan') }}
                            </textarea>
                            @error('masukkan_pelatihan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label>KRITIK DAN SARAN UNTUK PENINGKATAN LAYANAN DI EJSC MALANG</label>
                            <textarea class="form-control @error('kritik_saran') is-invalid @enderror" 
                            name="kritik_saran" >{{ old('kritik_saran') }}
                            </textarea>
                            @error('kritik_saran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Kirim</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>